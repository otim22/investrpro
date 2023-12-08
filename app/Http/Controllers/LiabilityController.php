<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\LiabilityType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LiabilityRequest;
use App\DataTables\ExpensesDataTable;
use App\Http\Requests\LiabilityUpdateRequest;

class LiabilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(ExpensesDataTable $dataTable)
    {
        $liabilities = [];

        if(Auth::user()->company) {
            $liabilities = Expense::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
            $totalValue = Expense::where('company_id', Auth::user()->company->id)->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $currentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Current Liabilities'
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
            $nonCurrentLiabilities = Expense::where([
                'company_id' => Auth::user()->company->id,
                'liability_type' => 'Non Current Liabilities'
            ])->get()->reduce(function($carry, $item){
                $subTotal = $item->amount * $item->rate;
                return $carry += $subTotal;
            }, 0);
        } 

        return $dataTable->render('liabilities.liability.index', compact([
            'liabilities', 
            'totalValue', 
            'currentLiabilities',
            'nonCurrentLiabilities',
        ]));
    }
}
