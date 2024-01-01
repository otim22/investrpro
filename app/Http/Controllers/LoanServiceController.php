<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanServiceController extends Controller
{
    public function index() 
    {
        return view('loan_service.index');
    }
}
