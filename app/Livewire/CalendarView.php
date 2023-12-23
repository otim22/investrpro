<?php

namespace App\Livewire;

use App\Livewire\EventCreate;
use Carbon\Carbon;
use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Validator;

class CalendarView extends Component
{
    public $isOpen = false;

    public function newEvent($name, $startTime, $endTime) 
    {
        $validated = Validator::make(
            [
                'name' => $name,
                'start_time' => $startTime,
                'end_time' => $endTime,
            ],
            [
                'name' => 'required|min:1|max:40',
                'start_time' => 'required',
                'end_time' => 'required'
            ]
        )->validate();
        $event = Event::create($validated);
        return $event->id;
    }
    
    public function updateEvent($id, $name, $startTime, $endTime) 
    {
        $validated = Validator::make(
            [
                'start_time' => $startTime,
                'end_time' => $endTime
            ],
            [
                'start_time' => 'required',
                'end_time' => 'required'
            ]
        )->validate();
        Event::findOrFail($id)->update($validated);
    }

     public function openModal()
    {
        // $this->isOpen = true;
        // dd($this->isOpen);
        // $this->dispatch('openModal');
        $this->dispatch('openModal')->to(EventCreate::class);
    }

    public function render()
    {
        $events = [];
        foreach (Event::all() as $event) {
            $events[] = [
                'id' => $event->id, 
                'title' => $event->name,
                'start' => $event->start_time->toIso8601String(),
                'end' => $event->end_time->toIso8601String()
            ];
        }
        
        return view('livewire.calendar-view', [
            'events' => $events
        ]);
    }
}
