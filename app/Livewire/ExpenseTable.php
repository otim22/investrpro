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
        return Expense::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('expense_name')
            ->addColumn('expense_type')
            ->addColumn('financial_year')
            ->addColumn('date_of_expense_formatted', function (Expense $model) { 
                return Carbon::parse($model->date_of_expense)->format('d/m/Y');
            })
            ->addColumn('details', function (Expense $model) {
                return \Str::words(e($model->details), 10); 
            })
            ->addColumn('rate')
            ->addColumn('amount', function (Expense $model) { 
                return number_format($model->amount);
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Expense name', 'expense_name')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Expense type', 'expense_type')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),
                

            Column::make('Financial year', 'financial_year')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Date of expense', 'date_of_expense_formatted', 'date_of_expense')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),

            Column::make('Details', 'details')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Rate', 'rate')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
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
            Filter::inputText('expense_name')->operators(['contains']),
            Filter::inputText('expense_type')->operators(['contains']),
            Filter::inputText('financial_year')->operators(['contains']),
            Filter::inputText('details')->operators(['contains']),
            Filter::inputText('rate')->operators(['contains']),
            Filter::inputText('amount')->operators(['contains']),
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
}
