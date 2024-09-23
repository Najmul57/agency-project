<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\User;
use App\Models\Payfees;
use App\Models\StudenHelp;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PaymentReceipt;
use App\Mail\RandomPasswordEmail;
use App\Models\ReferenceGuideLine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ReferranceController extends Controller
{
    public function referrancePage()
    {
        $help = StudenHelp::first();
        $user = Auth::user(); // Get the authenticated user
        $referanceGuideline = ReferenceGuideLine::first();

        return view('user.referrance.page', compact('help', 'referanceGuideline'));
    } // end method

    public function adminpaymentreceiptUpload()
    {
        return view('admin.referance.payment_receipt_upload');
    } // end method

    public function adminpaymentreceiptStore(Request $request)
    {
        // Validate the request
        $request->validate([
            'referace_user_id' => 'required',
            'receipt' => 'required|file|max:2048', // Adjust max file size if needed
        ]);

        // Store the uploaded file
        $uploadedFile = $request->file('receipt');
        $fileName = 'receipt_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/receipt'), $fileName);

        // Insert the record into the database
        PaymentReceipt::create([
            'user_id' => $request->referace_user_id,
            'receipt' => $fileName,
            'created_at' => now(),
        ]);

        // Redirect back with success message
        return redirect()
            ->back()
            ->with([
                'message' => 'Student Receipt uploaded successfully!',
                'alert-type' => 'success',
            ]);
    } // end method

    public function referanceform(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = Auth::user();
        $user->balance += 10; // Add 10 to the current balance
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

    public function referrancesingle($id)
    {
        $singleStudent = User::where('id', $id)
            ->where('role_id', 2)
            ->where('referance', auth()->user()->email)
            ->first();
        return view('user.referrance.singleStudent', compact('singleStudent'));
    } // end method

    public function reportstore(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id,role_id,2',
            'report' => 'required|file',
        ]);

        $uploadedFile = $request->file('report');
        $fileName = 'report_' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move(public_path('upload/report'), $fileName);

        PaymentReceipt::create([
            'user_id' => $request->user_id,
            'created_at' => now(),
        ]);

        return redirect()
            ->back()
            ->with([
                'message' => 'Student Report uploaded successfully!',
                'alert-type' => 'success',
            ]);
    } // end method

    public function receiptUploadReferance(Request $request)
    {
        $request->validate([
            'referace_user_id' => 'required|exists:users,id,role_id,2',
            'receipt' => 'required|file',
        ]);

        if ($request->file('receipt')) {
            $file = $request->file('receipt');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/payment/paymentreceipt'), $filename);

            // Check if receipt already exists for the user
            if (PaymentReceipt::where('user_id', $request->referace_user_id)->exists()) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Payment receipt already uploaded for this reference student!',
                        'alert-type' => 'error',
                    ]);
            }

            PaymentReceipt::create([
                'user_id' => $request->referace_user_id,
                'receipt' => $filename,
            ]);

            return redirect()
                ->back()
                ->with([
                    'message' => 'Reference Student Payment Receipt uploaded successfully!',
                    'alert-type' => 'success',
                ]);
        }
    }

    public function receiptDownload($id)
    {
        $payment = Payfees::findOrFail($id);

        $pdf = PDF::loadView('user.payments.receipt', compact('payment'));

        return $pdf->download('payment_receipt_' . $payment->receipt_id . '.pdf');
    }
}
