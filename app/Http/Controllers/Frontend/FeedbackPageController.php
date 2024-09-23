<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\StudentFeedback;
use Illuminate\Http\Request;

class FeedbackPageController extends Controller
{
    public function feedbackpage(){
        $feedback = StudentFeedback::where('status', 1)->latest()->get();
        return view('frontend.feedback.index',compact('feedback'));
    }
}
