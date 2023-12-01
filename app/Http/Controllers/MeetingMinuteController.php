<?php

namespace App\Http\Controllers;

use App\Models\MeetingMinute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MeetingMinuteRequest;
use App\Http\Requests\MeetingMinuteUpdateRequest;

class MeetingMinuteController extends Controller
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
        $meetingMinutes = [];
        if(Auth::user()->company) {
            $meetingMinutes = MeetingMinute::where('company_id', Auth::user()->company->id)->orderBy('id', 'desc')->get();
        }
        return view('meeting_minutes.index', compact('meetingMinutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meeting_minutes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MeetingMinuteRequest $request)
    {
        $request->validated();

        $meetingMinute = MeetingMinute::create([
            'title' => $request->title,
            'description' => $request->description,
            'company_id' => Auth::user()->company->id,
        ]); 

        if($request->hasFile('doc_attachement')) {
            $meetingMinute->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        } 

        return redirect()->route('meeting-minutes.index')->with("success", $meetingMinute->title . " created successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingMinute $meetingMinute)
    {
        $meetingMinuteUrl = $meetingMinute->getFirstMediaUrl('doc_attachement');
        return view('meeting_minutes.show', compact(['meetingMinute', 'meetingMinuteUrl']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingMinute $meetingMinute)
    {
        return view('meeting_minutes.edit', compact('meetingMinute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MeetingMinuteUpdateRequest $request, MeetingMinute $meetingMinute)
    {
        $request->validated();
        $meetingMinute->update($request->except('doc_attachement'));
        if($request->hasFile('doc_attachement')) {
            $meetingMinute->clearMediaCollection('doc_attachement');
            $meetingMinute->addMedia($request->doc_attachement)->toMediaCollection('doc_attachement');
        }
        return redirect()->route('meeting-minutes.index', $meetingMinute)->with('success', $meetingMinute->title . ' updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
    */
    public function destroy(MeetingMinute $meetingMinute)
    {
        $meetingMinute->delete();
        return redirect()->route('meeting-minutes.index')->with('success', 'Meeting minute deleted successfully');
    }

    public function download($id)
    {
        $meetingMinute = MeetingMinute::findOrFail($id);
        $path = $meetingMinute->getFirstMedia('doc_attachement')->getPath();
        $file_name = $meetingMinute->getFirstMedia('doc_attachement')->file_name;
        return response()->download($path, $file_name);
    }
}