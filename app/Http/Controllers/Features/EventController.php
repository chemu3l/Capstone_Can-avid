<?php


namespace App\Http\Controllers\Features;


use App\Models\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $events = Event::with('profile')->get();
            return view('dashboard.user.admin.admin_tables.events_table', compact('events'));
        } else {
            return redirect()->route('user.login');
        }
    }

    public function createEvent(Request $request)
    {
        $validate = $request->validate([
            'events' => 'required|string|max:12',
            'events_description' => 'required|string|min:12',
            'events_scheduled' => 'required|date',
            'media_files.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov|max:2048',
        ]);

        if (!$validate) {
            return redirect()->back()->with('fail', 'Failed to add Event!');
        }
        $event = new Event();
        $event->events = $request->input('events');
        $event->events_description = $request->input('events_description');
        $event->events_scheduled = $request->input('events_scheduled');
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
            return redirect()->back()->with('success', 'Added Event!');
        } else {
            return redirect()->back()->with('fail', 'Failed to add Event!');
        }
    }

    public function updateEvent(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required'
        ]);
        $event = Event::find($validate['id']);
        if (!$event) {
            return redirect()->back()->with('fail', 'Event not found.');
        }

        $event->events = $request->input('events', $event->events);
        $event->events_description = $request->input('events_description', $event->events_description);
        $event->events_scheduled = $request->input('events_scheduled', $event->events_scheduled);
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            $eventId = $event->id;
            if ($this->deleteEventMedia($eventId)) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/events/', $filename, 'public');
                    $mediaUrls[] = $path;
                }
                $event->events_images = json_encode($mediaUrls);
            }
            else {
                return redirect()->back()->with('error', 'Failed to update Event!');
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
            return redirect()->back()->with('success', 'Update Event Successful!');
        } else {
            return redirect()->back()->with('errro', 'Failed to update Event!');
        }
    }

    public function deleteEvent(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required'
        ]);
        $event = Event::find($validate['id']);
        if ($event) {
            $eventId = $event->id;
            if ($this->deleteEventMedia($eventId)) {
                $event->delete(); // Delete the event
                return redirect()->back()->with('success', 'Event and associated images deleted successfully!');
            }
            return redirect()->back()->with('error', 'Failed to delete the Event.');
        }
        return redirect()->back()->with('error', 'Failed to delete the Event.');
    }

    private function deleteEventMedia($eventId)
    {
        $event = Event::find($eventId);
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
