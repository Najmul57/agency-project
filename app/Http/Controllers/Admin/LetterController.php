<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdmissionLetter;
use App\Models\AnotherLetter;
use App\Models\LetterGuideLine;
use App\Models\Offerletter;
use App\Models\StudenHelp;
use App\Models\UniversityAdmissionLetter;
use App\Models\UniversityInvoice;
use App\Models\UploadInvoice;
use App\Models\VisaLetter;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{
    public function letterPAge()
    {
        $help = StudenHelp::first();
        $guideline = LetterGuideLine::first();
        return view('user.letter.page', compact('help', 'guideline'));
    } // end method

    //offer letter
    public function adminofferletter()
    {
        $data = Offerletter::first();
        return view('admin.letter.offerletter', compact('data'));
    } // end method

    public function adminofferletterstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'offer_letter' => 'required|file|mimes:pdf,jpeg,png,jpg,gif|max:2048',
        ]);

        $userId = $request->user_id;

        $existingLetter = Offerletter::where('user_id', $userId)->first();

        if ($existingLetter) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'An offer letter for this student already exists!',
                    'alert-type' => 'error',
                ]);
        }

        if ($request->hasFile('offer_letter')) {
            $uploadedFile = $request->file('offer_letter');
            $fileName = 'offerletter_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();

            $uploadedFile->move(public_path('upload/letter/offerletter'), $fileName);

            Offerletter::create([
                'user_id' => $userId,
                'offer_letter' => $fileName,
                'created_at' => now(),
            ]);

            return redirect()
                ->back()
                ->with([
                    'message' => 'Student Offer Letter uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'No file was uploaded.',
                    'alert-type' => 'error',
                ]);
        }
    }

    //admin offer letter
    public function offerletterdownloadadmin($id)
    {
        $offerLetter = Offerletter::findOrFail($id);
        $filePath = public_path('upload/letter/offerletter/' . $offerLetter->offer_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    public function offerletterdeleteadmin($id)
    {
        $data = Offerletter::findOrFail($id);

        $fileofferPath = public_path("upload/letter/offerletter/{$data->offer_letter}");

        if (file_exists($fileofferPath)) {
            unlink($fileofferPath);
        }

        $data->delete();

        $notification = [
            'message' => 'Offer Letter Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    // admissin letter delete
    public function admissionletterdeleteadmin($id)
    {
        $data = AdmissionLetter::findOrFail($id);

        $filePath = public_path("upload/letter/admissionletter/{$data->admission_letter}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data->delete();

        $notification = [
            'message' => 'Admission Letter Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    // visa letter delete
    public function visaletterdeleteadmin($id)
    {
        $data = VisaLetter::findOrFail($id);

        $filePath = public_path("upload/letter/visaletter/{$data->visa_letter}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data->delete();

        $notification = [
            'message' => 'Visa Letter Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
    // another letter delete
    public function anotherletterdeleteadmin($id)
    {
        $data = AnotherLetter::findOrFail($id);

        $filePath = public_path("upload/letter/anotherletter/{$data->another_letter}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data->delete();

        $notification = [
            'message' => 'Another Letter Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    //admission invoice
    public function adminadmissioninvoice()
    {
        $data = UploadInvoice::latest()->get();
        return view('admin.letter.admisioninvoice', compact('data'));
    } // end method

    public function adminadmissioninvoicestore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'pdf_path' => 'required|file|mimes:pdf|max:2048',
        ]);

        $existingInvoice = UploadInvoice::where('user_id', $request->user_id)->first();

        if ($existingInvoice) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Invoice has already been uploaded for this student.',
                    'alert-type' => 'error',
                ]);
        }

        if ($request->hasFile('pdf_path')) {
            $uploadedFile = $request->file('pdf_path');

            $fileName = 'invoice' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();

            if (file_exists(public_path('upload/invoice/' . $fileName))) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'A file with the same name already exists.',
                        'alert-type' => 'error',
                    ]);
            }

            $uploadedFile->move(public_path('upload/invoice'), $fileName);

            UploadInvoice::create([
                'user_id' => $request->user_id,
                'pdf_path' => $fileName,
                'created_at' => now(),
            ]);

            return redirect()
                ->back()
                ->with([
                    'message' => 'Invoice uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'No file was uploaded.',
                    'alert-type' => 'error',
                ]);
        }
    }

    public function admissioninvoicedeleteadmin($id)
    {
        $admissionLetter = UploadInvoice::find($id);

        $admissionLetter->delete();

        return redirect()
            ->back()
            ->with([
                'message' => 'Invoice Delete successfully!',
                'alert-type' => 'success',
            ]);
    }

    //admission letter
    public function adminadmissionletter()
    {
        $data = AdmissionLetter::first();
        return view('admin.letter.admissionletter', compact('data'));
    } // end method

    public function adminadmissionletterstore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'admission_letter' => 'required|file|mimes:pdf,jpeg,png,jpg,gif|max:2048', // Allow both PDF and image files
        ]);

        $userId = $request->user_id;

        // Check if an admission letter already exists for this user
        $existingLetter = AdmissionLetter::where('user_id', $userId)->first();

        if ($existingLetter) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'An admission letter for this student already exists!',
                    'alert-type' => 'error',
                ]);
        }

        // Check if the file is uploaded
        if ($request->hasFile('admission_letter')) {
            $uploadedFile = $request->file('admission_letter');
            $fileName = 'admissionletter_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();

            // Move the uploaded file to the storage folder
            $uploadedFile->move(public_path('upload/letter/admissionletter'), $fileName);

            // Create a new record in the database
            AdmissionLetter::create([
                'user_id' => $userId,
                'admission_letter' => $fileName,
                'created_at' => now(),
            ]);

            // Return a success response
            return redirect()
                ->back()
                ->with([
                    'message' => 'Student Admission Letter uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        } else {
            // Return an error response if no file was uploaded
            return redirect()
                ->back()
                ->with([
                    'message' => 'No file was uploaded.',
                    'alert-type' => 'error',
                ]);
        }
    }

    //admin admission letter
    public function admissionletterdownloadadmin($id)
    {
        $admissionLetter = AdmissionLetter::findOrFail($id);
        $filePath = public_path('upload/letter/admissionletter/' . $admissionLetter->admission_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    }

    //visa letter
    public function adminvisaletter()
    {
        $data = VisaLetter::first();
        return view('admin.letter.visaletter', compact('data'));
    } // end method

    public function adminvisaletterstore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'visa_letter' => 'required',
        ]);

        $userId = $request->user_id;

        // Check if a visa letter already exists for this user
        $existingLetter = VisaLetter::where('user_id', $userId)->first();

        if ($existingLetter) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'A visa permission letter for this student already exists!',
                    'alert-type' => 'error',
                ]);
        }

        // Check if the file is uploaded
        if ($request->hasFile('visa_letter')) {
            $uploadedFile = $request->file('visa_letter');
            $fileName = 'visaletter_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();

            // Move the uploaded file to the storage folder
            $uploadedFile->move(public_path('upload/letter/visaletter'), $fileName);

            // Create a new record in the database
            VisaLetter::create([
                'user_id' => $userId,
                'visa_letter' => $fileName,
                'created_at' => now(),
            ]);

            // Return a success response
            return redirect()
                ->back()
                ->with([
                    'message' => 'Student Visa Permission Letter uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        } else {
            // Return an error response if no file was uploaded
            return redirect()
                ->back()
                ->with([
                    'message' => 'No file was uploaded.',
                    'alert-type' => 'error',
                ]);
        }
    }

    //admin visa letter
    public function visaletterdownloadadmin($id)
    {
        $visaLetter = VisaLetter::findOrFail($id);
        $filePath = public_path('upload/letter/visaletter/' . $visaLetter->visa_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    }

    //student visa letter
    public function admissionlettterdownloaduser($id)
    {
        $admissionLetter = AdmissionLetter::findOrFail($id);
        $filePath = public_path('upload/letter/admissionletter/' . $admissionLetter->admission_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    public function offerlettterdownloaduser($id)
    {
        $offerletter = Offerletter::findOrFail($id);
        $filePath = public_path('upload/letter/offerletter/' . $offerletter->offer_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    }

    //student visa letter
    public function anotherletterdownloaduser($id)
    {
        $anotherLetter = AnotherLetter::findOrFail($id);
        $filePath = public_path('upload/letter/anotherletter/' . $anotherLetter->another_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    //student visa letter
    public function visalettterdownloaduser($id)
    {
        $visaLetter = VisaLetter::findOrFail($id);
        $filePath = public_path('upload/letter/visaletter/' . $visaLetter->visa_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    //another letter
    public function adminanotherletter()
    {
        $data = AnotherLetter::first();
        return view('admin.letter.anotherletter', compact('data'));
    } // end method

    public function adminanotherletterstore(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'another_letter' => 'required',
        ]);

        $userId = $request->user_id;

        // Check if an another letter already exists for this user
        $existingLetter = AnotherLetter::where('user_id', $userId)->first();

        if ($existingLetter) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'An another letter for this student already exists!',
                    'alert-type' => 'error',
                ]);
        }

        // Store the uploaded file
        if ($request->hasFile('another_letter')) {
            $uploadedFile = $request->file('another_letter');

            // Generate a unique file name to prevent conflicts and preserve the extension
            $fileName = 'anotherletter_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();

            // Move the uploaded file to the storage folder
            $uploadedFile->move(public_path('upload/letter/anotherletter'), $fileName);

            // Create record in the database
            AnotherLetter::create([
                'user_id' => $userId,
                'another_letter' => $fileName,
                'created_at' => now(),
            ]);

            return redirect()
                ->back()
                ->with([
                    'message' => 'Student Another Letter uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'No file was uploaded.',
                    'alert-type' => 'error',
                ]);
        }
    }

    //admin visa letter
    public function anotherletterdownloadadmin($id)
    {
        $anotherLetter = AnotherLetter::findOrFail($id);
        $filePath = public_path('upload/letter/anotherLetter/' . $anotherLetter->another_letter);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    }

    public function adminadmissionlettergenerate()
    {
        $generate = UniversityAdmissionLetter::latest()->get();
        return view('admin.letter.admissiongenerate', compact('generate'));
    } // end method

    public function adminadmissionlettergeneratestore(Request $request)
    {
        $existingAdmissionLetter = UniversityAdmissionLetter::where('user_id', $request->input('user_id'))->first();

        if ($existingAdmissionLetter) {
            return redirect()->back()->with('error', 'Admission letter already exists for this user.');
        }

        $admissionLetter = UniversityAdmissionLetter::create([
            'user_id' => $request->input('user_id'),
            'admissionFees' => $request->input('admissionFees'),
            'tuitionFees' => $request->input('tuitionFees'),
            'otherFees' => $request->input('otherFees'),
            'universityId' => $request->input('universityId'),
            'referanceId' => $request->input('referanceId'),
        ]);

        $admissionLetter->load('user.course', 'user.premiumUniversity');

        $fileName = 'admission-invoice-' . $admissionLetter->user->system_id . '.pdf';
        $pdfPath = asset('upload/invoice/' . $fileName);
        $data = "$pdfPath";

        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($data) . '&size=200x200';

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $qrCodeUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $qrCodeContent = curl_exec($curl);

        if ($qrCodeContent === false) {
            $error = curl_error($curl);
            echo 'cURL Error: ' . $error;
        }

        curl_close($curl);

        if ($qrCodeContent !== false) {
            $qrCodeBase64 = base64_encode($qrCodeContent);
        } else {
            echo 'Failed to fetch QR code content.';
        }

        $html = view('admin.pdf.admission_invoice', [
            'admissionLetter' => $admissionLetter,
            'qrCodeBase64' => $qrCodeBase64,
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $pdfContent = $dompdf->output();

        $fileName = 'admission-invoice-' . $admissionLetter->user->system_id . '.pdf';
        $pdfPath = public_path('upload/invoice/' . $fileName);

        if (!file_exists(public_path('upload/invoice'))) {
            mkdir(public_path('upload/invoice'), 0755, true);
        }

        file_put_contents($pdfPath, $pdfContent);

        $existingInvoice = UploadInvoice::where('user_id', $admissionLetter->user_id)->first();

        if (!$existingInvoice) {
            UploadInvoice::create([
                'user_id' => $admissionLetter->user_id,
                'pdf_path' => $fileName,
            ]);
        }

        return response()
            ->make($pdfContent, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
    public function adminadmissionlettergeneratedelete($id)
    {
        $invoice = UniversityAdmissionLetter::findOrFail($id);
        $data = UploadInvoice::where('user_id', $invoice->user_id)->first();

        if ($data) {
            $data->delete();
        }

        $invoice->delete();

        $notification = [
            'message' => 'Admission Invoice Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
