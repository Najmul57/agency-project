<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\DocumentVerification;
use App\Models\Expensive;
use App\Models\LetterGuideLine;
use Illuminate\Support\Facades\File;
use App\Models\LetterVerification;
use App\Models\NocGuideLine;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Models\Payfees;
use App\Models\PaymentGuideline;
use App\Models\PrimiumCountry;
use App\Models\PrimiumCourse;
use App\Models\PrimiumUniversity;
use App\Models\PrimiumUniversityCourse;
use App\Models\ProgramType;
use App\Models\ReferenceGuideLine;
use App\Models\StudenHelp;
use App\Models\PrimiumUniversityContent;
use App\Models\TicketingGuideLine;
use App\Models\TicketStatus;
use App\Models\TravelGuideline;
use App\Models\User;
use App\Models\VisaApplication;
use PDF;
use App\Models\VisaGuideLine;
use App\Models\WelcomeVideo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role_id', 1)->count();
        $partners = User::where('role_id', 3)->count();
        $primiumStudents = User::where('role_id', 2)->where('is_primium', 'is_primium')->count();
        $freeStudents = User::where('role_id', 2)
            ->where(function ($query) {
                $query->where('is_primium', 'is_free')->orWhereNull('is_primium');
            })
            ->count();

        $countries = PrimiumCountry::count();
        $universities = PrimiumUniversity::count();
        $dicipline = ProgramType::count();
        $departments = PrimiumCourse::count();
        $courses = PrimiumUniversityCourse::count();
        $content = PrimiumUniversityContent::count();
        $userAmount = User::sum('amount');

        //verification
        $offerLetter = DocumentVerification::where('document', 'Offer Letter')->sum('amount');
        $admissionLetter = DocumentVerification::where('document', 'Admission Letter')->sum('amount');
        $doctorLetter = DocumentVerification::where('document', 'Doctor Appointment Letter')->sum('amount');
        $anotherLetter = DocumentVerification::where('document', 'Another Letter')->sum('amount');

        // admission
        $displayAdmission = Payfees::where('display_type', 'Admission')->sum('display_amount');
        $grandAdmission = Payfees::where('display_type', 'Admission')->sum('grand_total');

        $finalAdmissionAmount = $displayAdmission + $grandAdmission;

        //tuition fees
        $displayTuitionFees = Payfees::where('display_type', 'Tuition_fee')->sum('display_amount');
        $grandTuitionFees = Payfees::where('display_type', 'Tuition_fee')->sum('grand_total');

        $finalTuitionFeesAmount = $displayTuitionFees + $grandTuitionFees;

        // tickets
        $displayTicket = Payfees::where('display_type', 'Tickets')->sum('display_amount');
        $grandTicket = Payfees::where('display_type', 'Tickets')->sum('grand_total');

        $finalTicket = $displayTicket + $grandTicket;

        //visa purpose
        $displayVisa = Payfees::where('display_type', 'Visa_purpose')->sum('display_amount');
        $grandVisa = Payfees::where('display_type', 'Visa_purpose')->sum('grand_total');

        $finalVisa = $displayVisa + $grandVisa;

        //applications
        $displayApplication = Payfees::where('display_type', 'application_fees')->sum('display_amount');
        $grandApplication = Payfees::where('display_type', 'application_fees')->sum('grand_total');

        $finalApplication = $displayApplication + $grandApplication;

        //service charge
        $displayService = Payfees::where('display_type', 'Service_charge')->sum('display_amount');
        $grandService = Payfees::where('display_type', 'Service_charge')->sum('grand_total');

        $finalService = $displayService + $grandService;

        //others
        $displayOthers = Payfees::where('display_type', 'Others')->sum('display_amount');
        $grandOthers = Payfees::where('display_type', 'Others')->sum('grand_total');

        $finalOthers = $displayOthers + $grandOthers;

        //total amount
        $totalAmount = $userAmount + $offerLetter + $admissionLetter + $admissionLetter + $doctorLetter + $anotherLetter + $finalAdmissionAmount + $finalTuitionFeesAmount + $finalTuitionFeesAmount + $finalVisa + $finalService + $finalOthers + $finalApplication;

        return view('admin.index', compact('admins', 'partners', 'primiumStudents', 'freeStudents', 'universities', 'countries', 'finalAdmissionAmount', 'finalTuitionFeesAmount', 'finalTicket', 'finalVisa', 'finalService', 'finalOthers', 'offerLetter', 'admissionLetter', 'doctorLetter', 'anotherLetter', 'userAmount', 'totalAmount', 'dicipline', 'departments', 'courses', 'finalApplication', 'content'));
    } // end method

    public function partner(){
        $partnets=User::where('role_id',3)->get();
        return view('admin.partner.index',compact('partnets'));
    }

    public function passwordchange()
    {
        return view('admin.profile.change_password');
    } // end method

    public function adminLogin()
    {
        return view('admin.login');
    } //end method

    public function profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile.profile', compact('adminData'));
    } // end method

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filePath = public_path('upload/admin_images/' . $data->photo);
        
            if (File::exists($filePath) && File::isFile($filePath)) {
                unlink($filePath);
            }
        
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = [
            'message' => 'Admin Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function passwordupdate(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::whereEmail($request->email)->first();

        if (!$user) {
            $notification = [
                'message' => 'User not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $user->password = Hash::make($request->password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        $notification = [
            'message' => 'Password Change Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.login')->with($notification);
    }

    public function adminLogout()
    {
        Auth::logout();

        $notification = [
            'message' => 'Admin logout Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('admin.login')->with($notification);
    } // end method

    public function allAdmin()
    {
        $allAdmin = User::where('role_id', 1)->latest()->get();
        return view('admin.admin.index', compact('allAdmin'));
    } // end method

    public function addAdmin()
    {
        $roles = Role::all();
        return view('admin.admin.create', compact('roles'));
    } // end method

    public function storeAdmin(Request $request)
    {
        $system_id = User::generateSystemId();
        $request->validate([
            'roles' => 'required|exists:roles,id',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'password' => 'required|min:6',
        ]);

        $admin = new User();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->system_id = User::generateSystemId();
        $admin->phone = $request->input('phone');
        $admin->role_id = '1';
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        $role = Role::findById($request->input('roles'));
        if ($role) {
            $admin->assignRole($role);
        }

        $notification = [
            'message' => 'Admin Create Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.admin')->with($notification);
    }

    public function editAdmin($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.admin.edit', compact('roles', 'user'));
    } // end method

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->save();

        $role = Role::findById($request->input('roles'));
        if ($role) {
            $admin->syncRoles([$role->name]);
        } else {
            // If the role doesn't exist, you may want to handle this case accordingly.
        }

        $notification = [
            'message' => 'Admin Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('all.admin')->with($notification);
    }

    public function destroy($id)
    {
        $adminDelete = User::findOrFail($id);

        if (!is_null($adminDelete)) {
            $adminDelete->delete();
        }

        $notification = [
            'message' => 'Admin Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function contactmessage()
    {
        $message = Contact::latest()->get();
        return view('admin.contact_message.index', compact('message'));
    } // end method

    public function contactmessagedelete($id)
    {
        $data = Contact::findOrFail($id);
        $data->delete();

        $notification = [
            'message' => 'Message Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function studenthelp()
    {
        $data = StudenHelp::first();
        return view('admin.studenthelp.index', compact('data'));
    } // end method

    public function studenthelpcreateupdate(Request $request, $id)
    {
        StudenHelp::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function letterGuideline()
    {
        $data = LetterGuideLine::first();
        return view('admin.guideline.letter', compact('data'));
    } // end method

    public function letterGuidelineUpdate(Request $request, $id)
    {
        LetterGuideLine::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function paymentGuideline()
    {
        $data = PaymentGuideline::first();
        return view('admin.guideline.payment', compact('data'));
    } // end method

    public function paymentGuidelineUpdate(Request $request, $id)
    {
        PaymentGuideline::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function nocGuideline()
    {
        $data = NocGuideLine::first();
        return view('admin.guideline.noc', compact('data'));
    } // end method

    public function nocGuidelineUpdate(Request $request, $id)
    {
        NocGuideLine::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function visaGuideline()
    {
        $data = VisaGuideLine::first();
        return view('admin.guideline.visa', compact('data'));
    } // end method

    public function visaGuidelineUpdate(Request $request, $id)
    {
        VisaGuideLine::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function ticketingGuideline()
    {
        $data = TicketingGuideLine::first();
        return view('admin.guideline.ticketing', compact('data'));
    } // end method

    public function ticketingGuidelineUpdate(Request $request, $id)
    {
        TicketingGuideLine::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Travel Guideline Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function travelGuideline()
    {
        $data = TravelGuideline::first();
        return view('admin.guideline.travelguideline', compact('data'));
    } // end method

    public function travelGuidelineStore(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required',
            'pdf' => 'required|mimes:pdf',
            'mode' => 'required',
        ]);

        try {
            $travelGuideline = TravelGuideline::create([
                'user_id' => $request->user_id,
                'mode' => $request->mode,
                'description' => $request->description,
            ]);

            if ($request->hasFile('pdf')) {
                $file = $request->file('pdf');
                $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
                $file->move(public_path('upload/travelguideline'), $filename);
                $travelGuideline->pdf = $filename;
                $travelGuideline->save();
            }

            $notification = [
                'message' => 'Travel Guideline Insert Success!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                $notification = [
                    'message' => "This Person's Travel Guideline already uploaded",
                    'alert-type' => 'error',
                ];
            } else {
                Log::error($e);

                $notification = [
                    'message' => 'An error occurred while saving the guideline. Please try again.',
                    'alert-type' => 'error',
                ];
            }

            return redirect()->back()->with($notification);
        }
    }

    public function travelGuidelineShow($id)
    {
        $data = TravelGuideline::find($id);
        return view('admin.guideline.show', compact('data'));
    } // end method
    public function travelGuidelineDestroy($id)
    {
        $data = TravelGuideline::find($id);

        if ($data->pdf && file_exists(public_path('upload/travelguideline/' . $data->pdf))) {
            unlink(public_path('upload/travelguideline/' . $data->pdf));
        }

        $data->delete();

        $notification = [
            'message' => 'Travel Guideline Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function active($id)
    {
        TravelGuideline::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Travel Guideline Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        TravelGuideline::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Travel Guideline Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function ticketstatus()
    {
        $data = TicketStatus::latest()->get();
        return view('admin.guideline.ticketstatus', compact('data'));
    } // end method

    public function ticketstatusstore(Request $request)
    {
        $existingTicketStatus = TicketStatus::where('user_id', $request->user_id)->first();

        if ($existingTicketStatus) {
            $notification = [
                'message' => 'Ticket Status already submitted for this student!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        TicketStatus::create([
            'user_id' => $request->user_id,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Ticket Status Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function ticketstatusdestroy($id)
    {
        $data = TicketStatus::find($id);
        $data->delete();

        $notification = [
            'message' => 'Ticket Status Destroy Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function referanceGuideline()
    {
        $data = ReferenceGuideLine::first();
        return view('admin.guideline.referance', compact('data'));
    } // end method

    public function referanceGuidelineUpdate(Request $request, $id)
    {
        ReferenceGuideLine::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function verificationGuideline()
    {
        $data = LetterVerification::first();
        return view('admin.guideline.verification', compact('data'));
    } // end method

    public function verificationGuidelineUpdate(Request $request, $id)
    {
        LetterVerification::findOrFail($id)->update([
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Message Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function payfeeslist()
    {
        $data = Payfees::latest()->get();
        return view('admin.payment.index', compact('data'));
    } // end method

    public function payfeesdownload($id)
    {
        $payment = Payfees::findOrFail($id);

        $pdf = PDF::loadView('user.payments.receipt', compact('payment'));

        return $pdf->download('payment_receipt_' . $payment->receipt_id);
    } // end method

    public function payfeesdestroy($id)
    {
        $payment = Payfees::find($id);

        if ($payment->pdf && file_exists(public_path('upload/payment/' . $payment->pdf))) {
            unlink(public_path('upload/payment/' . $payment->pdf));
        }

        if ($payment->signature && file_exists(public_path('upload/payment/signature/' . $payment->signature))) {
            unlink(public_path('upload/payment/signature/' . $payment->signature));
        }

        $payment->delete();

        $notification = [
            'message' => 'Payment Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function invoiceactive($id)
    {
        Payfees::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Student Show Payment Invoice!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function invoiceinactive($id)
    {
        Payfees::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Student not Show Payment Invoice!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function visaapplication()
    {
        $data = VisaApplication::latest()->get();
        return view('admin.visa.applicationCopy', compact('data'));
    } // end method

    public function welcomeVideo()
    {
        $data = WelcomeVideo::first();
        return view('admin.welcome.video', compact('data'));
    } // end method

    public function welcomeVideoUpdate(Request $request, $id)
    {
        WelcomeVideo::findOrFail($id)->update([
            'video' => $request->video,
            'partner' => $request->partner,
        ]);

        $notification = [
            'message' => 'Welcome Video Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
