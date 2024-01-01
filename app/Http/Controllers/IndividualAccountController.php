<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndividualAccountController extends Controller
{
    public function index() 
    {
        return view('individual_account.index');
    }
}
