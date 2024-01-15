<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanHistoryController extends Controller
{
    public function index()
    {
        return view('loan_history.index');
    }
}
