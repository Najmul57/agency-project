<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Image;

class TeamController extends Controller
{
    public function index()
    {
        $data = Team::latest()->get();
        return view('admin.team.index', compact('data'));
    } // end method

    public function create()
    {
        return view('admin.team.create');
    } // end method


    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'position' => 'required|string',
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,webp,gif', // Limiting image size to 2MB
        ]);

        try {
            // Create a new Team instance and assign values from the request
            $data = new Team();
            $data->name = $request->name;
            $data->position = $request->position;
            $data->facebook = $request->facebook;
            $data->youtube = $request->youtube;
            $data->instagram = $request->instagram;
            $data->whatsapp = $request->whatsapp;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = date('YmdHi') . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload/team'), $filename);

                // Resize the uploaded image
                $img = Image::make(public_path('upload/team') . '/' . $filename);
                $img->resize(324, 324, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path('upload/team') . '/' . $filename);

                $data->image = $filename;
            }

            // Save the data to the database
            $data->save();

            // Redirect with success message
            $notification = array(
                'message' => 'Team Member Insert Success!',
                'alert-type' => 'success'
            );
            return redirect()->route('admiin.team')->with($notification);
        } catch (\Exception $e) {
            // Handle any exceptions
            $notification = array(
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return back()->withInput()->with($notification);
        }
    } // end method

    public function edit($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.team.edit', compact('team'));
    } // end method

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'position' => 'required|string',
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,png,jpg,webp,gif', // Limiting image size to 2MB
        ]);

        try {
            // Retrieve the team member by ID
            $data = Team::findOrFail($id);

            // Assign values from the request to the team member instance
            $data->name = $request->name;
            $data->position = $request->position;
            $data->facebook = $request->facebook;
            $data->youtube = $request->youtube;
            $data->instagram = $request->instagram;
            $data->whatsapp = $request->whatsapp;

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($data->image) {
                    $oldImagePath = public_path('upload/team') . '/' . $data->image;
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Upload and resize the new image
                $image = $request->file('image');
                $filename = date('YmdHi') . '_' . $image->getClientOriginalName();
                $image->move(public_path('upload/team'), $filename);

                $img = Image::make(public_path('upload/team') . '/' . $filename);
                $img->resize(324, 324, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path('upload/team') . '/' . $filename);

                $data->image = $filename;
            }

            // Save the data to the database
            $data->save();

            // Redirect with success message
            $notification = array(
                'message' => 'Team Member Update Success!',
                'alert-type' => 'success'
            );
            return redirect()->route('admiin.team')->with($notification);
        } catch (\Exception $e) {
            // Handle any exceptions
            $notification = array(
                'message' => 'Error: ' . $e->getMessage(),
                'alert-type' => 'error'
            );
            return back()->withInput()->with($notification);
        }
    }

    public function destroy($id)
    {
        $data = Team::findOrFail($id);
        if ($data->image) {
            // Delete the banner file if it exists
            unlink(public_path('upload/team/' . $data->image));
        }

        // Delete the Slider record
        $data->delete();

        $notification = array(
            'message' => 'Team Member Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
