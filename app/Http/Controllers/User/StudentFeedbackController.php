<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\StudentFeedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentFeedbackController extends Controller
{
    public function feedback()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Check if the user has already submitted feedback
        $data = StudentFeedback::where('user_id', $user->id)->first();
        $userName = $user->name;
        $universityName = $user->university_name;

        return view('user.feedback.index', compact('data','userName', 'universityName'));
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
            $notification = array(
                'message' => 'You have already submitted feedback!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        // Save the feedback for the user
        $feedback = new StudentFeedback();
        $feedback->user_id = $user->id;
        $feedback->feedback = $request->input('feedback');
        $feedback->save();

        // Redirect or respond as needed
        $notification = array(
            'message' => 'Feedback submitted successfully!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
