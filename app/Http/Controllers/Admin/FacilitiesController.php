<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facilities;
use Illuminate\Http\Request;
use Image;

class FacilitiesController extends Controller
{
    public function index()
    {
        $data = Facilities::latest()->get();
        return view('admin.facilities.index', compact('data'));
    } //end method

    public function create()
    {
        return view('admin.facilities.create');
    } //end method

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:facilities',
            'image' => 'required',
        ]);

        $data = new Facilities();
        $data->name = $request->name;
        $data->status = '0';

        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $filename = date('YmdHi') . $file->getClientOriginalName();
        //     $file->move(public_path('upload/facilities'), $filename);
        //     Image::make(public_path('upload/facilities') . '/' . $filename)
        //         ->resize(50, 50)
        //         ->save('upload/facilities/' . $filename);
        //     $data->image = $filename;
        // }

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME); // Remove original extension
            $webpFilename = $filenameWithoutExtension . '.webp'; // New WebP filename
        
            // Move the original file temporarily to process it
            $file->move(public_path('upload/facilities'), $filename);
        
            // Convert to WebP, resize to 50x50, and save with 100% quality
            Image::make(public_path('upload/facilities') . '/' . $filename)
                ->resize(50, 50)
                ->encode('webp', 100) // Encode as WebP with 100% quality
                ->save(public_path('upload/facilities') . '/' . $webpFilename);
        
            // Delete the original uploaded file if not needed
            unlink(public_path('upload/facilities') . '/' . $filename);
        
            // Save the WebP filename to the database
            $data->image = $webpFilename;
        }

        $data->save();
        $notification = [
            'message' => 'Facilities Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('facilities.index')->with($notification);
    } //end method

    public function edit($id)
    {
        $data = Facilities::findOrFail($id);
        return view('admin.facilities.edit', compact('data'));
    } //end method

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = Facilities::findOrFail($id);
        $data->name = $request->name;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/facilities'), $filename);

            // Check if the file exists before attempting to delete it
            $oldImagePath = public_path('upload/facilities/' . $data->image);
            if ($data->image && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            Image::make(public_path('upload/facilities') . '/' . $filename)
                ->resize(50, 50)
                ->save(public_path('upload/course/' . $filename));

            $data->image = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Facilities Update Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('facilities.index')->with($notification);
    }

    public function destroy($id)
    {
        $data = Facilities::findOrFail($id);

        if ($data->image) {
            unlink(public_path('upload/facilities/' . $data->image));
        }

        $data->delete();

        $notification = [
            'message' => 'Facilities Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } //end method

    public function active($id)
    {
        Facilities::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Facilities Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        Facilities::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Facilities Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method
}
