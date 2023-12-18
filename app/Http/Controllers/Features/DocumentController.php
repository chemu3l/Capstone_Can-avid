<?php

namespace App\Http\Controllers\Features;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $requested = Document::all();
            return view('Request_Document.index_request')->with('requested', $requested);
        } else {
            return view('welcome');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Request_Document.add_request_document');
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
            'Document' => 'required|string',
            'Student_Name' => 'required|string',
            'Requester_Name' => 'required|string',
            'Date_to_Get' => 'required|date',
            'Requester_Email' => 'required|string'
        ]);
        if ($validate) {
            $requests = new Document();
            $requests->Document = $request->input('Document');
            $requests->Student_Name = $request->input('Student_Name');
            $requests->Requester_Name = $request->input('Requester_Name');
            $requests->Date_to_Get = $request->input('Date_to_Get');
            $requests->Requester_Email = $request->input('Requester_Email');
            $requests->search_id = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $sendEMAIL = $this->generatePdf($requests);
            if ($requests->save() && $sendEMAIL) {
                return redirect()->back()->with('success', 'Please Check your Email for more information!');
            } else {
                return redirect()->back()->with('error', 'Please Comply the Data Needed!');
            }
        } else {
            return redirect()->back()->with('error', 'Please Comply the Data Needed!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return view('Event.view_event')->with('document', $document);
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
    public function destroy(Document $document)
    {
        try {
            if (Auth::check()) {
                if ($document) {
                    $historyRequest = new Request([
                        'action' => 'Deleted',
                        'type' => 'Request',
                        'oldData' => null,
                        'newData' => $document->Requester_Name,
                        'date' => date('Y-m-d H:i:s')
                    ]);
                    $history = new LogsController();
                    $history->store($historyRequest);
                    $document->delete(); // Delete the event
                    return redirect()->route('requests.index')->with('success', 'Request deleted successfully!');
                } else {
                    return redirect()->route('requests.index')->with('error', 'Request to delete the Career.');
                }
            } else {
                return redirect()->route('requests.index')->with('error', 'Request to delete the Career.');
            }
        } catch (\Throwable $e) {
            return redirect()->route('requests.index')->with('error', 'Request to delete the Career: ' . $e->getMessage());
        }
    }

    private function generatePdf(Document $request)
    {
        $data['document'] = $request->Document;
        $data['student_name'] = $request->Student_Name;
        $data['requester'] = $request->Requester_Name;
        $data['date'] = $request->Date_to_Get;
        $data['email'] = $request->Requester_Email;
        $data['random_string'] = $request->search_id;
        $pdf = Pdf::loadView('emails.user_data', $data);
        Mail::send('emails.RequestingDocument', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data['email'])
                ->subject($data["document"])
                ->attachData($pdf->output(), "receipt.pdf");
        });
        return true;
    }
}
