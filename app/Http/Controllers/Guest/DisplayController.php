<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\alumni;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Career;
use App\Models\News;
use App\Models\OrganizationalChart;
use App\Models\Profile;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function displayCareers()
    {
        $careers = Career::where('status', 'Posted')->get();
        return view('guest_layout.careers', compact('careers'));
    }

    public function guestannouncement()
    {
        $announcements = Announcement::where('status', 'Posted')->get();
        return view('guest_layout.guestannouncement', compact('announcements'));
    }

    public function displayOrganizationalChart()
    {
        $charts = OrganizationalChart::first();
        $path = json_decode($charts->organizational_image);
        $path = json_decode($charts->organizational_image);
        return view('guest_layout.organizational_chart', compact('path'));
    }
    public function displayEventsInCalendar(Request $request)
    {
        if (Request::capture()->expectsJson()) {
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::where('status', 'Posted')
                ->whereDate('events_started', '>=', $start)
                ->whereDate('events_end', '<=', $end)
                ->get(['events', 'events_description', 'events_started', 'events_end']);
            return response()->json($events);
        }
        return view('School_Calendar.calendar');
    }

    public function displayEvents()
    {
        $eventItems = Event::all();
        return view('guest_layout.events', compact('eventItems'));
    }

    public function showEvent(Event $event)
    {
        return view('guest_layout.view_event')->with('event', $event);
    }

    public function displayDepartment()
    {
        return view('guest_layout.departments');
    }

    public function filterByDepartment(Request $request)
    {
        $selectedDepartment = $request->input('department');
        $filteredData = Profile::where('department', $selectedDepartment)->get();
        return view('guest_layout.departments', ['filteredData' => $filteredData, 'department' => $selectedDepartment]);
    }
    public function guestNews(){
        $news = News::where('status', 'Posted')->get(['news', 'news_description', 'news_images']);

        // Extract the first media URL from each news item and add it as a property
        $news->each(function ($item) {
            $mediaUrls = json_decode($item->news_images);
            $item->firstMediaUrl = reset($mediaUrls);
        });

        return view('guest_layout.news', compact('news'));
    }
    public function showNews($news_id)
    {
        $news = News::where('news', $news_id)->firstOrFail();
        // You don't need to parse it as JSON, as it should already be a model object
        return view('guest_layout.view_news')->with('news', $news);
    }

    public function pageNotFound(){
        return  view('page_not_found');
    }
}
