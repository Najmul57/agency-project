<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrimiumUniversity;

class UniversitypageController extends Controller
{
    public function universitypage()
    {
        $universities = PrimiumUniversity::where('status', 1)->orderby('name','asc')->get();
        return view('frontend.university.index', compact('universities'));
    } // end method

    public function universitydetails($slug)
    {
        $unidetails = PrimiumUniversity::where('slug', $slug)->first();

        $universities = PrimiumUniversity::where('status', 1)->orderby('name','asc')->get();
        return view('frontend.university.uni__details', compact('unidetails'));
    } // end method


}
