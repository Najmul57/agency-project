<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $data = Coupon::latest()->get();
        return view('admin.coupon.index', compact('data'));
    } // end method

    public function create()
    {
        return view('admin.coupon.create');
    } // end method

    public function store(Request $request)
    {
        Coupon::insert([
            'code' => $request->code,
            'date' => $request->date,
            'type' => $request->type,
            'amount' => $request->amount,
            'status' => '0',
        ]);

        $notification = array(
            'message' => 'Coupon Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupon')->with($notification);
    } // end method

    public function edit($id)
    {
        $data = Coupon::find($id);
        return view('admin.coupon.edit', compact('data'));
    } // end method

    public function update(Request $request, $id)
    {
        Coupon::find($id)->update([
            'code' => $request->code,
            'date' => $request->date,
            'type' => $request->type,
            'amount' => $request->amount,
        ]);

        $notification = array(
            'message' => 'Coupon Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.coupon')->with($notification);
    } // end method


    public function destroy($id)
    {
        $data = Coupon::find($id);
        $data->delete();

        $notification = array(
            'message' => 'Coupon Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function active($id)
    {
        Coupon::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Coupon Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        Coupon::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Coupon Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
