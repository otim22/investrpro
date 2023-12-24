<?php

namespace App\Livewire;

use App\Models\Investment;
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

final class InvestmentTable extends PowerGridComponent
{
    use WithExport;

    public function setUp(): array
    {
        // Custom per page
        $perPage = 25;
        // Custom per page values
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
        return Investment::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('investment_type')
            ->addColumn('date_of_investment_formatted', function (Investment $model) { 
                return Carbon::parse($model->date_of_investment)->format('d/m/Y');
            })
            ->addColumn('duration')
            ->addColumn('interest_rate')
            ->addColumn('amount_invested')
            ->addColumn('date_of_maturity_formatted', function (Investment $model) { 
                return Carbon::parse($model->date_of_maturity)->format('d/m/Y');
            })
            ->addColumn('expected_tax')
            ->addColumn('expected_return_after_tax')
            ->addColumn('interest_recieved');
    }

    public function columns(): array
    {
        return [
            Column::make('Investment type', 'investment_type')
                ->sortable()
                ->searchable(),

            Column::make('Date of investment', 'date_of_investment_formatted', 'date_of_investment')
                ->sortable(),

            Column::make('Duration', 'duration')
                ->sortable()
                ->searchable(),

            Column::make('Interest rate', 'interest_rate')
                ->sortable()
                ->searchable(),

            Column::make('Amount invested', 'amount_invested')
                ->sortable()
                ->searchable(),

            Column::make('Date of maturity', 'date_of_maturity_formatted', 'date_of_maturity')
                ->sortable(),

            Column::make('Expected tax', 'expected_tax')
                ->sortable()
                ->searchable(),

            Column::make('Expected return after tax', 'expected_return_after_tax')
                ->sortable()
                ->searchable(),

            Column::make('Interest recieved', 'interest_recieved')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('investment_type')->operators(['contains']),
            Filter::inputText('duration')->operators(['contains']),
            Filter::inputText('interest_rate')->operators(['contains']),
            Filter::inputText('amount_invested')->operators(['contains']),
            Filter::inputText('expected_tax')->operators(['contains']),
            Filter::inputText('expected_return_after_tax')->operators(['contains']),
            Filter::inputText('interest_recieved')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $investment = Investment::findOrFail($rowId);
        $this->redirectRoute('investments.show', $investment);
    }

    public function actions(Investment $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id])
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
