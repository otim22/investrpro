<?php

namespace App\Livewire;

use App\Models\Asset;
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

final class AssetTable extends PowerGridComponent
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
        return Asset::query()->join('members', 'assets.member_id', '=', 'members.id')
            ->select('assets.*', 'members.surname as member');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('member')
            ->addColumn('asset')
            ->addColumn('amount', function (Asset $model) { 
                return number_format($model->amount);
            })
            ->addColumn('financial_year')
            ->addColumn('date_paid_formatted', function (Asset $model) { 
                return Carbon::parse($model->date_paid)->format('d/m/Y');
            })
            ->addColumn('has_paid', function (Asset $model) {
                return ($model->has_paid ? 'Yes' : 'No');
            })
            ->addColumn('comment', function (Asset $model) {
                return \Str::words(e($model->comment), 5); 
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Member", 'member')
                ->sortable()
                ->headerAttribute('text-capitalize fs-6')
                ->searchable(),

            Column::make('Asset Name', 'asset')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),

            Column::make('Amount', 'amount')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable(),

            Column::make('Financial Year', 'financial_year')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Date Paid', 'date_paid_formatted')
                ->headerAttribute('text-capitalize fs-6'),

            Column::make('Comment', 'comment')
                ->headerAttribute('text-capitalize fs-6')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'has_paid')
                ->headerAttribute('text-capitalize fs-6'),

            Column::action('Action')
                ->headerAttribute('text-capitalize fs-6')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('member')->operators(['contains']),
            Filter::inputText('asset')->operators(['contains']),
            Filter::inputText('amount')->operators(['contains']),
            Filter::inputText('financial_year')->operators(['contains']),
            Filter::boolean('has_paid')->label('Yes', 'No'),
            Filter::inputText('comment')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $asset = Asset::findOrFail($rowId);
        $this->redirectRoute('assets.show', $asset);
    }

    public function actions(Asset $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
                ->dispatch('show', ['rowId' => $row->id]),
        ];
    }
}
