<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class AllMembersController extends Controller
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
        $ordinaryMembers = Member::role('ordinary-member')->paginate(25);
        return view('members.all_members.index', compact('ordinaryMembers'));
    }
}
