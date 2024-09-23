<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NocForAll;
use App\Models\NocForm;
use App\Models\NocGuideLine;
use App\Models\NocPdf;
use PDF;
use App\Models\NocUser;
use App\Models\PrimiumCountry;
use App\Models\PrimiumCourse;
use Illuminate\Support\Str;
use Image;
use App\Models\PrimiumUniversity;
use Illuminate\Support\Facades\Storage;
use App\Models\PrimiumUniversityCourse;
use App\Models\ProgramType;
use App\Models\StudenHelp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NocController extends Controller
{
    public function nocPage()
    {
        $help = StudenHelp::first();
        $nocGuideline = NocGuideLine::first();
        return view('user.noc.page', compact('help', 'nocGuideline'));
    } // end method

    public function nocFormSubmit(Request $request)
    {
        $existingRecord = NocForm::where('system_id', $request->system_id)->first();

        if ($existingRecord) {
            $notification = [
                'message' => 'NOC form has already been submitted!',
                'alert-type' => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        $data = new NocForm();

        if ($request->file('signature')) {
            $file = $request->file('signature');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/noc'), $filename);
            Image::make(public_path('upload/noc') . '/' . $filename)
                ->resize(100, 25)
                ->save('upload/noc/' . $filename);
            $data->signature = $filename;
        }

        if ($request->file('guirdiansignature')) {
            $file = $request->file('guirdiansignature');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/noc'), $filename);
            Image::make(public_path('upload/noc') . '/' . $filename)
                ->resize(100, 25)
                ->save('upload/noc/' . $filename);
            $data->guirdiansignature = $filename;
        }

        $data->system_id = $request->system_id;
        $data->name = $request->name;
        $data->user_id = $request->user_id;
        $data->f_name = $request->f_name;
        $data->m_name = $request->m_name;
        $data->passport = $request->passport;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->number = $request->number;
        $data->country = $request->country_id;
        $data->university = $request->university_id;
        $data->program_type = $request->program_id;
        $data->department = $request->course_id;
        $data->uni_course = $request->unicourse_id;

        $data->save();

        $country = PrimiumCountry::find($data->country);
        $university = PrimiumUniversity::find($data->university);
        $type = ProgramType::find($data->program_type);
        $department = PrimiumCourse::find($data->department);
        $uni_course = PrimiumUniversityCourse::find($data->uni_course);

        $pdf = PDF::loadView('admin.noc.form_list.pdf', compact('data', 'country', 'university', 'type', 'department', 'uni_course'));

        $pdfPath = 'noc_forms/noc-form-' . $data->system_id . '.pdf';

        Storage::put($pdfPath, $pdf->output());

        $data->pdf_path = $pdfPath;
        $data->save();

        $notification = [
            'message' => 'NOC form submitted successfully!',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function downloadPDF($id)
    {
        $data = NocForm::find($id);
        $country = PrimiumCountry::find($data->country);
        $university = PrimiumUniversity::find($data->university);
        $type = ProgramType::find($data->program_type);
        $department = PrimiumCourse::find($data->department);
        $uni_course = PrimiumUniversityCourse::find($data->uni_course);

        $pdf = PDF::loadView('admin.noc.form_list.pdf', compact('data', 'country', 'university', 'type', 'department', 'uni_course'));

        $pdfPath = 'noc_forms/noc-form-' . $data->system_id . '.pdf';

        return $pdf->download('noc_form.pdf');
    }

    public function nocpdfstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'pdf' => 'required|mimes:pdf',
        ]);

        $user_id = $request->user_id;

        $existingFile = NocPdf::where('user_id', $user_id)->first();

        if ($existingFile) {
            $notification = [
                'message' => 'Noc File Already Uploaded for This Student.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $file = $request->file('pdf');
        $filename = date('YmdHi') . $file->getClientOriginalName();

        $file->move(public_path('upload/noc'), $filename);

        NocPdf::create(['user_id' => $user_id, 'pdf' => $filename]);

        $notification = [
            'message' => 'File uploaded successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function nocpdfdestroy($id)
    {
        $data = NocPdf::find($id);

        if ($data) {
            $filePath = public_path('upload/noc/' . $data->pdf);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $data->delete();

            $notification = [
                'message' => 'NOC deleted successfully',
                'alert-type' => 'error',
            ];
        } else {
            $notification = [
                'message' => 'NOC not found',
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function uploadNocAllStudent()
    {
        return view('admin.noc.nocUpload');
    } // end method

    public function uploadNocAllStudentUpload(Request $request)
    {
        $request->validate([
            'pdf' => 'required|file|mimes:pdf|max:10240',
        ]);

        $uploadedFile = $request->file('pdf');

        $existingFile = NocForAll::latest()->first();

        $existingFileName = $existingFile ? $existingFile->nocfile : null;
        if ($existingFileName && file_exists(public_path('upload/noc/all/' . $existingFileName))) {
            $existingFileHash = md5_file(public_path('upload/noc/all/' . $existingFileName));
            $uploadedFileHash = md5_file($uploadedFile);

            if ($existingFileHash === $uploadedFileHash) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'The uploaded file is a duplicate. Please upload a new file.',
                        'alert-type' => 'error',
                    ]);
            }
        }

        if ($existingFile) {
            $existingFilePath = public_path('upload/noc/all/' . $existingFile->nocfile);
            if (file_exists($existingFilePath)) {
                try {
                    unlink($existingFilePath);
                } catch (\Exception $e) {
                    return redirect()
                        ->back()
                        ->with([
                            'message' => 'Error occurred while removing the existing file: ' . $e->getMessage(),
                            'alert-type' => 'error',
                        ]);
                }
            }
            $existingFile->delete();
        }

        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();

        $uploadedFile->move(public_path('upload/noc/all'), $fileName);

        NocForAll::create([
            'nocfile' => $fileName,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'NOC File uploaded successfully!',
                'alert-type' => 'success',
            ]);
    }

    public function nocdownload()
    {
        $nocPdf = NocForAll::latest()->first();

        if ($nocPdf) {
            $filePath = public_path('upload/noc/all/' . $nocPdf->nocfile);

            if (file_exists($filePath)) {
                return response()->download($filePath, $nocPdf->nocfile);
            }
        }

        abort(404, 'NOC file not found.');
    }

    public function nocList()
    {
        $noc = NocUser::latest()->get();
        return view('admin.noc.list', compact('noc'));
    } // end method

    public function nocFormList()
    {
        $data = NocForm::latest()->get();
        return view('admin.noc.form_list', compact('data'));
    }

    public function nocFormsingle($id)
    {
        $data = NocForm::find($id);
        $country = PrimiumCountry::find($data->country);
        $university = PrimiumUniversity::find($data->university);
        $type = ProgramType::find($data->program_type);
        $department = PrimiumCourse::find($data->department);
        $uni_course = PrimiumUniversityCourse::find($data->uni_course);
        return view('admin.noc.form_list.single', compact('data', 'country', 'university', 'type', 'department', 'uni_course'));
    }

    public function downloadPDFStudent($id)
    {
        $data = NocForm::find($id);
        $country = PrimiumCountry::find($data->country);
        $university = PrimiumUniversity::find($data->university);
        $type = ProgramType::find($data->program_type);
        $department = PrimiumCourse::find($data->department);
        $uni_course = PrimiumUniversityCourse::find($data->uni_course);

        $pdf = PDF::loadView('admin.noc.form_list.pdf', compact('data', 'country', 'university', 'type', 'department', 'uni_course'));

        return $pdf->download('noc_form.pdf');
    }

    public function nocDestroyStudent($id)
    {
        $data = NocForm::find($id);
        $data->delete();

        return redirect()
            ->back()
            ->with([
                'message' => 'NOC Delete successfully!',
                'alert-type' => 'success',
            ]);
    }

    public function nocFormDownload($id)
    {
        $data = NocForm::findOrFail($id);

        $pdf = PDF::loadView('admin.pdf.noc_pdf', compact('data'));

        $pdfFilename = 'noc_' . time() . '.pdf';

        $pdf->save(storage_path('app/public/noc/' . $pdfFilename));

        return $pdf->download($pdfFilename);
    }

    public function downloadNocFile($filename)
    {
        $file = public_path('upload/noc/' . $filename);

        if (file_exists($file)) {
            return response()->download($file);
        } else {
            abort(404, 'File not found');
        }
    } // end method

    public function usernocdownload()
    {
        $user = Auth::user();

        $nocPdf = NocPdf::where('user_id', $user->id)->first();

        if ($nocPdf) {
            $filePath = public_path('upload/noc/' . $nocPdf->pdf);

            if (file_exists($filePath)) {
                return response()->download($filePath);
            }
        }

        abort(404, 'NOC file not found for the authenticated user.');
    }

    public function nocpdf()
    {
        $data = NocPdf::first();
        return view('admin.noc.create', compact('data'));
    } // end method

    public function nocupload(Request $request)
    {
        $request->validate([
            'uploadpdf' => 'required|file|max:2048',
        ]);

        $uploadedFile = $request->file('uploadpdf');
        $fileName = time() . '_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/noc'), $fileName);

        NocUser::create([
            'user_id' => Auth::user()->id,
            'nocfile' => $fileName,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'NOC File uploaded successfully!',
                'alert-type' => 'success',
            ]);
    } // end method

    public function nocactive($id)
    {
        NocForm::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Student Show NOC File!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function nocinactive($id)
    {
        NocForm::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Student not Show NOC File!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function getNocUniversities(Request $request, $countryId)
    {
        $universities = PrimiumUniversity::where('country_id', $countryId)->orderBy('name', 'ASC')->get();
        return response()->json($universities);
    }
    public function getNocCourses(Request $request, $universityId)
    {
        $courses = PrimiumCourse::where('university_id', $universityId)->orderBy('name', 'ASC')->get();
        return response()->json($courses);
    }

    public function getNocUniCourses(Request $request, $courseId)
    {
        $unicourses = PrimiumUniversityCourse::where('course_id', $courseId)->orderBy('name', 'ASC')->get();
        return response()->json($unicourses);
    } // end method
}
