<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $events = Event::with('profile')->get();
            return view('Event.index_events', compact('events'));
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Event.add_events');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'events' => 'required|string|max:12',
            'events_description' => 'required|string|min:12',
            'events_started' => 'required|date',
            'events_end' => 'required|date',
            'media_files.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov|max:2048',
        ]);

        if (!$validate) {
            return redirect()->route('events.index')->with('error', 'Failed to add Event!');
        }
        $event = new Event();
        $event->events = $request->input('events');
        $event->events_description = $request->input('events_description');
        $event->events_started = $request->input('events_started');
        $event->events_end = $request->input('events_end');
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('images/events/', $filename, 'public');
                $mediaUrls[] = $path;
            }
        }
        $event->events_images = json_encode($mediaUrls);
        $event->profile_id = $request->input('personnel_added');
        if ($event->save()) {
            return redirect()->route('events.index')->with('success', 'Added Event!');
        } else {
            return redirect()->route('events.index')->with('error', 'Failed to add Event!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('Event.view_event')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        if (Auth::check()) {
            return view('Event.edit_events')->with('event', $event);
        } else {
            return redirect()->route('login');
        }
    }

    public function update(Request $request, Event $event)
    {
        if (!$event) {
            return redirect()->back()->with('fail', 'Event not found.');
        }
        $event->events = $request->input('events', $event->events);
        $event->events_description = $request->input('events_description', $event->events_description);
        $event->events_started = $request->input('events_started', $event->events_started);
        $event->events_end = $request->input('events_end', $event->events_end);
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            if ($this->deleteEventMedia($event)) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/events/', $filename, 'public');
                    $mediaUrls[] = $path;
                }
                $event->events_images = json_encode($mediaUrls);
            } else {
                return redirect()->route('events.index')->with('error', 'Failed to add Event!');
            }
        }
        // If no new images uploaded, retain the existing images from the database
        if (!$request->hasFile('media_files')) {
            $mediaUrls = json_decode($event->events_images);
            // You can also perform validation here to ensure URLs are valid before updating
            $event->events_images = json_encode($mediaUrls);
        }
        $event->profile_id = $request->input('personnel_added', $event->profile_id);

        if ($event->save()) {
            return redirect()->route('events.index')->with('success', 'Update Event Successful!');
        } else {
            return redirect()->route('events.index')->with('error', 'Failed to add Event!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event) {
            if ($this->deleteEventMedia($event)) {
                $event->delete(); // Delete the event
                return redirect()->back()->with('success', 'Event deleted successfully!');
            }
            return redirect()->back()->with('error', 'Failed to delete the Event.');
        }
        return redirect()->back()->with('error', 'Failed to delete the Event.');
    }
    private function deleteEventMedia(Event $event)
    {
        if ($event) {
            $imagesToDelete = json_decode($event->events_images);
            foreach ($imagesToDelete as $image) {
                $storagePath = str_replace('storage/', '', $image);
                Storage::disk('public')->delete($storagePath);
            }
            return true;
        }
        return false;
    }
}
