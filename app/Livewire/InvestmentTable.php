<?php

namespace App\Livewire;

use App\Models\Investment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        return Investment::query()->where('company_id', Auth::user()->company->id); 
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('investment_type')
            ->addColumn('financial_year')
            ->addColumn('date_of_investment_formatted', function (Investment $model) { 
                return Carbon::parse($model->date_of_investment)->format('d/m/Y');
            })
            ->addColumn('duration')
            ->addColumn('interest_rate')
            ->addColumn('amount_invested', function (Investment $model) { 
                return number_format($model->amount_invested);
            })
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
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Financial Year', 'financial_year')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Date of investment', 'date_of_investment_formatted', 'date_of_investment')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),

            Column::make('Duration', 'duration')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Interest rate', 'interest_rate')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Amount invested', 'amount_invested')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Date of maturity', 'date_of_maturity_formatted', 'date_of_maturity')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),

            Column::make('Expected tax', 'expected_tax')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Expected return after tax', 'expected_return_after_tax')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Interest recieved', 'interest_recieved')
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
            Filter::inputText('investment_type')->operators(['contains']),
            Filter::inputText('financial_year')->operators(['contains']),
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
}
