<?php

namespace App\Livewire;

use App\Models\Charge;
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

final class ChargeTable extends PowerGridComponent
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
        $data = Charge::query()->join('members', 'charges.member_id', '=', 'members.id')
            ->select('charges.*', 'members.surname as member')->get();
        return $data->where('company_id', Auth::user()->company->id);
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('member')
            ->addColumn('asset_type')
            ->addColumn('financial_year')
            ->addColumn('charge')
            ->addColumn('amount')
            ->addColumn('month')
            ->addColumn('date_paid_formatted', function (Charge $model) { 
                return Carbon::parse($model->date_paid)->format('d/m/Y');
            })
            ->addColumn('comment')
            ->addColumn('has_paid');
    }

    public function columns(): array
    {
        return [
            Column::make('Member', 'member')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Asset type', 'asset_type')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Charge', 'charge')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Amount', 'amount')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Financial year', 'financial_year')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Month', 'month')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Date paid', 'date_paid_formatted', 'date_paid')
                ->headerAttribute('text-capitalize fs-6'),

            Column::make('Comment', 'comment')
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
            Filter::inputText('member')->operators(['contains']),
            Filter::inputText('asset_type')->operators(['contains']),
            Filter::inputText('financial_year')->operators(['contains']),
            Filter::inputText('charge')->operators(['contains']),
            Filter::inputText('amount')->operators(['contains']),
            Filter::inputText('month')->operators(['contains']),
            Filter::inputText('comment')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $charge = Charge::findOrFail($rowId);
        $this->redirectRoute('charges.show', $charge);
    }

    public function actions(Charge $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id]),
        ];
    }
}
