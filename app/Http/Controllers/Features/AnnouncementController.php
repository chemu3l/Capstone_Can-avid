<?php

namespace App\Http\Controllers\Features;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Features\LogsController;

class AnnouncementController extends Controller
{
    public function search(Announcement $announcement)
    {
        return view('Announcement.view_announcement')->with('announcement', $announcement);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == "Admin" || Auth::user()->role == "Principal") {
                $announcements = Announcement::with('profile')->get();
            } elseif (Auth::user()->role == "Registrar") {
                $announcements = Announcement::with('profile')
                    ->where(function ($query) {
                        $query->where('status', 'Pending');
                    })
                    ->get();
            } else {
                $announcements = Announcement::with('profile')->where('status', 'Pending')->get();
            }
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
        try {
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
            $errors = [];

            if (empty($request->input('announcements'))) {
                $errors['announcements'] = 'The Announcements field is required.';
            }

            if (empty($request->input('announcements_what'))) {
                $errors['announcements_what'] = 'The What field is required.';
            }

            if (empty($request->input('announcements_who'))) {
                $errors['announcements_who'] = 'The Who field is required.';
            }

            if (empty($request->input('announcements_when')) || !strtotime($request->input('announcements_when'))) {
                $errors['announcements_when'] = 'The When field must be a valid date.';
            }

            if (empty($request->input('announcements_where'))) {
                $errors['announcements_where'] = 'The Where field is required.';
            }

            if (empty($request->input('announcements_why'))) {
                $errors['announcements_why'] = 'The Why field is required.';
            }

            if (empty($request->input('announcements_how'))) {
                $errors['announcements_how'] = 'The How field is required.';
            }

            if (!$request->hasFile('media_files') || count($request->file('media_files')) < 1) {
                $errors['media_files'] = 'Please upload at least one media file.';
            } else {
                foreach ($request->file('media_files') as $file) {
                    if (!$file->isValid()) {
                        $errors['media_files'] = 'Each media file must be a valid file.';
                        break;
                    }
                    if ($file->getSize() > 2048000) {
                        $errors['media_files'] = 'Each media file should not exceed 2MB in size.';
                        break;
                    }
                }
            }

            if (!empty($errors)) {
                return redirect()->route('announcements.create')->withErrors($errors)->with('error', 'Validation error: Please check the form for errors.');
            }
            $announcements = new Announcement();
            $announcements->announcements = $request->input('announcements');
            $announcements->announcements_what = $request->input('announcements_what');
            $announcements->announcements_who = $request->input('announcements_who');
            $announcements->announcements_when = $request->input('announcements_when');
            $announcements->announcements_where = $request->input('announcements_where');
            $announcements->announcements_why = $request->input('announcements_why');
            $announcements->announcements_how = $request->input('announcements_how');
            if (Auth::user()->role == "Faculty") {
                $announcements->status = "Pending";
            } elseif (Auth::user()->role == "Registrar") {
                $announcements->status = "Registrar Verified";
            } else {
                $announcements->status = "Posted";
            }
            $mediaUrls = [];
            if ($request->hasFile('media_files')) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/announcement/', $filename, 'public');
                    $mediaUrls[] = $path;
                }
            }else{
                return redirect()->route('announcements.create')->with('error', 'Please Add some image or a video');
            }
            $announcements->announcements_images = json_encode($mediaUrls);
            $announcements->profile_id = $request->input('profile_id');
            $historyRequest = new Request([
                'action' => 'Store',
                'type' => 'Announcement',
                'oldData' => $announcements->announcements,
                'newData' => $request->input('announcements'),
                'date' => date('Y-m-d H:i:s')
            ]);
            $history = new LogsController();
            $history->store($historyRequest);
            if ($announcements->save()) {
                return redirect()->back()->with('success', 'Added Announcements!');
            } else {
                return redirect()->route('announcements.create')->with('error', 'Failed to add Announcements!');
            }
        } catch (\Throwable $e) {
            return redirect()->route('announcements.create')->with('error', $e->getMessage());
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
        try {
            if (!$announcement) {
                return redirect()->route('announcements.edit')->with('error', 'Announcement not found.');
            }
            $announcement->announcements = $request->input('announcements', $announcement->announcements);
            $announcement->announcements_what = $request->input('announcements_what', $announcement->announcements_what);
            $announcement->announcements_who = $request->input('announcement_who', $announcement->announcements_who);
            $announcement->announcements_when = $request->input('announcements_when', $announcement->announcements_when);
            $announcement->announcements_where = $request->input('announcements_where', $announcement->announcements_where);
            $announcement->announcements_why = $request->input('announcements_why', $announcement->announcements_why);
            $announcement->announcements_how = $request->input('announcements_how', $announcement->announcements_how);
            $announcement->status = $request->input('status', $announcement->status);
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
                    return redirect()->route('announcements.edit')->with('error', 'Failed to update Announcement!');
                }
            }
            // If no new images uploaded, retain the existing images from the database
            if (!$request->hasFile('media_files')) {
                $mediaUrls = json_decode($announcement->announcements_images);

                // You can also perform validation here to ensure URLs are valid before updating
                $announcement->announcements_images = json_encode($mediaUrls);
            }
            $announcement->profile_id = $request->input('profile_id', $announcement->profile_id);
            $historyRequest = new Request([
                'action' => 'Update',
                'type' => 'Announcement',
                'oldData' => $announcement->announcements,
                'newData' => $request->input('announcements'),
                'date' => date('Y-m-d H:i:s')
            ]);
            $history = new LogsController();
            $history->store($historyRequest);
            if ($announcement->save()) {
                return redirect()->route('announcements.index')->with('success', 'Update Announcement Successful!');
            } else {
                return redirect()->route('announcements.edit')->with('error', 'Failed to update Announcement!');
            }
        } catch (\Throwable $e) {
            return redirect()->route('announcements.edit')->with('error', 'Failed to update Announcement: ' . $e->getMessage());
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
        try {
            if (!$announcement) {
                return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
            } else {
                if ($this->deleteAnnouncementMedia($announcement)) {
                    $historyRequest = new Request([
                        'action' => 'Delete',
                        'type' => 'Announcement',
                        'oldData' => null,
                        'newData' => $announcement->announcements,
                        'date' => date('Y-m-d H:i:s')
                    ]);
                    $history = new LogsController();
                    $history->store($historyRequest);
                    $announcement->delete();
                    return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully!');
                } else {
                    return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
                }
            }
            return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement.');
        } catch (\Throwable $e) {
            return redirect()->route('announcements.index')->with('error', 'Failed to delete the Announcement: ' . $e->getMessage());
        }
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
