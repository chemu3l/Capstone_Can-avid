<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Features\LogsController;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == "Admin" || Auth::user()->role == "Principal") {
                $news = News::with('profile')->get();
            } elseif (Auth::user()->role == "Registrar") {
                $news = News::with('profile')
                    ->where(function ($query) {
                        $query->where('status', 'Pending');
                    })
                    ->get();
            } else {
                $news = News::with('profile')->where('status', 'Pending')->get();
            }
            return view('News.index_news', compact('news'));
        } else {
            return redirect()->route('Landing_page');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('News.add_news');
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
            $news = new News();
            $news->news = $request->input('news');
            $news->news_description = $request->input('news_description');
            $news->news_updated = $request->input('news_update');
            if (Auth::user()->role == "Faculty") {
                $news->status = "Pending";
            } elseif (Auth::user()->role == "Registrar") {
                $news->status = "Registrar Verified";
            } else {
                $news->status = "Posted";
            }

            $mediaUrls = [];
            if ($request->hasFile('media_files')) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/news', $filename, 'public');
                    $mediaUrls[] = $path;
                }
            }else {
                return redirect()->route('news.create')->with('error', 'Please Add some image or a video');
            }
            $news->news_images = json_encode($mediaUrls);
            $news->profile_id = $request->input('personnel_added');
            $historyRequest = new Request([
                'action' => 'Stored',
                'type' => 'News',
                'oldData' => $news->news,
                'newData' => $request->input('news'),
                'date' => date('Y-m-d H:i:s')
            ]);
            $history = new LogsController();
            $history->store($historyRequest);
            if ($news->save()) {
                return redirect()->route('news.index')->with('success', 'Added News!');
            } else {
                return redirect()->route('news.create')->with('error', 'Failed to add News!');
            }
        } catch (\Throwable $e) {
            return redirect()->route('news.create')->with('error', 'Supported media file types are JPEG, PNG, JPG, GIF, and MP4, and the maximum file size is 2MB.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('News.view_news')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        if (Auth::check()) {
            return view('News.edit_news')->with('news', $news);
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
    public function update(Request $request, News $news)
    {
        try {
            if (!$news) {
                return redirect()->back()->with('fail', 'News not found.');
            }

            $news->news = $request->input('news', $news->news);
            $news->news_description = $request->input('news_description', $news->news_description);
            $news->status = $request->input('status', $news->status);
            $news->news_updated = $request->input('news_scheduled', $news->news_updated);
            $mediaUrls = [];
            if ($request->hasFile('media_files')) {
                if ($this->deleteNewsMedia($news)) {
                    foreach ($request->file('media_files') as $file) {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $path = $file->storeAs('images/news', $filename, 'public');
                        $mediaUrls[] = $path;
                    }
                    $news->news_images = json_encode($mediaUrls);
                } else {
                    return redirect()->route('news.edit')->with('error', 'Failed to update News!');
                }
            }
            // If no new images uploaded, retain the existing images from the database
            if (!$request->hasFile('media_files')) {
                $mediaUrls = json_decode($news->news_images);

                // You can also perform validation here to ensure URLs are valid before updating
                $news->news_images = json_encode($mediaUrls);
            }
            $news->profile_id = $request->input('personnel_added', $news->profile_id);
            $historyRequest = new Request([
                'action' => 'Updated',
                'type' => 'News',
                'oldData' => $news->news,
                'newData' => $request->input('news'),
                'date' => date('Y-m-d H:i:s')
            ]);
            $history = new LogsController();
            $history->store($historyRequest);
            if ($news->save()) {
                return redirect()->route('news.index')->with('success', 'Update News Successful!');
            } else {
                return redirect()->route('news.edit')->with('error', 'Failed to update News!');
            }
        } catch (\Throwable $e) {
            return redirect()->route('news.edit')->with('error', 'Supported media file types are JPEG, PNG, JPG, GIF, and MP4, and the maximum file size is 2MB.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        try {
            if ($news) {
                if ($this->deleteNewsMedia($news)) {
                    $historyRequest = new Request([
                        'action' => 'Deleted',
                        'type' => 'News',
                        'oldData' => null,
                        'newData' => $news->news,
                        'date' => date('Y-m-d H:i:s')
                    ]);
                    $history = new LogsController();
                    $history->store($historyRequest);
                    $news->delete(); // Delete the event
                    return redirect()->back()->with('success', 'News deleted successfully!');
                }
                return redirect()->back()->with('error', 'Failed to delete the News.');
            }
            return redirect()->back()->with('error', 'Failed to delete the News.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Failed to delete the News: ' . $e->getMessage());
        }
    }
    private function deleteNewsMedia(News $news)
    {
        if ($news) {
            $imagesToDelete = json_decode($news->news_images);
            foreach ($imagesToDelete as $image) {
                $storagePath = str_replace('storage/', '', $image);
                Storage::disk('public')->delete($storagePath);
            }
            return true;
        }
        return false;
    }
}
