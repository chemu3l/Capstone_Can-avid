<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Features\LogsController;

class CareerController extends Controller
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
                $careers = Career::with('profile')->get();
        } elseif (Auth::user()->role == "Registrar") {
            $careers = Career::with('profile')
                ->where(function ($query) {
                    $query->where('status', 'Registrar Verified')
                        ->orWhere('status', 'Pending');
                })
                ->get();
        } else {
            $careers = Career::with('profile')->where('status', 'Pending')->get();
        }

            return view('Career.index_career', compact('careers'));
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
        return view('Career.add_career');
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
            'career_position' => 'required',
            'career_description' => 'required',
            'career_requirements' => 'required'
        ]);
        if (!$validate) {
            return redirect()->back()->with('fail', 'Failed to add Announcement!');
        }
        $careers = new Career();
        $careers->career_position = $request->input(['career_position']);
        $careers->career_description = $request->input(['career_description']);
        $careers->career_requirements = $request->input(['career_requirements']);
        if (Auth::user()->role == "Faculty") {
            $careers->status = "Pending";
        } elseif (Auth::user()->role == "Registrar") {
            $careers->status = "Registrar Verified";
        } else {
            $careers->status = "Posted";
        }
        $careers->profile_id = Auth::user()->profile->id;
        $historyRequest = new Request([
            'action' => 'Store',
            'type' => 'Career',
            'oldData' => null,
            'newData' => $request->input('career_position'),
            'date' => date('Y-m-d H:i:s')
        ]);
        $history = new LogsController();
        $history->store($historyRequest);
        if ($careers->save()){
            return redirect()->route('careers.index')->with('success','Succesfully Added Career');
        }else{
            return redirect()->route('careers.index')->with('error','Succesfully Added Career');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        return view('Career.view_career')->with('career', $career);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        if (Auth::check()) {
            return view('Career.edit_career')->with('career', $career);
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
    public function update(Request $request, Career $career)
    {
        $career->career_position = $request->input(['career_position'], $career->career_position);
        $career->career_description = $request->input(['career_description'], $career->career_description);
        $career->career_requirements = $request->input(['career_requirements'], $career->career_requirements);
        $career->status = $request->input(['status'], $career->status);

        $career->profile_id = Auth::user()->profile->id;
        $historyRequest = new Request([
            'action' => 'Update',
            'type' => 'Career',
            'oldData' => $career->career_position,
            'newData' => $request->input('career_position'),
            'date' => date('Y-m-d H:i:s')
        ]);
        $history = new LogsController();
        $history->store($historyRequest);
        if ($career->save()) {
            return redirect()->route('careers.index')->with('success', 'Update Careers Successful!');
        } else {
            return redirect()->route('careers.index')->with('error', 'Failed to update Careers!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        if (Auth::check()) {
            if ($career) {
                $historyRequest = new Request([
                    'action' => 'Delete',
                    'type' => 'Career',
                    'oldData' => null,
                    'newData' => $career->career_position,
                    'date' => date('Y-m-d H:i:s')
                ]);
                $history = new LogsController();
                $history->store($historyRequest);
                $career->delete(); // Delete the event
                return redirect()->route('careers.index')->with('success', 'Career deleted successfully!');
            } else {
                return redirect()->route('careers.index')->with('error', 'Failed to delete the Career.');
            }
        } else {
            return redirect()->route('careers.index')->with('error', 'Failed to delete the Career.');
        }
    }
}
