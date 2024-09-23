<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessCount;
use Illuminate\Http\Request;
use Image;

class SuccessCountController extends Controller
{
    public function index()
    {
        $data = SuccessCount::latest()->get();
        return view('admin.success_count.index', compact('data'));
    } //end method

    public function create()
    {
        return view('admin.success_count.create');
    } //end method

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'count' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = new SuccessCount();
        $data->title = $request->title;
        $data->count = $request->count;
        $data->status = '0';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/success'), $filename);
            Image::make(public_path('upload/success') . '/' . $filename)->resize(100, 100)->save('upload/success/' . $filename);
            $data->image = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Count Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('success.index')->with($notification);
    } //end method

    public function edit($id)
    {
        $data = SuccessCount::findOrFail($id);
        return view('admin.success_count.edit', compact('data'));
    } //end method

    public function update(Request $request, $id)
    {
        // Validate the request data
        //  $request->validate([
        //     'title' => 'required|string',
        //     'count' => 'required|string',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        // ]);

        $data = SuccessCount::findOrFail($id);
        $data->title = $request->title;
        $data->count = $request->count;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/success'), $filename);
            if ($data->image) {
                $oldImage = public_path('upload/success/' . $data->image);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            Image::make(public_path('upload/success') . '/' . $filename)->resize(100, 100)->save('upload/success/' . $filename);
            $data->image = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Count Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('success.index')->with($notification);
    } //end method

    public function destroy($id)
    {
        $data = SuccessCount::findOrFail($id);
        if ($data->image) {
            // Delete the banner file if it exists
            unlink(public_path('upload/success/' . $data->image));
        }

        // Delete the Slider record
        $data->delete();

        $notification = array(
            'message' => 'Count Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('success.index')->with($notification);
    } //end method

    public function active($id)
    {
        SuccessCount::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Success Count Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        SuccessCount::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Success Count Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
