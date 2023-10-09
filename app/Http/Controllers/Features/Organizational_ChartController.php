<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrganizationalChart;
use Illuminate\Support\Facades\Auth;

class Organizational_ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $organizations = OrganizationalChart::with('profile')->get();
            return view('Organizational Chart.index_organizational_chart', compact('organizations'));
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
        if (Auth::check()) {
            return view('Organizational Chart.add_organization');
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            $member = new OrganizationalChart();
            if ($request->hasFile('picture')) {
                $picturePath = $request->file('picture')->store('images/organizational_chart', 'public');
                $member->organizational_image = json_encode($picturePath);
            }
            $member->profile_id = Auth::user()->profile->id;
            $historyRequest = new Request([
                'action' => 'Store',
                'type' => 'Organizational Chart',
                'oldData' => null,
                'newData' => 'Added Organizational Picture',
                'date' => date('Y-m-d H:i:s')
            ]);
            $history = new LogsController();
            $history->store($historyRequest);
            if ($member->save()) {
                return redirect()->route('organizational_chart.index')->with('success', 'Succesfully Added a member!');
            } else {
                return redirect()->route('organizational_chart.index')->with('error', 'Unable to add member!');
            }
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationalChart $organizational_chart)
    {
        if (Auth::check()) {
            $path = json_decode($organizational_chart->organizational_image);
            $data = compact('organizational_chart','path');
            return view('Organizational Chart.view_organization', $data);
        } else {
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationalChart $organizational_chart)
    {
        if (Auth::check()) {
            return view('Organizational Chart.edit_organization')->with('organization', $organizational_chart);
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
    public function update(Request $request, OrganizationalChart $organizational_chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrganizationalChart $organizational_chart)
    {
        if (Auth::check()) {
            if ($organizational_chart) {
                $historyRequest = new Request([
                    'action' => 'Delete',
                    'type' => 'Organizational Chart',
                    'oldData' => null,
                    'newData' => 'Deleted organizational picture',
                    'date' => date('Y-m-d H:i:s')
                ]);
                $history = new LogsController();
                $history->store($historyRequest);
                if ($organizational_chart->delete()) {
                    return redirect()->route('organizational_chart.index')->with('success', 'Deleted Successfully!');
                } else {
                    return redirect()->route('organizational_chart.index')->with('error', 'Unable to Delete');
                }
            } else {
                return redirect()->route('organizational_chart.index')->with('error', 'Unable to Delete');
            }
        }
    }
}
