<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $announcements = Announcement::with('profile')->get();
            return view('Announcement.index_announcement', compact('announcements'));
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
        return view('Announcement.add_announcement');
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
            'announcements' => 'required|string',
            'announcements_what' => 'required|string',
            'announcements_who' => 'required|string',
            'announcements_when' => 'required|date',
            'announcements_where' => 'required|string',
            'announcements_why' => 'required|string',
            'announcements_how' => 'required|string',
            'media_files.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov|max:2048',
        ]);
        if (!$validate) {
            return redirect()->back()->with('error', 'Failed to add Announcement!');
        }
        $announcements = new Announcement();
        $announcements->announcements = $request->input('announcements');
        $announcements->announcements_what = $request->input('announcements_what');
        $announcements->announcements_who = $request->input('announcements_who');
        $announcements->announcements_when = $request->input('announcements_when');
        $announcements->announcements_where = $request->input('announcements_where');
        $announcements->announcements_why = $request->input('announcements_why');
        $announcements->announcements_how = $request->input('announcements_how');

        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('images/announcement/', $filename, 'public');
                $mediaUrls[] = $path;
            }
        }
        $announcements->announcements_images = json_encode($mediaUrls);
        $announcements->profile_id = $request->input('profile_id');
        if ($announcements->save()) {
            return redirect()->back()->with('success', 'Added Announcements!');
        } else {
            return redirect()->back()->with('error', 'Failed to add Announcements!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Announcement $announcement)
    {
        return view('Announcement.view_announcement')->with('announcement', $announcement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Announcement $announcement)
    {
        if (Auth::check()) {
            return view('Announcement.edit_announcement')->with('announcement', $announcement);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Announcement $announcement)
    {
        if (!$announcement) {
            return redirect()->route('announcements.index')->with('error', 'Announcement not found.');
        }
        $announcement->announcements = $request->input('announcements', $announcement->announcements);
        $announcement->announcements_what = $request->input('announcements_what', $announcement->announcements_what);
        $announcement->announcements_who = $request->input('announcement_who', $announcement->announcements_who);
        $announcement->announcements_when = $request->input('announcements_when', $announcement->announcements_when);
        $announcement->announcements_where = $request->input('announcements_where', $announcement->announcements_where);
        $announcement->announcements_why = $request->input('announcements_why', $announcement->announcements_why);
        $announcement->announcements_how = $request->input('announcements_how', $announcement->announcements_how);
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            if ($this->deleteAnnouncementMedia($announcement)) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/announcements/', $filename, 'public');
                    $mediaUrls[] = $path;
                }
                $announcement->announcements_images = json_encode($mediaUrls);
            } else {
                return redirect()->route('announcements.index')->with('error', 'Failed to update Announcement!');
            }
        }
        // If no new images uploaded, retain the existing images from the database
        if (!$request->hasFile('media_files')) {
            $mediaUrls = json_decode($announcement->announcements_images);

            // You can also perform validation here to ensure URLs are valid before updating
            $announcement->announcements_images = json_encode($mediaUrls);
        }
        $announcement->profile_id = $request->input('profile_id', $announcement->profile_id);

        if ($announcement->save()) {
            return redirect()->route('announcements.index')->with('success', 'Update Announcement Successful!');
        } else {
            return redirect()->route('announcements.index')->with('error', 'Failed to update Announcement!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Announcement $announcement)
    {
        if (!$announcement) {
            return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
        } else {
            if ($this->deleteAnnouncementMedia($announcement)) {
                $announcement->delete();
                return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully!');
            } else {
                return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
            }
        }
        return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
    }
    private function deleteAnnouncementMedia($announcement)
    {
        if ($announcement) {
            $imagesToDelete = json_decode($announcement->announcements_images);
            foreach ($imagesToDelete as $image) {
                $storagePath = str_replace('storage/', '', $image);
                Storage::disk('public')->delete($storagePath);
            }
            return true;
        }
        return false;
    }
}
