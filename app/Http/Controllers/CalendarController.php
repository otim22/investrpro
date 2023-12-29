<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        $events = [];
        foreach (Event::all() as $event) {
            $events[] = [
                'id' => $event->id, 
                'title' => $event->title,
                'start' => $event->start->toDateTimeString(),
                'end' => $event->end->toDateTimeString()
            ];
        }
        
        return view('calendar.index', compact('events'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|string',
            'start' => 'required',
            'end' => 'required',
        ]);

        $event = Event::create([
            'id' => $request->id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json($event);
    }
    
    public function update(Request $request, $id) 
    {
        $event = Event::findOrFail($id);
        if (!$event) {
            return response()->json([
                'error' => 'Unable to locate event',
            ], 404);
        }

        $event->update([
            'start' => $request->start,
            'end' => $request->end
        ]);
        
        return response()->json('Event updated');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if (!$event) {
            return response()->json([
                'error' => 'Unable to locate event',
            ], 404);
        }
        $event->delete();
        return $id;
    }
}
