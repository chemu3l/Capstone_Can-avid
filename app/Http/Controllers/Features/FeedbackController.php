<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $principalData = User::where('role', $user->role)->first();
            if ($principalData) {
                $feedbacks = Feedback::all();
                return view('Feedback.index_feedback')->with('feedbacks', $feedbacks);
            } else {
                echo "No data found for the principal.";
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);
        if ($validate) {
            $requests = new Feedback();
            $requests->name = $request->input('name');
            $requests->email = $request->input('email');
            $requests->message = $request->input('message');
            if ($requests->save()) {
                return redirect()->route('HomePage')->with('success', 'Thank you for your message, Your message will be noticed!');
            } else {
                return redirect()->route('HomePage')->with('error', 'Please Comply the Data Needed!');
            }
        }
        return redirect()->route('HomePage')->with('error', 'Please Comply the Data Needed!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function destroy(Feedback $feedback)
    {
        if (Auth::check()) {
            if ($feedback) {
                $historyRequest = new Request([
                    'action' => 'Delete',
                    'type' => 'Feedback',
                    'oldData' => null,
                    'newData' => $feedback->name,
                    'date' => date('Y-m-d H:i:s')
                ]);
                $history = new LogsController();
                $history->store($historyRequest);
                $feedback->delete(); // Delete the event
                return redirect()->route('feedback.index')->with('success', 'Career deleted successfully!');
            } else {
                return redirect()->route('feedback.index')->with('error', 'Failed to delete the Career.');
            }
        } else {
            return redirect()->route('feedback.index')->with('error', 'Failed to delete the Career.');
        }
    }
}
