<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\alumni;
use App\Models\Event;
use App\Models\Career;
use App\Models\OrganizationalChart;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function displayCareers()
    {
        $careers = Career::all();
        return view('guest_layout.careers', compact('careers'));
    }
    public function displayAlumni()
    {
        $alumnis = Alumni::all();
        return view('guest_layout.alumni', compact('alumnis'));
    }

    public function displayOrganizationalChart()
    {
        $charts = OrganizationalChart::first();
        $path = json_decode($charts->organizational_image);
        return view('guest_layout.organizational_chart', compact('path'));
    }
    public function displayFilteredAlumni(Request $request)
    {
        $perPage = 10; // Number of records per page

        $query = Alumni::query();

        // Search logic
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('student_name', 'like', '%' . $search . '%')
                    ->orWhere('section', 'like', '%' . $search . '%')
                    ->orWhere('alumni_specialization', 'like', '%' . $search . '%')
                    ->orWhere('class_year', 'like', '%' . $search . '%');
            });
        }

        // Get paginated results
        $alumnis = $query->paginate($perPage);

        return view('guest_layout.alumni', compact('alumnis'));
    }
    public function displayEventsInCalendar(Request $request)
    {
        if ( Request::capture()->expectsJson()){
            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
            $events = Event::whereDate('events_started', '>=', $start)->whereDate('events_end',   '<=', $end)->get(['events', 'events_description', 'events_started', 'events_end']);
            return response()->json($events);
        }
        return view('School_Calendar.calendar');
    }
}
