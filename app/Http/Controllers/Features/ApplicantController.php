<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Features\LogsController;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $applicants = Applicant::with('career')->get();
            return view('Application.index_applicants', compact('applicants'));
        } else {
            return redirect()->route('Landing_page');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $careerId = $request->input('career_id');
        $career = Career::findOrFail($careerId);
        return view('Application.add_application', compact('career'));
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
            # code...

            $validatedData = $request->validate([
                'applicant_name' => 'required|string',
                'applicant_email' => 'required|email',
                'career_id' => 'required|exists:careers,id',
                'applicant_resume' => 'required|file|mimes:pdf', // Adjust allowed file types
            ]);

            $applicant = new Applicant();
            $applicant->applicant_name = $validatedData['applicant_name'];
            $applicant->applicant_email = $validatedData['applicant_email'];
            $applicant->career_id = $validatedData['career_id'];

            if ($request->hasFile('applicant_resume')) {
                $file = $request->file('applicant_resume');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('resume', $filename, 'public');
                $applicant->applicant_resume = json_encode($path);
            }

            if ($applicant->save()) {
                return redirect()->back()->with('success', 'Application Submitted');
            } else {
                return redirect()->back()->with('error', 'An error occurred. Please provide accurate data.');
            }
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred. Please provide accurate data: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        if (Auth::check()) {
            $path = json_decode($applicant->applicant_resume);
            $data = compact('applicant', 'path');
            return view('Application.view_application', $data);
        } else {
            return redirect()->route('Landing_page');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        try {
            if (Auth::check()) {
                $image = json_decode($applicant->applicant_resume);
                $storagePath = str_replace('storage/', '', $image);
                Storage::disk('public')->delete($storagePath);
                $historyRequest = new Request([
                    'action' => 'Deleted',
                    'type' => 'Applicant',
                    'oldData' => null,
                    'newData' => $applicant->applicant_name,
                    'date' => date('Y-m-d H:i:s')
                ]);
                $history = new LogsController();
                $history->store($historyRequest);
                $applicant->delete();
                return redirect()->route('applicants.index')->with('success', 'Deleted Successfully!');
            } else {
                return redirect()->route('applicants.index')->with('success', 'Unable Deleted!');
            }
        } catch (\Throwable $e) {
            return redirect()->route('applicants.index')->with('error', 'Unable Deleted: ' . $e->getMessage());
        }
    }
}
