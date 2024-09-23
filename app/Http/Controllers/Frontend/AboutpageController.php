<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutpageController extends Controller
{
    public function about(){
        $data=DB::table('abouts')->first();
        return view('frontend.about.index',compact('data'));
    }
}
