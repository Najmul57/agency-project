<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogpageController extends Controller
{
    public function blog(){
        $blogs=Blog::where('status',1)->latest()->get();
        return view('frontend.blog.index',compact('blogs'));
    } // end method

    public function blogdetails($slug){
        $blogdetails = Blog::where('slug', $slug)->first();
        return view('frontend.blog.blogdetails', compact('blogdetails'));
    }
}
