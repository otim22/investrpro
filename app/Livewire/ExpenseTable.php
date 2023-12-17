<?php

namespace App\Livewire;

use App\Models\Expense;
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

final class ExpenseTable extends PowerGridComponent
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
        return Expense::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('liability_name')
            ->addColumn('liability_type')
            ->addColumn('financial_year')
            ->addColumn('date_of_expense_formatted', function (Expense $model) { 
                return Carbon::parse($model->date_of_expense)->format('d/m/Y');
            })
            ->addColumn('details', function (Expense $model) {
                return \Str::words(e($model->details), 10); 
            })
            ->addColumn('rate')
            ->addColumn('amount')
            ->addColumn('designate');
    }

    public function columns(): array
    {
        return [
            Column::make('Liability name', 'liability_name')
                ->sortable()
                ->searchable(),

            Column::make('Liability type', 'liability_type')
                ->sortable()
                ->searchable(),

            Column::make('Financial year', 'financial_year')
                ->sortable()
                ->searchable(),

            Column::make('Date of expense', 'date_of_expense_formatted', 'date_of_expense')
                ->sortable(),

            Column::make('Details', 'details')
                ->sortable()
                ->searchable(),

            Column::make('Rate', 'rate')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->sortable()
                ->searchable(),

            Column::make('Designate', 'designate')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('liability_name')->operators(['contains']),
            Filter::inputText('liability_type')->operators(['contains']),
            Filter::inputText('financial_year')->operators(['contains']),
            Filter::inputText('rate')->operators(['contains']),
            Filter::inputText('amount')->operators(['contains']),
            Filter::inputText('designate')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $expenses = Expense::findOrFail($rowId);
        $this->redirectRoute('expenses.show', $expenses);
    }

    public function actions(Expense $row): array
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
