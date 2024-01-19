<?php

namespace App\Livewire;

use App\Models\FinancialMonth;
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

final class FinancialMonthsTable extends PowerGridComponent
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
        $data = FinancialMonth::query()->join('companies', 'financial_months.company_id', '=', 'companies.id')
            ->select('financial_months.*', 'companies.company_name as company')->get();
        return $data->where('company_id', Auth::user()->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('title')
            ->addColumn('description')
            ->addColumn('company');
    }

    public function columns(): array
    {
        return [
            Column::make('Title', 'title')
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
                ->headerAttribute('text-capitalize fs-6'),
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('title')->operators(['contains']),
            Filter::inputText('company')->operators(['contains']),
            Filter::inputText('description')->operators(['contains'])
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $financialMonth = FinancialMonth::findOrFail($rowId);
        $this->redirectRoute('admin.financial-months.show', $financialMonth);
    }

    public function actions(FinancialMonth $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id]),
        ];
    }
}