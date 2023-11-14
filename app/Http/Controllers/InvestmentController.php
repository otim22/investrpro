<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $investments = [];
        if(Auth::user()->company) {
            $investments = Investment::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('investments.index', compact('investments'));
    }
}
