<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;
use Illuminate\Support\Facades\Auth;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $alumnis = Alumni::with('profile')->get();
            return view('Alumni.index_alumni', compact('alumnis'));
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
        return view('Alumni.add_alumni');
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
            'student_name' => 'required|string',
            'section' => 'required|string',
            'alumni_specialization' => 'required|string',
            'class_year' => ['required', 'regex:/^\d{4}$/', 'numeric', 'min:1900', 'max:' . date('Y')],
        ]);
        if (!$validate) {
            return redirect()->back()->with('error', 'Failed to add Alumni!');
        }
        $alumni = new Alumni();
        $alumni->student_name = $validate['student_name'];
        $alumni->section = $validate['section'];
        $alumni->alumni_specialization = $validate['alumni_specialization'];
        $alumni->class_year = $validate['class_year'];
        $alumni->profile_id = Auth::user()->profile->id;
        if ($alumni->save()) {
            return redirect()->route('alumnis.index')->with('success', 'Finally Add alumni');
        } else {
            return redirect()->route('alumnis.index')->with('error', 'Failed to Add Alumni');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Alumni $alumni)
    {
        return view('Alumni.view_alumni')->with('alumni', $alumni);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumni $alumni)
    {
        if (Auth::check()) {
            return view('Alumni.edit_alumni')->with('alumni', $alumni);
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
    public function update(Request $request, Alumni $alumni)
    {
        if (!$alumni) {
            return redirect()->route('alumnis.index')->with('error', 'Announcement not found.');
        }
        $alumni->student_name = $request->input('student_name', $alumni->student_name);
        $alumni->section = $request->input('section', $alumni->section);
        $alumni->alumni_specialization = $request->input('alumni_specialization', $alumni->alumni_specialization);
        $alumni->class_year = $request->input('class_year', $alumni->class_year);
        $alumni->profile_id = Auth::user()->profile->id;
        if ($alumni->save()) {
            return redirect()->route('alumnis.index')->with('success', 'Update Alumni Successful!');
        } else {
            return redirect()->route('alumnis.index')->with('error', 'Failed to update Alumni');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumni  $alumni)
    {
        if (Auth::check()) {
            $alumni->delete();
            return redirect()->route('alumnis.index')->with('success', 'Deleted Successfully!');
        } else {
            return redirect()->route('login');
        }
    }
}
