<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MeetingRequest;
use App\Http\Requests\MeetingUpdateRequest;

class MeetingController extends Controller
{
    public function index() 
    {
        $meetings = [];
        if(Auth::user()->company) {
            $meetings = Meeting::with('attendance')->where('company_id', Auth::user()->company->id)->paginate(25);
        }
        return view('meeting.index', compact('meetings'));
    }

    public function create()
    {
        return view('meeting.create');
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(MeetingRequest $request)
    {
        $request->validated();
        $meeting = Meeting::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'company_id' => Auth::user()->company->id,
        ]); 
        return redirect()->route('meetings.index')->with("success", $meeting->title . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('meeting.show', compact('meeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        return view('meeting.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MeetingUpdateRequest $request, Meeting $meeting)
    {
        $request->validated();
        $meeting->update($request->all());
        return redirect()->route('meetings.index', $meeting)->with('success', $meeting->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully');
    }
}
