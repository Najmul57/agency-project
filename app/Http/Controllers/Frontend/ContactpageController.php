<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactpageController extends Controller
{
    public function contactpage(){
       return view('frontend.contact.index') ;
    } // end method

    public function contactstore(Request $request){
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Contact::insert([
            'name'=>$request->name,
            'subject'=>$request->subject,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'message'=>$request->message,
            'created_at'=>Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Thank you for Contact US!',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);
    }
}
