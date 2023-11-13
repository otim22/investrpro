<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $ordinaryMembers = [];
        if(Auth::user()->company) {
            $ordinaryMembers = Member::where('company_id', Auth::user()->company->id)->role('Ordinary Member')->paginate(25);
        }
        return view('members.all_members.index', compact('ordinaryMembers'));
    }
}
