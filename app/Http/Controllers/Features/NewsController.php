<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            $news = News::with('profile')->get();
            return view('News.index_news', compact('news'));
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
        $validate = $request->validate([
            'news' => 'required|string|max:12',
            'news_description' => 'required|string|min:12',
            'news_update' => 'required|date',
            'media_files.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov|max:2048',
        ]);
        if (!$validate) {
            return redirect()->back()->with('fail', 'Failed to add News!');
        }
        $news = new News();
        $news->news = $request->input('news');
        $news->news_description = $request->input('news_description');
        $news->news_updated = $request->input('news_update');
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('images/news/', $filename, 'public');
                $mediaUrls[] = $path;
            }
        }
        $news->news_images = json_encode($mediaUrls);
        $news->profile_id = $request->input('personnel_added');
        if ($news->save()) {
            return redirect()->route('news.index')->with('success', 'Added News!');
        } else {
            return redirect()->route('news.index')->with('error', 'Failed to add News!');
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
        if (!$news) {
            return redirect()->back()->with('fail', 'Event not found.');
        }

        $news->news = $request->input('news', $news->news);
        $news->news_description = $request->input('news_description', $news->news_description);
        $news->news_updated = $request->input('news_updated', $news->news_updated);
        $mediaUrls = [];
        if ($request->hasFile('media_files')) {
            if ($this->deleteNewsMedia($news)) {
                foreach ($request->file('media_files') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $path = $file->storeAs('images/news/', $filename, 'public');
                    $mediaUrls[] = $path;
                }
                $news->news_images = json_encode($mediaUrls);
            }
            else {
                return redirect()->route('news.index')->with('error', 'Failed to update News!');
            }
        }
        // If no new images uploaded, retain the existing images from the database
        if (!$request->hasFile('media_files')) {
            $mediaUrls = json_decode($news->news_images);

            // You can also perform validation here to ensure URLs are valid before updating
            $news->news_images = json_encode($mediaUrls);
        }
        $news->profile_id = $request->input('personnel_added', $news->profile_id);

        if ($news->save()) {
            return redirect()->route('news.index')->with('success', 'Update News Successful!');
        } else {
            return redirect()->route('news.index')->with('error', 'Failed to update News!');

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
        if ($news) {
            if ($this->deleteNewsMedia($news)) {
                $news->delete(); // Delete the event
                return redirect()->back()->with('success', 'Event deleted successfully!');
            }
            return redirect()->back()->with('error', 'Failed to delete the News.');
        }
        return redirect()->back()->with('error', 'Failed to delete the News.');
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
