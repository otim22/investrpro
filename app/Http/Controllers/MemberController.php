<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\MemberRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MemberUpdateRequest;

class MemberController extends Controller
{
    public function index()
    {   
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->paginate(5);
        }
        return view('members.member.index', compact('members'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('members.member.create', compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $request->validated();
        
        $member = Member::create([
            'surname' => $request->surname,
            'given_name' => $request->given_name,
            'other_name' => $request->other_name,
            'code' => $request->code,
            'date_of_birth' => $request->date_of_birth,
            'telephone_number' => $request->telephone_number,
            'email' => $request->email,
            'address' => $request->address,
            'occupation' => $request->occupation,
            'nin' => $request->nin,
            'passport_number' => $request->passport_number,
            'company_id' => Auth::user()->company->id,
        ]);

        $member->assignRole($request->member_role);
        
        if($request->hasFile('relevant_document')) {
            $member->addMedia($request->relevant_document)->toMediaCollection('relevant_document');
        } 

        if($request->hasFile('conscent_form')) {
            $member->addMedia($request->conscent_form)->toMediaCollection('conscent_form');
        } 
    
        return redirect()->route('members.show', $member)->with('success', 'Member created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return view('members.member.show', compact('member'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        $roles = Role::all();
        return view('members.member.edit', compact(['member', 'roles']));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberUpdateRequest $request, Member $member)
    {
        $request->validated();
        $member->update($request->except('relevant_document'));

        if($request->hasFile('relevant_document')) {
            foreach ($member->media as $media) {
                $media->delete();
            }
            $member->addMedia($request->relevant_document)->toMediaCollection('relevant_document');
        }
        
        if($request->hasFile('conscent_form')) {
            foreach ($member->media as $media) {
                $media->delete();
            }
            $member->addMedia($request->conscent_form)->toMediaCollection('conscent_form');
        }

        return redirect()->route('members.show', $member)->with('success','Member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success','Member deleted successfully');
    }
}
