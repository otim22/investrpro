<?php

namespace App\Livewire;

use App\Models\ExpenseType;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
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

final class ExpenseTypeTable extends PowerGridComponent
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

    public function datasource(): Collection
    {
        $data = ExpenseType::query()->join('companies', 'expense_types.company_id', '=', 'companies.id')
            ->select('expense_types.*', 'companies.company_name as company')->get();
        return $data->where('company_id', Auth::user()->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('expense_type')
            ->addColumn('company')
            ->addColumn('description');
    }

    public function columns(): array
    {
        return [
            Column::make('Expense type', 'expense_type')    
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Company name', 'company') 
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
            Filter::inputText('expense_type')->operators(['contains']),
            Filter::inputText('company')->operators(['contains']),
            Filter::inputText('description')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $expenseType = ExpenseType::findOrFail($rowId);
        $this->redirectRoute('admin.expense-types.show', $expenseType);
    }

    public function actions(ExpenseType $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id]),
        ];
    }
}
