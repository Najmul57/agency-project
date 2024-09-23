<?php

namespace App\Http\Controllers;

use App\Models\StudenHelp;
use App\Models\StudentTicket;
use App\Models\TicketForm;
use App\Models\TicketingGuideLine;
use App\Models\TicketStatus;
use App\Models\TravelGuideline;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticketPage()
    {
        $help = StudenHelp::first();
        $ticketingGuideline = TicketingGuideLine::first();
        $travelGuideline = TravelGuideline::latest()->get();
        $ticketstatus = TicketStatus::first();
        return view('user.ticket.page', compact('help', 'ticketingGuideline', 'travelGuideline', 'ticketstatus'));
    } // end method

    public function ticketformsubmit(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'traveldate' => 'required',
            'travelby' => 'required',
            'from' => 'required',
            'to' => 'required',
            'person' => 'required',
            'passport' => 'required',
            'visa' => 'required',
        ]);

        // Insert data into the VisaForm model
        $ticketForm = new TicketForm();
        $ticketForm->user_id = auth()->id();
        $ticketForm->travel_date = $request->traveldate;
        $ticketForm->travelby = $request->travelby;
        $ticketForm->from = $request->from;
        $ticketForm->to = $request->to;
        $ticketForm->person = $request->person;

        // passport
        if ($request->file('passport')) {
            $file = $request->file('passport');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/ticket/passport'), $filename);
            $ticketForm->passport = $filename;
        }
        // visa
        if ($request->file('visa')) {
            $file = $request->file('visa');
            $filename = time() . $file->getClientOriginalName();
            $file->move(public_path('upload/ticket/visa'), $filename);
            $ticketForm->visa = $filename;
        }

        $ticketForm->save();

        $notification = [
            'message' => 'Ticket Apply Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function adminticket()
    {
        $data = StudentTicket::first();
        return view('admin.student.create', compact('data'));
    } // end method

    public function adminticketstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'ticket' => 'required|file|max:2048',
        ]);

        $uploadedFile = $request->file('ticket');
        $fileName = uniqid() . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/ticket/student_ticket'), $fileName);

        $existingTicket = StudentTicket::where('user_id', $request->user_id)->first();

        if ($existingTicket) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Student Ticket already uploaded!',
                    'alert-type' => 'danger',
                ]);
        }

        StudentTicket::create([
            'user_id' => $request->user_id,
            'ticket' => $fileName,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'Student Ticket uploaded successfully!',
                'alert-type' => 'success',
            ]);
    }

    public function ticketdownload($id)
    {
        $ticket = StudentTicket::findOrFail($id);
        $filePath = public_path('upload/ticket/student_ticket/' . $ticket->ticket);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Generate response for file download
            return response()->download($filePath);
        } else {
            // Redirect back with error message if file not found
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    public function studentticketdownload($id)
    {
        $ticket = StudentTicket::findOrFail($id);
        $filePath = public_path('upload/ticket/student_ticket/' . $ticket->ticket);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Generate response for file download
            return response()->download($filePath);
        } else {
            // Redirect back with error message if file not found
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    public function studentticketdestroy($id)
    {
        $data = StudentTicket::find($id);
        $data->delete();

        $notification = [
            'message' => 'Ticket Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function ticketRequestList()
    {
        $data = TicketForm::latest()->get();
        return view('admin.ticket.index', compact('data'));
    } // end method

    public function ticketRequestsingle($id)
    {
        $data = TicketForm::find($id);
        return view('admin.ticket.singleTicket', compact('data'));
    } // end method

    public function ticketRequestdestroy($id)
    {
        $data = TicketForm::find($id);

        if ($data) {
            // Define file paths for each file
            $passport = public_path("upload/ticket/passport/{$data->passport}");
            $visa = public_path("upload/ticket/visa/{$data->visa}");

            if (file_exists($passport)) {
                unlink($passport);
            }
            if (file_exists($passport)) {
                unlink($visa);
            }
        }

        $data->delete();

        $notification = [
            'message' => 'Ticket Apply Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
