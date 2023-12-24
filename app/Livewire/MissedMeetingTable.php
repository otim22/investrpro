<?php

namespace App\Livewire;

use App\Models\MissedMeeting;
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

final class MissedMeetingTable extends PowerGridComponent
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
        return MissedMeeting::query()->join('members', 'missed_meetings.member_id', '=', 'members.id')
            ->select('missed_meetings.*', 'members.surname as member');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('member')
            ->addColumn('charge_paid_for')
            ->addColumn('financial_year')
            ->addColumn('charge_amount')
            ->addColumn('month_paid_for')
            ->addColumn('date_of_payment_formatted', function (MissedMeeting $model) { 
                return Carbon::parse($model->date_of_payment)->format('d/m/Y');
            })
            ->addColumn('comment', function (MissedMeeting $model) {
                return \Str::words(e($model->comment), 5); 
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Member', 'member')
                ->sortable()
                ->searchable(),

            Column::make('Charge paid for', 'charge_paid_for')
                ->sortable()
                ->searchable(),

            Column::make('Charge amount', 'charge_amount')
                ->sortable()
                ->searchable(),

            Column::make('Financial year', 'financial_year')
                ->sortable()
                ->searchable(),


            Column::make('Month paid for', 'month_paid_for')
                ->sortable()
                ->searchable(),

            Column::make('Date of payment', 'date_of_payment_formatted', 'date_of_payment')
                ->sortable(),

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
            Filter::inputText('month_paid_for')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $missedMeeting = MissedMeeting::findOrFail($rowId);
        $this->redirectRoute('missed-meetings.show', $missedMeeting);
    }

    public function actions(MissedMeeting $row): array
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
