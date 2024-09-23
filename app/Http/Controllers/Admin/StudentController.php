<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AdmissionLetter as MailAdmissionLetter;
use App\Mail\Invoice;
use App\Mail\OfferLetter;
use App\Mail\PickupLetter;
use App\Mail\PremiumActivated;
use App\Mail\RandomPasswordEmail;
use App\Mail\VisaLetter;
use App\Models\AdmissionLetter;
use App\Models\Payfees;
use App\Models\PrimiumUniversity;
use App\Models\StudentFeedback;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentTicket;
use App\Models\TicketForm;
use App\Models\UniversityAdmissionLetter;
use Illuminate\Support\Facades\Validator;
use App\Models\UniversityInvoice;
use App\Models\UploadInvoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function studentlistadmin()
    {
        // $list = User::where('role_id', 2)->where('is_primium', 'is_primium')->latest()->get();
        $list = User::where('role_id', 2)->latest()->get();
        // return $list;
        return view('admin.student.list', compact('list'));
    } // end method

    public function addstudentadmin()
    {
        return view('admin.student.addStudentAdmin');
    }

     public function toggleStatus($id)
    {
        $student = User::where('id', $id)->where('role_id', 2)->first();
        if ($student) {
            $student->status = $student->status == 1 ? 0 : 1;
            $student->save();

            $notification = [
                'message' => $student->status == 1 ? 'Student Approved Success!' : 'Student Inapproved Success!',
                'alert-type' => 'success',
            ];

            return redirect()->back()->with($notification);
        } else {
            $notification = [
                'message' => 'Student not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    public function deletestudentadmin($id)
    {
        $studentDelete = User::where('id', $id)->where('role_id', 2);
        if ($studentDelete->exists()) {
            $student = $studentDelete->first();
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
            // Delete student record
            $studentDelete->delete();
            $notification = [
                'message' => 'Student deleted successfully!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Student is not success!',
                'alert-type' => 'info',
            ];
        }
        return redirect()->back()->with($notification);
    }

    //admin student store methods
    public function storestudentadmin(Request $request)
    {
        // Generate random password
        $password = Str::random(10);

        // Generate system_id
        $system_id = User::generateSystemId();

        // Get input data
        $data = $request->all();

        // Validate file uploads
        $validator = Validator::make($data, [
            'nid' => 'file|mimes:jpg,png,pdf|max:2048', // Adjust mime types and max size as needed
            'photo' => 'file|mimes:jpg,png|max:2048',
            'signature' => 'file|mimes:jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Initialize paths array
        $paths = [];
        $uploadPath = public_path('upload/student');

        // Handle file uploads
        foreach (['nid', 'photo', 'signature'] as $field) {
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
            'role_id' => 2,
            'phone' => $data['phone'],
            'email' => $data['email'],
            'is_primium' => 'is__free',
            'city' => $data['city'],
            'regis__country' => $data['regis__country'],
            'regis__university' => $data['regis__university'],
            'regis__program' => $data['regis__program'],
            'regis__course' => $data['regis__course'],
            'regis__uni__course' => $data['regis__uni__course'],
            'system_id' => $system_id,
            'password' => Hash::make($password),
            'nid' => $paths['nid'] ?? null,
            'photo' => $paths['photo'] ?? null,
            'signature' => $paths['signature'] ?? null,
        ]);

        Mail::to($data['email'])->send(new RandomPasswordEmail($password, $system_id, $data['name'], $data['email'], $data['regis__country'], $data['regis__university'], $data['regis__program'], $data['regis__course'], $data['regis__uni__course']));

        // Set flash message
        session()->flash('success', 'Student registered successfully and Credential has been sent student email !');

        // Redirect to the students list or any other appropriate page
        return redirect()->back(); // Adjust the route name as needed
    }

    // public function freestudentlistadmin()
    // {
    //     $list = User::where('role_id', 2)
    //         ->where(function ($query) {
    //             $query->where('is_primium', 'is__free')
    //                 ->orWhereNull('is_primium');
    //         })
    //         ->latest()
    //         ->get();

    //     return view('admin.student.freeStudent', compact('list'));
    // }
    // end method

    public function freestudentactiveadmin($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id == 2 && ($user->is_primium === null || $user->is_primium === '' || $user->is_primium === 'is__free')) {
            $user->update(['is_primium' => 'is_primium']);

            Mail::to($user->email)->send(new PremiumActivated($user));

            $notification = [
                'message' => 'User has been successfully activated as a premium member!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'User is already a premium member!',
                'alert-type' => 'info',
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function singlestudentadmin($id)
    {
        $singlestudent = User::findOrFail($id);
        return view('admin.student.singlestudent', compact('singlestudent'));
    } // end method

    public function studentupdateadmin(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->input('name');
        $user->m_name = $request->input('m_name');
        $user->f_name = $request->input('f_name');
        $user->dob = $request->input('dob');
        $user->regis__uni__course = $request->input('regis__course');
        $user->email = $request->input('email');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        if ($request->hasFile('o_level')) {
            $file = $request->file('o_level');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            $user->o_level = $filename;
        }
        if ($request->file('a_level')) {
            $file = $request->file('a_level');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->a_level) {
                $a_level = public_path('upload/student/' . $user->a_level);
                if (file_exists($a_level)) {
                    unlink($a_level);
                }
            }
            $user->a_level = $filename;
        }
        if ($request->file('graduate')) {
            $file = $request->file('graduate');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->graduate) {
                $graduate = public_path('upload/student/' . $user->graduate);
                if (file_exists($graduate)) {
                    unlink($graduate);
                }
            }
            $user->graduate = $filename;
        }
        if ($request->file('post_graduate')) {
            $file = $request->file('post_graduate');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->post_graduate) {
                $post_graduate = public_path('upload/student/' . $user->post_graduate);
                if (file_exists($post_graduate)) {
                    unlink($post_graduate);
                }
            }
            $user->post_graduate = $filename;
        }

        if ($request->file('nid')) {
            $file = $request->file('nid');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->nid) {
                $nid = public_path('upload/student/' . $user->nid);
                if (file_exists($nid)) {
                    unlink($nid);
                }
            }
            $user->nid = $filename;
        }

        if ($request->file('photo')) {
            $file = $request->file('photo');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->photo) {
                $photo = public_path('upload/student/' . $user->photo);
                if (file_exists($photo)) {
                    unlink($photo);
                }
            }
            $user->photo = $filename;
        }

        if ($request->file('signature')) {
            $file = $request->file('signature');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->signature) {
                $signature = public_path('upload/student/' . $user->signature);
                if (file_exists($signature)) {
                    unlink($signature);
                }
            }
            $user->signature = $filename;
        }
        if ($request->file('others')) {
            $file = $request->file('others');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);
            if ($user->others) {
                $others = public_path('upload/student/' . $user->others);
                if (file_exists($others)) {
                    unlink($others);
                }
            }
            $user->others = $filename;
        }

        $user->save();

        $notification = [
            'message' => 'Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function feedback()
    {
        $data = StudentFeedback::latest()->get();
        return view('admin.feedback.index', compact('data'));
    } // end method

    public function destroy($id)
    {
        $data = StudentFeedback::findOrFail($id);
        $data->delete();

        $notification = [
            'message' => 'Review Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function active($id)
    {
        StudentFeedback::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Student Feedback Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function inactive($id)
    {
        StudentFeedback::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Student Feedback Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } //ene method

    public function offerletter($id, $university_id)
    {
        $offerletter = User::findOrFail($id);

        $university = \App\Models\PrimiumUniversity::where('status', 1)->findOrFail($university_id);

        $subject = 'Request For Offer Letter - ' . $offerletter->course_name;
        $files = [
            'photo' => public_path("upload/student/{$offerletter->photo}"),
            'nid' => public_path("upload/student/{$offerletter->nid}"),
            'signature' => public_path("upload/student/{$offerletter->signature}"),
            'o_level' => public_path("upload/student/{$offerletter->o_level}"),
            'a_level' => public_path("upload/student/{$offerletter->a_level}"),
            'graduate' => public_path("upload/student/{$offerletter->graduate}"),
            'post_graduate' => public_path("upload/student/{$offerletter->post_graduate}"),
            'others' => public_path("upload/student/{$offerletter->others}"),
        ];

        // Check if any file path is empty
        foreach ($files as $key => $file) {
            if (empty($offerletter->$key) || !file_exists($file)) {
                $notification = [
                    'message' => 'Profile is not complete This Student!',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notification);
            }
        }

        Mail::to($university->email)->send(new OfferLetter($offerletter, $subject, $files));

        $notification = [
            'message' => 'Offer Letter sent successfully to ' . $university->name . '!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function visaletter($id, $university_id)
    {
        // Find the user by ID
        $visaletter = User::findOrFail($id);

        // Fetch the specific university by ID
        $university = PrimiumUniversity::where('status', 1)->findOrFail($university_id);

        // Get the related ticket form for the user
        $ticketForm = TicketForm::where('user_id', $visaletter->id)->first();

        // Check if the ticket form with passport exists
        if (!$ticketForm || !$ticketForm->passport) {
            $notification = [
                'message' => 'Passport file not found for This Student!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Set dynamic subject
        $subject = 'Request For Visa Letter - ' . $visaletter->name;

        // Construct the file path
        $passportFilePath = public_path("upload/ticket/passport/{$ticketForm->passport}");
        // return $passportFilePath;

        // Check if the file exists
        if (!file_exists($passportFilePath)) {
            $notification = [
                'message' => 'Passport file not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        try {
            // Send email
            Mail::to($university->email)->send(new VisaLetter($visaletter, $subject, $passportFilePath));

            $notification = [
                'message' => 'Visa Letter sent successfully to ' . $university->name . '!',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to send Visa Letter: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }

    public function pickupletter($id, $university_id)
    {
        $pickupletter = User::findOrFail($id);
        $university = PrimiumUniversity::where('status', 1)->findOrFail($university_id);

        $student_ticket = StudentTicket::where('user_id', $pickupletter->id)->first();

        if (!$student_ticket || !$student_ticket->ticket) {
            $notification = [
                'message' => 'Ticket file not found for This Student!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $subject = 'Request For arrange pickup-SIAC - ' . $pickupletter->name;

        // Construct the file path
        $filePath = public_path("upload/ticket/student_ticket/{$student_ticket->ticket}");

        // Check if the file exists
        if (!file_exists($filePath)) {
            $notification = [
                'message' => 'Ticket file not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        try {
            // Send email with attachment
            Mail::to($university->email)->send(new PickupLetter($pickupletter, $subject, $filePath));

            $notification = [
                'message' => 'Pickup Letter sent successfully to ' . $university->name . '!',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to send Pickup Letter: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    } // end method

    public function admissionLetter($id, $university_id)
    {
        $admissionletter = User::findOrFail($id);
        $university = PrimiumUniversity::where('status', 1)->findOrFail($university_id);

        $invoice = UploadInvoice::where('user_id', $admissionletter->id)->first();

        if (!$invoice || !$invoice->pdf_path) {
            $notification = [
                'message' => 'University Invoice not found for this Student!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $subject = 'Request For admission letter - University INT Number - ' . $university->university_id . '- ' . $admissionletter->name;

        $filePath = public_path("upload/invoice/{$invoice->pdf_path}");

        if (!file_exists($filePath)) {
            $notification = [
                'message' => 'Invoice file not found!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        try {
            Mail::to($university->email)->send(new Invoice($admissionletter->toArray(), $subject, $filePath));

            $notification = [
                'message' => 'Invoice sent successfully to ' . $university->name . '!',
                'alert-type' => 'success',
            ];
        } catch (\Exception $e) {
            $notification = [
                'message' => 'Failed to send Invoice: ' . $e->getMessage(),
                'alert-type' => 'error',
            ];
        }

        return redirect()->back()->with($notification);
    }
}
