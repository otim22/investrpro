<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use App\DataTables\AssetsDataTable;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index(AssetsDataTable $dataTable)
    {
        $assets = Asset::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        return $dataTable->render('home', compact('assets'));
    }
}
