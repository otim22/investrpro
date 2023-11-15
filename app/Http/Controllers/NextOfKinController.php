<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\NextOfKin;
use Illuminate\Http\Request;
use App\Http\Requests\NextOfKinRequest;
use App\Http\Requests\NextOfKinUpdateRequest;

class NextOfKinController extends Controller
{
    public function index(Member $member)
    {   
        return view('members.next_of_kin.index', compact('member'));
    }

    public function create(Member $member)
    {
        return view('members.next_of_kin.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NextOfKinRequest $request, Member $member)
    {
        $request->validated();

        $member = Member::create([
            'surname' => $request->surname,
            'given_name' => $request->given_name,
            'other_name' => $request->other_name,
            'relationship' => $request->relationship,
            'telephone_number' => $request->telephone_number,
            'email' => $request->email,
            'address' => $request->address,
            'nin' => $request->nin,
            'passport_number' => $request->passport_number,
            'member_id' => $member->id,
        ]);
        
        if($request->hasFile('relevant_document')) {
            $nextOfKin->addMedia($request->relevant_document)->toMediaCollection('relevant_document');
        } 
    
        return redirect()->route('next-of-kin.show', [$member, $nextOfKin])->with('success', 'Next of kin created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member, NextOfKin $nextOfKin)
    {
        return view('members.next_of_kin.show', compact(['member', 'nextOfKin']));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member, NextOfKin $nextOfKin)
    {
        return view('members.next_of_kin.edit', compact(['member', 'nextOfKin']));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NextOfKinUpdateRequest $request, Member $member, NextOfKin $nextOfKin)
    {
        $request->validated();
        $nextOfKin->update($request->except('relevant_document'));

        if($request->hasFile('relevant_document')) {
            foreach ($nextOfKin->media as $media) {
                $media->delete();
            }
            $nextOfKin->addMedia($request->relevant_document)->toMediaCollection('relevant_document');
        }

        return redirect()->route('next-of-kin.show', $member)->with('success','Next of kin updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member, NextOfKin $nextOfKin)
    {
        $nextOfKin->delete();
        return redirect()->route('member-registration.show', $member)->with('success','Next of kin deleted successfully');
    }
}
