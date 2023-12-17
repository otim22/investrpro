<?php

namespace App\Livewire;

use App\Models\MemberSaving;
use App\Livewire\MemberSavingShow;
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

final class MemberSavingTable extends PowerGridComponent
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
        return MemberSaving::query()->join('members', 'member_savings.member_id', '=', 'members.id')
            ->select('member_savings.*', 'members.surname as member');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('member')
            ->addColumn('asset_name')
            ->addColumn('asset_type')
            ->addColumn('premium')
            ->addColumn('financial_year')
            ->addColumn('month')
            // ->addColumn('date_paid_formatted', fn (MemberSaving $model) => Carbon::parse($model->date_paid)->format('d/m/Y'))
            ->addColumn('comment');
    }

    public function columns(): array
    {
        return [
            Column::make('Member', 'member')
                ->sortable()
                ->searchable(),

            Column::make('Asset Name', 'asset_name')
                ->sortable(),

            Column::make('Asset Type', 'asset_type')
                ->sortable()
                ->searchable(),

            Column::make('Premium', 'premium')
                ->sortable(),


            Column::make('Financial Year', 'financial_year')
                ->sortable()
                ->searchable(),

            Column::make('Month', 'month')
                ->sortable()
                ->searchable(),

            Column::make('Date Paid', 'date_paid_formatted'),

            Column::make('Comment', 'comment')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('financial_year')->operators(['contains']),
            Filter::inputText('month')->operators(['contains']),
            Filter::datetimepicker('date_paid'),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $memberSaving = MemberSaving::findOrFail($rowId);
        $this->redirectRoute('member-savings.show', $memberSaving);
    }

    public function actions(\App\Models\MemberSaving $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary mb-1')
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
