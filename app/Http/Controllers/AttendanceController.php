<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\AttendanceUpdateRequest;

class AttendanceController extends Controller
{
    public function index(Meeting $meeting) 
    {
        $attendances = [];
        if(Auth::user()->company) {
            $attendances = Attendance::where('company_id', Auth::user()->company->id)->paginate(25);
        }
        return view('attendance.index', compact(['attendances', 'meeting']));
    }

    public function create(Meeting $meeting)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('attendance.create', compact(['meeting', 'members']));
    }
 
    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceRequest $request, Meeting $meeting)
    {
        $request->validated();
        $attendance = attendance::create([
            'title' => $request->title,
            'has_attended' => $request->has_attended,
            'member_id' => $request->member_id,
            'meeting_id' => $meeting->id,
            'company_id' => Auth::user()->company->id,
        ]); 
        return redirect()->route('attendances.index', $meeting)->with("success", $attendance->title . " saved successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting, Attendance $attendance)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('attendance.show', compact(['meeting', 'attendance', 'members']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting, Attendance $attendance)
    {
        $members = [];
        if(Auth::user()->company) {
            $members = Member::where('company_id', Auth::user()->company->id)->orderBy('id', 'asc')->get();
        }
        return view('attendance.edit', compact(['meeting', 'attendance', 'members']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceUpdateRequest $request, Meeting $meeting, Attendance $attendance)
    {
        $request->validated();
        $attendance->update($request->all());
        return redirect()->route('attendances.index', $meeting)->with('success', $attendance->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(Meeting $meeting, Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index', $meeting)->with('success', 'Attendance list deleted successfully');
    }
}
