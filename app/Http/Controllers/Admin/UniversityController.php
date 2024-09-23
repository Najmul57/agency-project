<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Course;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class UniversityController extends Controller
{
    public function index()
    {
        $data = University::with('country')->get();
        // return $data;
        return view('admin.university.index', compact('data'));
    } // end method

    public function create()
    {
        $country=Country::all();
        $courseDepartment=Course::all();
        return view('admin.university.create',compact('country','courseDepartment'));
    } // end method

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required',
            'name' => 'required|string|unique:universities',
            'email' => 'required|string|unique:universities',
            'website' => 'required|string|unique:universities',
            // 'course_id' => 'required',
            'country_id' => 'required',

        ]);

        $data = new University();
        $data['country_id'] = $request->country_id;
        // $data['course_id'] = $request->course_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['website'] = $request->website;
        $data['slug'] = Str::slug($request->name,'-');
        $data['location'] = $request->location;
        $data['about'] = $request->about;

        $data->status = '0';
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)->resize(300, 200)->save('upload/university/' . $filename);
            $data->image = $filename;
        }
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)->resize(80, 80)->save('upload/university/' . $filename);
            $data->logo = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'University Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('university.index')->with($notification);
    } // end method

    public function edit($id)
    {
        $data = University::findOrFail($id);
        $courseDepartment=Course::all();
        $country=Country::all();
        return view('admin.university.edit',compact('data','country','courseDepartment'));
    } // end method

    public function update(Request $request, $id)
    {$request->validate([
        'country_id' => 'required',
        'name' => 'required',
        'email' => 'required',
        'website' => 'required',
        // 'course_id' => 'required',
        'country_id' => 'required',
    ]);

        $data = University::findOrFail($id);
        $data['country_id'] = $request->country_id;
        // $data['course_id'] = $request->course_id;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['website'] = $request->website;
        $data['slug'] = Str::slug($request->name,'-');
        $data['about'] = $request->about;
        $data['location'] = $request->location;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/university'), $filename);
            if ($data->image) {
                $oldImage = public_path('upload/university/' . $data->image);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            Image::make(public_path('upload/university') . '/' . $filename)->resize(300, 200)->save('upload/university/' . $filename);
            $data->image = $filename;
        }

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/university'), $filename);
            if ($data->logo) {
                $oldlogo = public_path('upload/university/' . $data->logo);
                if (file_exists($oldlogo)) {
                    unlink($oldlogo);
                }
            }
            Image::make(public_path('upload/university') . '/' . $filename)->resize(80, 80)->save('upload/university/logo/' . $filename);
            $data->logo = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'University Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('university.index')->with($notification);
    } // end method

    public function destroy($id)
    {
        $data = University::findOrFail($id);
        if ($data->image) {
            // Delete the banner file if it exists
            unlink(public_path('upload/university/' . $data->image));
        }
        // Delete the Slider record
        $data->delete();

        $notification = array(
            'message' => 'University Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('university.index')->with($notification);
    } // end method

    public function active($id)
    {
        University::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'University Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        University::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'University Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
