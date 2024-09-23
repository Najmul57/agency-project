<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Payfees;
use App\Models\ProgramType;
use App\Models\WelcomeVideo;
use Illuminate\Http\Request;
use App\Models\PrimiumCourse;
use App\Models\PrimiumCountry;
use App\Models\StudentCountry;
use App\Models\PrimiumUniversity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\PrimiumUniversityCourse;
use App\Mail\PremiumSubscriptionRequest;
use Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } // end method

    public function student_information()
    {
        if (auth()->check()) {
            $user = auth()->user();
            return view('user.user.information', compact('user'));
        }
    } // end method

    public function profile()
    {
        $authUser = Auth::user();
        // return $authUser;
        return view('user.profile.profile', compact('authUser'));
    }
    // end method

    public function updateDetails()
    {
        $user = auth()->user();
        $type = ProgramType::all();
        $country = PrimiumCountry::all();
        $university = PrimiumUniversity::all();
        $department = PrimiumCourse::all();
        $course = PrimiumUniversityCourse::all();
        return view('user.details.update', compact('user', 'type', 'country', 'university', 'department', 'course'));
    }

   public function updateDetailsUpdate(Request $request)
{
    $user = auth()->user();

    $updateData = $request->only([
        'city',
        'phone',
        'f_name',
        'm_name',
        'dob',
        'address',
        'cgpa',
        'regis__country',
        'regis__university',
        'regis__program',
        'regis__course',
        'regis__uni__course',
    ]);

    $fileFields = ['o_level', 'a_level', 'graduate', 'post_graduate', 'nid', 'photo', 'signature', 'others'];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            $file = $request->file($field);
            $filename = date('YmdHi') . '_' . $file->getClientOriginalName();
            $file->move(public_path('upload/student'), $filename);

            if ($user->{$field}) {
                $oldFilePath = public_path('upload/student/' . $user->{$field});
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }

            if (in_array($field, ['o_level', 'a_level', 'graduate','post_graduate','nid','photo','signature','others'])) {
                $image = Image::make(public_path('upload/student') . '/' . $filename);
                $image->save(public_path('upload/student') . '/' . $filename);
            }

            $updateData[$field] = $filename;
        }
    }

    $user->update($updateData);

    $notification = [
        'message' => 'User details updated successfully',
        'alert-type' => 'success',
    ];

    return redirect()->route('student.information')->with($notification);
}

    /**
     * Handle file uploads.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return void
     */

    public function getUserUniversities(Request $request, $countryId)
    {
        $universities = PrimiumUniversity::where('country_id', $countryId)->orderBy('name', 'ASC')->get();
        return response()->json($universities);
    }
    public function getUserCourses(Request $request, $universityId)
    {
        $courses = PrimiumCourse::where('university_id', $universityId)->orderBy('name', 'ASC')->get();
        return response()->json($courses);
    }

    public function getUserUniCourses(Request $request, $courseId)
    {
        $unicourses = PrimiumUniversityCourse::where('course_id', $courseId)->orderBy('name', 'ASC')->get();
        return response()->json($unicourses);
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
        return view('user.profile.change_password');
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

    public function index()
    {
        $user = Auth::user();
        $transitions = Payfees::where('user_id', $user->id)
            ->latest()
            ->get();
        $totalAmount = Payfees::where('user_id', $user->id)->sum('display_amount');
        $video = WelcomeVideo::first();
        return view('user.index', compact('transitions', 'totalAmount', 'user', 'video'));
    } // end method

    public function primiumsubscribe(Request $request)
    {
        // Validate the request data
        $request->validate([
            'amount' => 'required|numeric',
            'method' => 'required|string',
            'txt_number' => 'required|string',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user is not already a premium member
        if ($user->is_primium === null || $user->is_primium === 'is_free') {
            // Update the user's information
            $user->update([
                'amount' => $request->amount,
                'method' => $request->method,
                'txt_number' => $request->txt_number,
            ]);

            // Get all admin users
            $admins = User::where('role_id', 1)->pluck('email');

            // Send the email notification to all admins
            foreach ($admins as $admin) {
                Mail::to($admin)->send(new PremiumSubscriptionRequest($user, $request->amount, $request->method, $request->txt_number));
            }

            $notification = [
                'message' => 'Subscribe Request Success!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'You are already a premium member!',
                'alert-type' => 'info',
            ];
        }

        // Redirect back with a notification
        return redirect()->back()->with($notification);
    }

    public function getUniversities($countryId)
    {
        $universities = PrimiumUniversity::where('country_id', $countryId)->get();
        return response()->json($universities);
    }

    public function getProgramTypes($universityId)
    {
        $programTypes = ProgramType::where('university_id', $universityId)->get();
        return response()->json($programTypes);
    }

    public function getCourses($programTypeId)
    {
        $courses = PrimiumCourse::where('program_type_id', $programTypeId)->get();
        return response()->json($courses);
    }

    public function getUniCourses($courseId)
    {
        $uniCourses = PrimiumUniversityCourse::where('course_id', $courseId)->get();
        return response()->json($uniCourses);
    }
}
