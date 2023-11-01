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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $members = Member::orderBy('id', 'desc')->paginate(5);
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

        $member = new Member();
        $member->surname = $request->surname;
        $member->given_name = $request->given_name;
        $member->other_name = $request->other_name;
        $member->date_of_birth = $request->date_of_birth;
        $member->telephone_number = $request->telephone_number;
        $member->email = $request->email;
        $member->address = $request->address;
        $member->occupation = $request->occupation;
        $member->nin = $request->nin;
        $member->passport_number = $request->passport_number;
        $member->company_id = Auth::user()->company->id;
        $member->save();

        $member->assignRole('ordinary-member');
        
        if($request->hasFile('relevant_document')) {
            $member->addMedia($request->relevant_document)->toMediaCollection('relevant_document');
        } 
    
        return redirect()->route('next-of-kin.create', $member)->with('success', 'Member created successfully');
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
        return view('members.member.edit', compact('member'));
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
