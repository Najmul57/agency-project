<?php

namespace App\Http\Controllers;

use App\Models\DocumentUpload;
use App\Models\DocumentVerification;
use App\Models\LetterVerification;
use App\Models\StudenHelp;
use Illuminate\Http\Request;

class LetterVerificationController extends Controller
{
    public function letterverificationPage()
    {
        $help = StudenHelp::first();
        $verification = LetterVerification::first();
        return view('user.letterverification.page', compact('help', 'verification'));
    } // end method

    public function letterverificationstore(Request $request)
    {
        $data = new DocumentVerification();
        $data->user_id = auth()->id();
        $data->document = $request->document;
        $data->referance_name = $request->referance_name;
        $data->referance_email = $request->referance_email;
        $data->method = $request->method;
        $data->amount = $request->amount;
        $data->transition = $request->transition;

        //verification_letter
        if ($request->file('verification_letter')) {
            $file = $request->file('verification_letter');
            $filename = 'verification_letter_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->verification_letter = $filename;
        }
        //paymentReceipt
        if ($request->file('paymentReceipt')) {
            $file = $request->file('paymentReceipt');
            $filename = 'paymentReceipt_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->paymentReceipt = $filename;
        }
        //marksheet
        if ($request->file('marksheet')) {
            $file = $request->file('marksheet');
            $filename = 'marksheet_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->marksheet = $filename;
        }
        //idProof
        if ($request->file('idProof')) {
            $file = $request->file('idProof');
            $filename = 'idProof_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->idProof = $filename;
        }
        //photo
        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = 'photo_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->photo = $filename;
        }
        //signature
        if ($request->file('signature')) {
            $file = $request->file('signature');
            $filename = 'signature_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->signature = $filename;
        }
        //others
        if ($request->file('others')) {
            $file = $request->file('others');
            $filename = 'others_' . $file->getClientOriginalName();
            $file->move(public_path('upload/letter_verification'), $filename);
            $data->others = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Letter Verification Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    } // end method

    public function documentverification()
    {
        $data = DocumentVerification::latest()->get();
        return view('admin.letter.document_verification', compact('data'));
    } // end method

    public function documentverificationdestroy($id)
    {
        $data = DocumentVerification::findOrFail($id);

        // Unlink files
        if ($data->verification_letter) {
            unlink(public_path('upload/letter_verification/' . $data->verification_letter));
        }
        if ($data->paymentReceipt) {
            unlink(public_path('upload/letter_verification/' . $data->paymentReceipt));
        }
        if ($data->marksheet) {
            unlink(public_path('upload/letter_verification/' . $data->marksheet));
        }
        if ($data->idProof) {
            unlink(public_path('upload/letter_verification/' . $data->idProof));
        }
        if ($data->photo) {
            unlink(public_path('upload/letter_verification/' . $data->photo));
        }
        if ($data->signature) {
            unlink(public_path('upload/letter_verification/' . $data->signature));
        }
        if ($data->others) {
            unlink(public_path('upload/letter_verification/' . $data->others));
        }

        $data->delete();

        $notification = [
            'message' => 'Document Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function reportupload()
    {
        $data = DocumentVerification::latest()->get();
        return view('admin.letter.verify_doc_upload', compact('data'));
    } // end method

    public function adminreportstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'report' => 'required|file',
        ]);

        $userId = $request->user_id;

        // Check if a report already exists for this user
        $existingReport = DocumentUpload::where('user_id', $userId)->first();

        // if ($existingReport) {
        //     return redirect()->back()->with([
        //         'message' => 'Already Uploaded Report for This Student!',
        //         'alert-type' => 'error'
        //     ]);
        // }

        $uploadedFile = $request->file('report');
        $fileName = 'report_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/report'), $fileName);

        DocumentUpload::create([
            'user_id' => $userId,
            'status' => 1,
            'report' => $fileName,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'Student Report uploaded successfully!',
                'alert-type' => 'success',
            ]);
    }

    public function studentreportdownload($id)
    {
        $report = DocumentUpload::findOrFail($id);
        $filePath = public_path('upload/report/' . $report->report);

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

    public function reportdownload($id)
    {
        $report = DocumentUpload::findOrFail($id);
        $filePath = public_path('upload/report/' . $report->report);

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

    public function studentreportdestroy($id)
    {
        $report = DocumentUpload::findOrFail($id);

        $filePath = public_path($report->report); // Assuming 'report' contains the file path

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $report->delete();

        $notification = [
            'message' => 'Letter Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
