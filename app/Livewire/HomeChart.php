<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Asset;
use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class HomeChart extends Component
{
    public $types = ['Savings', 'Missed meeting', 'Late remission'];
    public $colors = [
        'Savings' => '#66DA26',
        'Missed meeting' => '#90cdf4',
        'Late remission' => '#f6ad55',
    ];

    public function filterType()
    {
        return $this->types = $this->types;
    }

    public function showDataLabel()
    {
        if ($this->showDataLabels) {
            $this->showDataLabels = true;
        } else {
            $this->showDataLabels = false;
        }
    }

    public $firstRun = true;
    public $showDataLabels = true;

    public function render()
    {
        $assets = Asset::where('asset', 'Savings')->get();

        $columnChartModel = $assets->groupBy(function($val) {
                return Carbon::parse($val->date_paid)->format('M');
            })
            ->reduce(function ($columnChartModel, $data) {
                $asset = $data->first()->date_paid->format('M');
                $value = $data->sum('amount');

                return $columnChartModel->addColumn($asset, $value, $this->colors);
            }, LivewireCharts::columnChartModel()
                ->setTitle('Assets by Type')
                ->setAnimated($this->firstRun)
                ->withOnColumnClickEventName('onColumnClick')
                ->setLegendVisibility($this->showDataLabels)
                ->setDataLabelsEnabled($this->showDataLabels)
                //->setOpacity(0.25)
                ->setColors($this->colors)
                ->setColumnWidth(70)
                ->withGrid()
            );
        // dd($columnChartModel);
        $pieChartModel = $assets->groupBy('asset')
            ->reduce(function ($pieChartModel, $data) {
                $asset = $data->first()->asset;
                $value = $data->sum('amount');

                return $pieChartModel->addSlice($asset, $value, $this->colors[$asset]);
            }, LivewireCharts::pieChartModel()
                ->setTitle('Assets by Type')
                ->setAnimated($this->firstRun)
                ->setType('pie')
                ->withOnSliceClickEvent('onSliceClick')
                //->withoutLegend()
                ->legendPositionBottom()
                ->legendHorizontallyAlignedCenter()
                ->setDataLabelsEnabled($this->showDataLabels)
                ->setColors($this->colors)
            );
        
        $this->firstRun = false;

        return view('livewire.home-chart')->with([
            'columnChartModel' => $columnChartModel,
            // 'pieChartModel' => $pieChartModel,
        ]);
    }
}
