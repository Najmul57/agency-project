<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GallerypageController extends Controller
{
    public function gallery(){
        $galleries=Gallery::latest()->get();
        return view('frontend.gallery.index',compact('galleries'));
    }
}
