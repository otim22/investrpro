<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberSavingsController extends Controller
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

    public function index()
    {
        return view('member_savings.index');
    }

    public function create()
    {
        return view('member_savings.create');
    }
}
