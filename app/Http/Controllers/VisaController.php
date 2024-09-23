<?php

namespace App\Http\Controllers;

use App\Models\VisaCopy;
use App\Models\VisaForm;
use App\Models\StudenHelp;
use App\Models\VisaUpload;
use Illuminate\Http\Request;
use App\Models\VisaGuideLine;
use App\Models\VisaApplication;
use Illuminate\Support\Facades\Storage;

class VisaController extends Controller
{
    public function visaPage()
    {
        $help = StudenHelp::first();
        $visaguideline = VisaGuideLine::first();
        return view('user.visa.page', compact('help', 'visaguideline'));
    } // end method

    public function visastore(Request $request)
    {
        // return $request->all();
        // Validate the request data
        $validated = $request->validate([
            'full_name' => 'required',
            'f_name' => 'required',
            'm_name' => 'required',
            'dob' => 'required',
            'present_address' => 'required',
            'permanent_address' => 'required',
            'spouse_name' => 'required',
            'personal_mobile' => 'required',
            'father_mobile' => 'required',
            'email' => 'required|email',
            'embassy' => 'required',
            'embassy_date' => 'required|date',
            'expected_date' => 'required|date',
            'travel_history' => 'required',
            'travel_amother_country' => 'required',
            'father_profession' => 'required',
            'through_border' => 'required',
            'nid' => 'required|mimes:jpg,jpeg,png|max:2048',
            'passport' => 'required|mimes:jpg,jpeg,png|max:2048',
            'admission_letter' => 'required|mimes:jpg,jpeg,png|max:2048',
            'pre_travel_history' => 'required|mimes:jpg,jpeg,png|max:2048',
            'f_profession_proof' => 'required|mimes:jpg,jpeg,png|max:2048',
            'photo_scan' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Insert data into the VisaForm model
        $visaForm = new VisaForm();
        $visaForm->user_id = auth()->id();
        $visaForm->full_name = $request->full_name;
        $visaForm->f_name = $request->f_name;
        $visaForm->m_name = $request->m_name;
        $visaForm->dob = $request->dob;
        $visaForm->present_address = $request->present_address;
        $visaForm->permanent_address = $request->permanent_address;
        $visaForm->spouse_name = $request->spouse_name;
        $visaForm->personal_mobile = $request->personal_mobile;
        $visaForm->father_mobile = $request->father_mobile;
        $visaForm->email = $request->email;
        $visaForm->embassy = $request->embassy;
        $visaForm->embassy_date = $request->embassy_date;
        $visaForm->expected_date = $request->expected_date;
        $visaForm->travel_history = $request->travel_history;
        $visaForm->travel_amother_country = $request->travel_amother_country;
        $visaForm->father_profession = $request->father_profession;
        $visaForm->through_border = $request->through_border;

        // nid
        if ($request->file('nid')) {
            $file = $request->file('nid');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/nid'), $filename);
            $visaForm->nid = $filename;
        }
        // passport
        if ($request->file('passport')) {
            $file = $request->file('passport');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/passport'), $filename);
            $visaForm->passport = $filename;
        }
        // admission_letter
        if ($request->file('admission_letter')) {
            $file = $request->file('admission_letter');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/admission_letter'), $filename);
            $visaForm->admission_letter = $filename;
        }
        // pre_travel_history
        if ($request->file('pre_travel_history')) {
            $file = $request->file('pre_travel_history');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/previous_travel_history'), $filename);
            $visaForm->pre_travel_history = $filename;
        }
        // f_profession_proof
        if ($request->file('f_profession_proof')) {
            $file = $request->file('f_profession_proof');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/father_profession_proof'), $filename);
            $visaForm->f_profession_proof = $filename;
        }
        // photo_scan
        if ($request->file('photo_scan')) {
            $file = $request->file('photo_scan');
            $filename = uniqid() . $request->full_name . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/photo_scan'), $filename);
            $visaForm->photo_scan = $filename;
        }

        $visaForm->save();

        $notification = [
            'message' => 'Visa Apply Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function visafileupload(Request $request)
    {
        $request->validate([
            'visa_file' => 'required',
        ]);

        $existingVisaCopy = VisaCopy::where('user_id', auth()->id())->first();

        if ($existingVisaCopy) {
            $notification = [
                'message' => 'You have already submitted a visa file!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $visaCopy = new VisaCopy();
        $visaCopy->user_id = auth()->id();

        $file = $request->file('visa_file');
        $filename = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path('upload/visa/file'), $filename);
        $visaCopy->visa_file = $filename;

        $visaCopy->save();

        $notification = [
            'message' => 'Visa Copy Upload Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function visaapplicationupload(Request $request)
    {
        $validated = $request->validate([
            'visa_application' => 'required',
        ]);

        $existingApplication = VisaApplication::where('user_id', auth()->id())->first();

        if ($existingApplication) {
            $notification = [
                'message' => 'You have already uploaded a visa application!',
                'alert-type' => 'danger',
            ];
            return redirect()->back()->with($notification);
        }

        $visaApplication = new VisaApplication();
        $visaApplication->user_id = auth()->id();

        if ($request->hasFile('visa_application')) {
            $file = $request->file('visa_application');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/application'), $filename);
            $visaApplication->visa_application = $filename;
        }

        $visaApplication->save();

        $notification = [
            'message' => 'Visa Application Upload Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function adminVisaUpload()
    {
        $data = VisaUpload::latest()->get();
        return view('admin.visa.upload', compact('data'));
    } // end method

    public function adminVisaStore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'visa_upload' => 'required|file|max:2048',
        ]);

        $existingVisaUpload = VisaUpload::where('user_id', $request->user_id)->first();

        if ($existingVisaUpload) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Visa already uploaded for this student!',
                    'alert-type' => 'error',
                ]);
        }

        $uploadedFile = $request->file('visa_upload');
        $fileName = 'visa_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/visa/student_visa'), $fileName);

        VisaUpload::create([
            'user_id' => $request->user_id,
            'visa_upload' => $fileName,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'Student Visa uploaded successfully!',
                'alert-type' => 'success',
            ]);
    }

    public function studentvisadownload($id)
    {
        $visa = VisaUpload::findOrFail($id);

        $filePath = public_path('upload/visa/student_visa/' . $visa->visa_upload);

        if (file_exists($filePath)) {
            return response()->download($filePath, $visa->visa_upload);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    } // end method

    public function studentvisadestroy($id)
    {
        $visa = VisaUpload::findOrFail($id);

        $filePath = public_path("upload/visa/student_visa/{$visa->visa_upload}");

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $visa->delete();

        $notification = [
            'message' => 'Visa Delete Success!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function studentvisadownloaduser($id)
    {
        $visa = VisaUpload::findOrFail($id);

        $filePath = public_path('upload/visa/student_visa/' . $visa->visa_upload);

        if (file_exists($filePath)) {
            return response()->download($filePath, $visa->visa_upload);
        } else {
            return redirect()
                ->back()
                ->with([
                    'message' => 'File not found!',
                    'alert-type' => 'error',
                ]);
        }
    }

    public function visaapplylist()
    {
        $visaList = VisaForm::latest()->get();
        return view('admin.visa.studentapplylist', compact('visaList'));
    }

    public function visaapplysingle($id)
    {
        $data = VisaForm::find($id);
        return view('admin.visa.studentapplysingle', compact('data'));
    }

    public function visarejectsingle($id)
    {
        $visaForm = VisaForm::find($id);

        if ($visaForm) {
            // Define file paths for each file
            $nidFilePath = public_path("upload/visa/nid/{$visaForm->nid}");
            $admissionLetterFilePath = public_path("upload/visa/admission_letter/{$visaForm->admission_letter}");
            $fatherProfessionProofFilePath = public_path("upload/visa/father_profession_proof/{$visaForm->f_profession_proof}");
            $passportFilePath = public_path("upload/visa/passport/{$visaForm->passport}");
            $photoScanFilePath = public_path("upload/visa/photo_scan/{$visaForm->photo_scan}");
            $previousTravelHistoryFilePath = public_path("upload/visa/previous_travel_history/{$visaForm->pre_travel_history}");

            // Check and unlink each file if it exists
            if (file_exists($nidFilePath)) {
                unlink($nidFilePath);
            }
            if (file_exists($admissionLetterFilePath)) {
                unlink($admissionLetterFilePath);
            }
            if (file_exists($fatherProfessionProofFilePath)) {
                unlink($fatherProfessionProofFilePath);
            }
            if (file_exists($passportFilePath)) {
                unlink($passportFilePath);
            }
            if (file_exists($photoScanFilePath)) {
                unlink($photoScanFilePath);
            }
            if (file_exists($previousTravelHistoryFilePath)) {
                unlink($previousTravelHistoryFilePath);
            }

            // Delete the VisaForm record
            $visaForm->delete();

            $notification = [
                'message' => 'Visa Reject Success!',
                'alert-type' => 'success',
            ];

            // Redirect back with notification
            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Visa Form not found!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function visaapplicationdownload($id)
    {
        $visaApplication = VisaApplication::find($id);

        if ($visaApplication) {
            $visaApplicationDownload = public_path("upload/visa/application/{$visaApplication->visa_application}");

            if (file_exists($visaApplicationDownload)) {
                return response()->download($visaApplicationDownload, $visaApplication->visa_application);
            } else {
                $notification = [
                    'message' => 'File not found.',
                    'alert-type' => 'error',
                ];
            }
        } else {
            $notification = [
                'message' => 'Visa Application not found.',
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function visaapplicationdelete($id)
    {
        $visaApplication = VisaApplication::find($id);
        $visaApplication->delete();


        $notification = [
            'message' => 'Visa Application Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    //visa copy
    public function visacopylist()
    {
        $data = VisaCopy::latest()->get();
        return view('admin.visa.visa_copy', compact('data'));
    }

    public function visacopydownload($id)
    {
        $visafile = VisaCopy::find($id);

        if ($visafile) {
            $visafiledownload = public_path("upload/visa/file/{$visafile->visa_file}");

            if (file_exists($visafiledownload)) {
                $headers = [
                    'Content-Type' => 'application/octet-stream',
                    'Content-Disposition' => 'attachment; filename="' . $visafile->visa_file . '"',
                ];
                return response()->download($visafiledownload, $visafile->visa_file, $headers);
            } else {
                $notification = [
                    'message' => 'File not found.',
                    'alert-type' => 'error',
                ];
            }
        } else {
            $notification = [
                'message' => 'Visa File not found.',
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function visacopydelete($id)
    {
        $visafile = VisaCopy::find($id);
        $file_path = public_path('upload/visa/file/' . $visafile->visa_file);
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        $visafile->delete();

        $notification = [
            'message' => 'Visa File Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
