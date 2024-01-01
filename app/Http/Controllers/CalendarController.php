<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MeetingRequest;

class CalendarController extends Controller
{
    public function index()
    {
        $meetings = [];
        $dbMeetings = Meeting::where(['company_id' => Auth::user()->company->id])->get();
        foreach ($dbMeetings as $dbMeeting) {
            $meetings[] = [
                'id' => $dbMeeting->id, 
                'title' => $dbMeeting->title,
                'start' => $dbMeeting->start->toDateTimeString(),
                'end' => $dbMeeting->end->toDateTimeString()
            ];
        }
        return view('calendar.index', compact('meetings'));
    }

    public function store(MeetingRequest $request) 
    {
        $request->validate([
            'title' => 'required|string',
            'start' => 'required',
            'end' => 'required',
        ]);
        $meeting = Meeting::create([
            'id' => $request->id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'company_id' => Auth::user()->company->id,
        ]);
        return response()->json($meeting);
    }
    
    public function update(Request $request, $id) 
    {
        $meeting = Meeting::findOrFail($id);
        if (!$meeting) {
            return response()->json([
                'error' => 'Unable to locate meeting',
            ], 404);
        }
        $meeting->update([
            'start' => $request->start,
            'end' => $request->end
        ]);
        return response()->json('Meeting updated');
    }

    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        if (!$meeting) {
            return response()->json([
                'error' => 'Unable to locate meeting',
            ], 404);
        }
        $meeting->delete();
        return $id;
    }
}
