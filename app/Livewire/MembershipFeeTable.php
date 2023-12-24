<?php

namespace App\Livewire;

use App\Models\MembershipFee;
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

final class MembershipFeeTable extends PowerGridComponent
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
        return MembershipFee::query()->join('members', 'membership_fees.member_id', '=', 'members.id')
            ->select('membership_fees.*', 'members.surname as member');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('member')
            ->addColumn('fee_amount')
            ->addColumn('year_paid_for')
            ->addColumn('date_of_payment_formatted', function (MembershipFee $model) { 
                return Carbon::parse($model->date_of_payment)->format('d/m/Y');
            })
            ->addColumn('comment');
    }

    public function columns(): array
    {
        return [
            Column::make('Member', 'member')
                ->sortable()
                ->searchable(),

            Column::make('Fee amount', 'fee_amount')
                ->sortable()
                ->searchable(),

            Column::make('Year paid for', 'year_paid_for')
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
            Filter::inputText('member')->operators(['contains']),
            Filter::inputText('fee_amount')->operators(['contains']),
            Filter::inputText('year_paid_for')->operators(['contains']),
            Filter::inputText('comment')->operators(['contains']),
        ];
    }

    #[\Livewire\Attributes\On('show')]
    public function show($rowId)
    {
        $membershipFee = MembershipFee::findOrFail($rowId);
        $this->redirectRoute('membership-fees.show', $membershipFee);
    }

    public function actions(MembershipFee $row): array
    {
        return [
            Button::add('show')
                ->slot('View')
                ->class('btn btn-sm btn-primary')
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
