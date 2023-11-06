<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('member_savings.index', compact('members'));
    }

    public function create()
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('member_savings.create', compact('members'));
    }
}
