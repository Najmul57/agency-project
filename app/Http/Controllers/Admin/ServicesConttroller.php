<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class ServicesConttroller extends Controller
{
    public function index()
    {
        $data = Services::latest()->get();
        return view('admin.services.index', compact('data'));
    } //end method


    public function create()
    {
        return view('admin.services.create');
    } //end method
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|unique:services',
            'image' => 'required|mimes:jpeg,png,jpg,gif',
        ]);

        $data = new Services();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title, '-');
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;
        $data->status = '0';

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/service'), $filename);
            Image::make(public_path('upload/service') . '/' . $filename)->resize(68, 68)->save('upload/service/' . $filename);
            $data->image = $filename;
        }
        if ($request->file('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/service'), $filename);
            $data->breadcrumb = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Service Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('service.index')->with($notification);
    } //end method
    public function edit($id)
    {
        $data = Services::findOrFail($id);
        return view('admin.services.edit', compact('data'));
    } //end method
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif', // Adjust allowed image types and size as needed
        ]);

        $data = Services::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title, '-');
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/service'), $filename);
            if ($data->image) {
                $oldImagePath = public_path('upload/service/' . $data->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            Image::make(public_path('upload/service') . '/' . $filename)->resize(68, 68)->save('upload/service/' . $filename);
            $data->image = $filename;
        }
        if ($request->hasFile('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('upload/service'), $filename);
            if ($data->breadcrumb) {
                $oldImagePath = public_path('upload/service/' . $data->breadcrumb);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $data->breadcrumb = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Service Update Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('service.index')->with($notification);
    }

    public function destroy($id)
    {

        $data = Services::findOrFail($id);
        if ($data->image) {
            // Delete the banner file if it exists
            unlink(public_path('upload/service/' . $data->image));
        }

        // Delete the Slider record
        $data->delete();

        $notification = array(
            'message' => 'Service Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('service.index')->with($notification);
    } //end method

    public function active($id)
    {
        Services::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Service Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        Services::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Service Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

}
