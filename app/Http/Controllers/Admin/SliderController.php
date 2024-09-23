<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $data = Slider::latest()->get();
        return view('admin.slider.index', compact('data'));
    } // end method

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'banner' => 'required',
        ]);

        if ($request->file('banner')) {
            $file = $request->file('banner');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/banner'), $filename);

            // Create an image instance from the uploaded file and resize it
            Image::make(public_path('upload/banner') . '/' . $filename)->resize(1280, 500)->save('upload/banner/' . $filename);

            // Assuming you have an Eloquent model called Slider
            $data = new Slider();
            $data->banner = $filename;
            $data->status = '0';
            $data->save();
        }

        $notification = array(
            'message' => 'Banner Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('slider.index')->with($notification);
    } // end method

    public function edit($id)
    {
        $data = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('data'));
    } // end method

    public function update(Request $request, $id)
    {
        if ($request->file('banner')) {
            $file = $request->file('banner');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/banner'), $filename);

            // Create an image instance from the uploaded file and resize it
            Image::make(public_path('upload/banner') . '/' . $filename)->resize(1280, 500)->save('upload/banner/' . $filename);

            // Assuming you have an Eloquent model called Slider
            $data = Slider::findOrFail($id);

            // Check if the old banner file exists and delete it
            if ($data->banner) {
                $oldBannerPath = public_path('upload/banner/' . $data->banner);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }
            // Update the banner field in the model with the new filename
            $data->banner = $filename;
            $data->save();
        }

        $notification = array(
            'message' => 'Banner Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('slider.index')->with($notification);
    }

    public function destroy($id)
    {
        $data = Slider::findOrFail($id);

        if ($data->banner) {
            // Delete the banner file if it exists
            unlink(public_path('upload/banner/' . $data->banner));
        }

        // Delete the Slider record
        $data->delete();

        $notification = array(
            'message' => 'Banner Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function active($id)
    {
        Slider::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Banner Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        Slider::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Banner Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
