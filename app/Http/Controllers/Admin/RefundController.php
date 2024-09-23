<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function refund(){
        $data=Refund::first();
        return view('admin.refund.index',compact('data'));
    } // end method

    public function refundupdate(Request $request, $id){
        $data = Refund::findOrFail($id);

        $data->description = $request->input('description');

        $data->save();

        return redirect()->back()->with('success', 'Refund Policy updated successfully');
    } // end method

    public function userrefund(){
        $data=Refund::first();
        return view('user.refund.index',compact('data'));
    }
}
