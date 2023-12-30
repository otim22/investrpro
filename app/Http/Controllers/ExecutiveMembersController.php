<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExecutiveMembersController extends Controller
{
    /**
     * Show dashboard.
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $executiveMembers = [];
        if(Auth::user()->company) {
            $executiveMembers = Member::where('company_id', Auth::user()->company->id)->role('executive-member')->paginate(25);
        }
        return view('members.executive_members.index', compact('executiveMembers'));
    }
}
