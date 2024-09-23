<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;

class ServicepageController extends Controller
{
    public function servicepage(){
        $services=Services::where('status',1)->inRandomOrder()->get();
        return view('frontend.service.index',compact('services'));
    } // end method

    public function servicedetails($slug){
        $services=Services::where('status',1)->latest()->get();
        $serviceDetails=Services::where('slug',$slug)->first();
        return view('frontend.service.service_details',compact('serviceDetails','services'));
    }
}
