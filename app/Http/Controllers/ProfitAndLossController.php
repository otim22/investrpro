<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfitAndLossController extends Controller
{
    public function index()
    {
        return view('profit_and_loss.index');
    }
}
