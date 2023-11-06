<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\alumni;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Career;
use App\Models\News;
use App\Models\OrganizationalChart;
use App\Models\profile;
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
        $chart = OrganizationalChart::first();
        if ($chart) {
            $path = json_decode($chart->organizational_image);
        } else {
            // If there's no chart data, set a default image path
            $path = asset('images\CNHS_IMAGE\images\329820707_229994286356212_5600802534606273014_n.jpg'); // Adjust the path accordingly
        }
        return view('guest_layout.organizational_chart', compact('path'));
    }
    public function displayEventsInCalendar()
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
        $filteredData = profile::where('department', $selectedDepartment)->get();
        return view('guest_layout.departments', ['filteredData' => $filteredData, 'department' => $selectedDepartment]);
    }
    public function guestNews()
    {
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

    public function pageNotFound()
    {
        return  view('page_not_found');
    }
    public function displayAdmission()
    {
        return view('guest_layout.admission');
    }
}
