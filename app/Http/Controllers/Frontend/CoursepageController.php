<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PrimiumCourse;
use App\Models\PrimiumUniversityCourse;
use Illuminate\Support\Facades\DB;
use App\Models\University;
use Illuminate\Http\Request;

class CoursepageController extends Controller
{
    public function course()
    {
        // $courses = PrimiumUniversityCourse::where('status', 1)->get();
        $courses = PrimiumUniversityCourse::where('status', 1)->get();
        $groupedCourses = $courses->groupBy('name');

        return view('frontend.course.index', compact('courses','groupedCourses'));
    } // end method

    public function coursedetails($slug)
    {
        $coursedetails = PrimiumCourse::where('slug', $slug)->first();
        return view('frontend.course.coursedetails', compact('coursedetails'));
    }
    public function courseuniversity($slug)
    {
        $singleCourse = PrimiumCourse::where('slug', $slug)->first();

        // return $singleCourse;
        return view('frontend.course_university.index', compact('singleCourse'));
    }
}
