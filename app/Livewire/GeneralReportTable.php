<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use App\Models\GeneralReport;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class GeneralReportTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        $perPage = 25;
        $perPageValues = [0, 25, 50, 100, 200];

        $this->showCheckBox();
        $this->persist(['columns', 'filters']);

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage($perPage, $perPageValues)
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return GeneralReport::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('title', function (GeneralReport $model) { 
                return Str::limit($model->title, 40);
            })
            ->addColumn('description', function (GeneralReport $model) { 
                return Str::limit($model->description, 50);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::action('Action')
                ->headerAttribute('text-capitalize fs-6')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title')->operators(['contains']),
            Filter::inputText('description')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $generalReport = GeneralReport::findOrFail($rowId);
        $this->redirectRoute('general-reports.show', $generalReport);
    }

    public function actions(GeneralReport $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id]),
        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
