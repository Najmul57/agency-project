<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\PrimiumCountry;

class CountrypageController extends Controller
{
    public function countrypage(){
        $countries=PrimiumCountry::where('status',1)->inRandomOrder()->get();
        return view('frontend.country.index',compact('countries'));
    } // end method

    public function countrydetails($slug){
        $countries=PrimiumCountry::where('status',1)->latest()->get();
        $countryDetails = PrimiumCountry::where('slug', $slug)->with('universities')->first();
        return view('frontend.country.country_details',compact('countries','countrydetails'));
    }
}
