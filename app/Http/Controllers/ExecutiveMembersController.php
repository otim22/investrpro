<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class ExecutiveMembersController extends Controller
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
        $executiveMembers = Member::role('executive-member')->get();
        return view('members.executive_members.index', compact('executiveMembers'));
    }
}
