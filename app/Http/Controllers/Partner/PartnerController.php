<?php

namespace App\Http\Controllers\Partner;

use PDF;
use App\Models\User;
use App\Models\Refund;
use App\Models\Payfees;
use App\Models\VisaCopy;
use App\Models\TicketForm;
use App\Models\Offerletter;
use App\Models\ProgramType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AnotherLetter;
use App\Models\PrimiumCourse;
use App\Models\PaymentReceipt;
use App\Models\PrimiumCountry;
use App\Models\AdmissionLetter;
use App\Models\StudentFeedback;
use App\Models\TravelGuideline;
use App\Models\VisaApplication;
use App\Mail\RandomPasswordEmail;
use App\Models\PrimiumUniversity;
use App\Http\Controllers\Controller;
use App\Mail\VisaLetter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PrimiumUniversityCourse;
use App\Models\PrimiumUniversityContent;
use App\Models\VisaLetter as ModelsVisaLetter;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function partnerRegister(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'city' => 'required|string',
            'amount' => 'required|numeric',
            'method' => 'required|string',
            'txt_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Retrieve validated data
        $data = $validator->validated();

        $password = Str::random(10);

        // Generate system_id
        $system_id = User::generateSystemId();

        Mail::to($data['email'])->send(new RandomPasswordEmail($password, $system_id, $data['name'], $data['email'], $data['regis__country'] ?? '', $data['regis__university'] ?? '', $data['regis__course'] ?? '', $data['regis__uni__course'] ?? ''));

        // Handle file uploads
        $paths = [];
        $uploadPath = public_path('upload/student');

        foreach (['nid', 'o_level', 'a_level', 'graduate', 'post_graduate', 'photo', 'signature', 'others'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $paths[$field] = $filename;
            }
        }

        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'role_id' => 3,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_primium' => 'is__partner',
            'amount' => $data['amount'] ?? null,
            'method' => $data['method'] ?? null,
            'txt_number' => $data['txt_number'] ?? null,
            'city' => $data['city'] ?? null,
            'system_id' => $system_id,
            'password' => Hash::make($password),
            'nid' => $paths['nid'] ?? null,
            'o_level' => $paths['o_level'] ?? null,
            'a_level' => $paths['a_level'] ?? null,
            'graduate' => $paths['graduate'] ?? null,
            'post_graduate' => $paths['post_graduate'] ?? null,
            'photo' => $paths['photo'] ?? null,
            'signature' => $paths['signature'] ?? null,
            'others' => $paths['others'] ?? null,
        ]);

        // Logout any existing user
        Auth::logout();

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Partner Registration successful. Check your email for login credentials.');
    }

    public function index()
    {
        //student
        $students = User::where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->count();
        //system id
        if (Auth::check()) {
            $system_id = Auth::user()->system_id;
        } else {
            return 'User not authenticated.';
        }
        //offer letter
        $offerLetter = Offerletter::whereHas('user', function ($query) {
            $query->where('referance', auth()->user()->email);
        })->count();
        //admission letter
        $admissionLetter = AdmissionLetter::whereHas('user', function ($query) {
            $query->where('referance', auth()->user()->email);
        })->count();
        //visa permission

        return view('partner.index', compact('students', 'system_id', 'offerLetter', 'admissionLetter'));
    }

    public function partnerLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Successfully logged out.');
    }

    public function profile()
    {
        $authUser = Auth::user();
        // return $authUser;
        return view('partner.profile.profile', compact('authUser'));
    }

    public function profileStore(Request $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        // $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        $user->save();

        $notification = [
            'message' => 'Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function passwordchange()
    {
        return view('partner.profile.change_password');
    } // end method

    public function passwordupdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $oldpassword = $request->old_password;
        $user = User::findOrFail(Auth::id());

        if (Hash::check($oldpassword, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            $notification = [
                'message' => 'Password Change Success!',
                'alert-type' => 'success',
            ];
            return redirect()->route('login')->with($notification);
        } else {
            $notification = [
                'message' => 'Old Password not Match!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    } // end method

    public function partnerrefund()
    {
        $data = Refund::first();
        return view('partner.refund.index', compact('data'));
    }

    public function feedback()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has already submitted feedback
        $data = StudentFeedback::where('user_id', $user->id)->first();
        $userName = $user->name;
        $universityName = $user->university_name;

        return view('partner.feedback.index', compact('data', 'userName', 'universityName'));
    } // end method

    public function store(Request $request, $id)
    {
        // Validate the request as needed
        $request->validate([
            'feedback' => 'required',
        ]);

        $user = Auth::user();
        $existingFeedback = StudentFeedback::where('user_id', $user->id)->first();

        if ($existingFeedback) {
            $notification = [
                'message' => 'You have already submitted feedback!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Save the feedback for the user
        $feedback = new StudentFeedback();
        $feedback->user_id = $user->id;
        $feedback->feedback = $request->input('feedback');
        $feedback->save();

        // Redirect or respond as needed
        $notification = [
            'message' => 'Feedback submitted successfully!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function universityDetails()
    {
        $countries = PrimiumCountry::where('status', 1)->orderBy('name', 'asc')->latest()->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $courses = PrimiumCourse::where('status', 1)->get();
        $universityCourse = PrimiumUniversityCourse::where('status', 1)->get();
        $content = PrimiumUniversityContent::get();

        return view('partner.universitiy.university_details', compact('countries', 'courses', 'universities', 'universityCourse', 'content'));
    }

    public function partnerFetchUniversity(Request $request)
    {
        $countryId = $request->input('country_id');
        $universities = PrimiumUniversity::where('country_id', $countryId)->get();

        return response()->json(['university' => $universities]);
    }

    public function partnerFetchProgram(Request $request)
    {
        $university_id = $request->input('university_id');

        // Assuming Program is your model representing programs
        $programs = ProgramType::where('university_id', $university_id)->get();

        return response()->json(['programs' => $programs]);
    }

    public function partnerFetchDepartment(Request $request)
    {
        $programId = $request->input('program_id'); // Adjusted to match the AJAX data
        $departments = PrimiumCourse::where('program_type_id', $programId)->get();

        return response()->json(['departments' => $departments]);
    }

    public function partnerFetchUniversityCourse(Request $request)
    {
        $courseId = $request->input('course_id');
        $universityCourses = PrimiumUniversityCourse::where('course_id', $courseId)->get();

        return response()->json(['universityCourses' => $universityCourses]);
    } // end method

    public function partnerFetchUniversityContent(Request $request)
    {
        $contentId = $request->input('universitycourse_id');
        $universityContent = PrimiumUniversityContent::where('status', 1)->where('universitycourse_id', $contentId)->get();

        return response()->json(['universityContent' => $universityContent]);
    } // end method

    public function partnerReferance()
    {
        return view('partner.referance.index');
    }

    public function referanceform(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate(
            [
                'email' => 'required|email|unique:users,email',
            ],
            [
                'email.unique' => 'Sorry!! This email already exists in the database. Please try a unique email.',
            ],
        );

        $user = Auth::user();
        $user->balance += 10;
        $user->save();

        $password = Str::random(10);
        $system_id = User::generateSystemId();

        // Email data
        $name = $request->name;
        $email = $request->email;
        $regis__country = $request->regis__country;
        $regis__university = $request->regis__university;
        $regis__course = $request->regis__course;
        $regis__uni__course = $request->regis__uni__course;

        $sendStudentEmail = $request->has('studentemail'); // Check if the checkbox is selected

        // Send email only if the checkbox is selected
        if ($sendStudentEmail) {
            // Send email
            Mail::to($email)->send(new RandomPasswordEmail($password, $system_id, $name, $email, $regis__country, $regis__university, $regis__course, $regis__uni__course));
        }

        $paths = [];
        $uploadPath = public_path('upload/student');

        foreach (['nid', 'o_level', 'a_level', 'graduate', 'post_graduate', 'photo', 'signature', 'others'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $paths[$field] = $filename;
            }
        }

        // Create the user
        $newUser = User::create([
            'name' => $request->name,
            'role_id' => 2,
            'phone' => $request->phone,
            'referance' => $request->referance,
            'email' => $request->email,
            'city' => $request->city,
            'regis__country' => $request->country_id,
            'regis__university' => $request->university_id,
            'regis__program' => $request->program_id,
            'regis__course' => $request->course_id,
            'regis__uni__course' => $request->unicourse_id,
            'system_id' => User::generateSystemId(),
            'password' => Hash::make($password),
            'nid' => $paths['nid'] ?? null,
            'o_level' => $paths['o_level'] ?? null,
            'a_level' => $paths['a_level'] ?? null,
            'graduate' => $paths['graduate'] ?? null,
            'post_graduate' => $paths['post_graduate'] ?? null,
            'photo' => $paths['photo'] ?? null,
            'signature' => $paths['signature'] ?? null,
            'others' => $paths['others'] ?? null,
        ]);

        if (!$newUser) {
            return redirect()->back()->with('error', 'Failed to create user.');
        }

        $notification = [
            'message' => 'Student registered successfully and 10 cents Add your account!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function partnerReferrance($id)
    {
        $singleStudent = User::where('id', $id)
            ->where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->first();

        return view('partner.referance.singleStudent', compact('singleStudent'));
    }

    public function partnerReceiptDownload($id)
    {
        $payment = PaymentReceipt::where('user_id', $id)->first();

        if ($payment) {
            $pdf = PDF::loadView('partner.payment.referance_receipt', compact('payment'));
            return $pdf->download('payment_receipt_' . $payment->receipt_id . '.pdf');
        } else {
            return redirect()->back()->with('error', 'Payment receipt not found for this user');
        }
    }

    public function partnerOfferLettterDownload($id)
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
    }

    public function partneranatherletterDownload($id)
    {
        $anatherLetter = AnotherLetter::findOrFail($id);
        $filePath = public_path('upload/letter/anotherletter/' . $anatherLetter->another_letter);

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

    public function partnerVisaPermissionLetterDownload($id)
    {
        $visaLetter = \App\Models\VisaLetter::findOrFail($id);
        // return $visaLetter;
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

    public function admissionletterdownloadpartner($id)
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

    //admin visa letter
    public function partnerAnotherLetterDownload($id)
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

    public function travelGuideline()
    {
        // $guideline=TravelGuideline::all();
        $data = User::where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->get();
        // return $guideline;
        return view('partner.travelGuideline.index', compact('data'));
    }

    public function singleTravel($id)
    {

       $data = User::where('role_id', 2)
    ->with('travelguideline')
    ->where('referance', auth()->user()->email)
    ->find($id);

        return view('partner.travelGuideline.show', compact('data'));
    }

    public function ticketform()
    {
        $users = User::where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->get();
        return view('partner.ticket.index', compact('users'));
    }

    public function ticketstore(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'traveldate' => 'required',
            'travelby' => 'required',
            'from' => 'required',
            'to' => 'required',
            'person' => 'required',
            'passport' => 'required',
            'visa' => 'required',
        ]);

        $ticketForm = new TicketForm();
        $ticketForm->user_id = $request->user_id;
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

    public function offerletter()
    {
        return view('partner.offerlerrer.index');
    }
    public function anatherletter()
    {
        return view('partner.anotherletter.index');
    }
    public function admissionletter()
    {
        return view('partner.admissionletter.index');
    }
    public function visapermissionletter()
    {
        return view('partner.visapermissionletter.index');
    }
    public function uploadvisacopy()
    {
        return view('partner.visaupload.index');
    }
    public function uploadvisacopystore(Request $request)
    {
        $validated = $request->validate([
            'visa_file' => 'required',
        ]);

        $existingVisaCopy = VisaCopy::where('user_id', auth()->id())->first();

        if ($existingVisaCopy) {
            $notification = [
                'message' => 'Visa Copy has already been uploaded.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $visacopy = new VisaCopy();
        $visacopy->user_id = $request->user_id;

        if ($request->hasFile('visa_file')) {
            $file = $request->file('visa_file');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/visa/file'), $filename);
            $visacopy->visa_file = $filename;
        }

        $visacopy->save();

        $notification = [
            'message' => 'Visa Application Upload Success!',
            'alert-type' => 'success',
        ];

        // Redirect back with notification
        return redirect()->back()->with($notification);
    }

    public function partnerpaymen()
    {
        return view('partner.payment.index');
    }
    public function partnerpaymensingle($id)
    {
        $singleStudent = User::where('role_id', 2)
            ->where('id', $id)
            ->where('referance', auth()->user()->email)
            ->first();
        return view('partner.payment.form', compact('singleStudent'));
    }
    // public function partnerpaymenlist()
    // {
    //     return 'hi';
    // }

    //partnet student payment receipt upload
    public function paymentreceiptuploadPartnetStudent(Request $request)
    {
        $request->validate([
            'referace_user_id' => 'required|exists:users,id,role_id,2',
            'receipt' => 'required|file',
        ]);

        $existingReceipt = PaymentReceipt::where('user_id', $request->referace_user_id)->first();

        if ($existingReceipt) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Payment receipt for this student has already been uploaded.',
                    'alert-type' => 'error',
                ]);
        }

        if ($request->file('receipt')) {
            $file = $request->file('receipt');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/payment/paymentreceipt'), $filename);

            PaymentReceipt::create([
                'user_id' => $request->referace_user_id,
                'receipt' => $filename,
                'created_at' => now(),
            ]);

            return redirect()
                ->back()
                ->with([
                    'message' => 'Reference Student Payment Receipt uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        }
    }

    public function deletepartneradmin($id)
    {
        $partnerDelete = User::where('id', $id)->where('role_id', 3);
        if ($partnerDelete->exists()) {
            $student = $partnerDelete->first();
            // Delete student's associated file
            if ($student->photo) {
                $photo = public_path('upload/student/' . $student->photo);
                if (file_exists($photo)) {
                    unlink($photo);
                }
            }
            if ($student->signature) {
                $signature = public_path('upload/student/' . $student->signature);
                if (file_exists($signature)) {
                    unlink($signature);
                }
            }
            if ($student->nid) {
                $nid = public_path('upload/student/' . $student->nid);
                if (file_exists($nid)) {
                    unlink($nid);
                }
            }
            if ($student->o_level) {
                $o_level = public_path('upload/student/' . $student->o_level);
                if (file_exists($o_level)) {
                    unlink($o_level);
                }
            }
            if ($student->a_level) {
                $a_level = public_path('upload/student/' . $student->a_level);
                if (file_exists($a_level)) {
                    unlink($a_level);
                }
            }
            if ($student->graduate) {
                $graduate = public_path('upload/student/' . $student->graduate);
                if (file_exists($graduate)) {
                    unlink($graduate);
                }
            }
            if ($student->post_graduate) {
                $post_graduate = public_path('upload/student/' . $student->post_graduate);
                if (file_exists($post_graduate)) {
                    unlink($post_graduate);
                }
            }
            if ($student->others) {
                $others = public_path('upload/student/' . $student->others);
                if (file_exists($others)) {
                    unlink($others);
                }
            }
            // Delete Partner record
            $partnerDelete->delete();
            $notification = [
                'message' => 'Partner deleted successfully!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Partner is not success!',
                'alert-type' => 'info',
            ];
        }
        return redirect()->back()->with($notification);
    }
    public function toggleStatus($id)
    {
        $partner = User::where('id', $id)->where('role_id', 3)->first();
        if ($partner) {
            $partner->status = $partner->status == 1 ? 0 : 1;
            $partner->save();

            $notification = [
                'message' => $partner->status == 1 ? 'Partner Approved Success!' : 'Partner Inapproved Success!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Partner not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
