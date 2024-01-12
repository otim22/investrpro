<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageLoanController extends Controller
{
    public function index()
    {
        return view('manage_loan.index');
    }
}
