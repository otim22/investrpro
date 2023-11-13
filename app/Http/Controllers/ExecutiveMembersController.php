<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $executiveMembers = [];
        if(Auth::user()->company) {
            $executiveMembers = Member::where('company_id', Auth::user()->company->id)->role('Executive Member')->paginate(25);
        }
        return view('members.executive_members.index', compact('executiveMembers'));
    }
}
