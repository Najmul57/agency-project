<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProgramType;
use Illuminate\Http\Request;
use App\Models\PrimiumUniversity;
use App\Http\Controllers\Controller;
use App\Models\PrimiumCountry;
use App\Models\PrimiumCourse;
use Image;

class ProgramTypeController extends Controller
{

    public function programType()
    {
        $data = ProgramType::latest()->get();
        $university = PrimiumUniversity::all();
        return view('admin.primium.program-type.list', compact('data', 'university'));
    } // end method

    public function create()
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        return view('admin.primium.program-type.create', compact('universities', 'countries'));
    } // end method

    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required',
            'name' => 'required',
            'university_id' => 'required',
        ]);

        $existingProgramType = ProgramType::where('name', $request->name)
            ->where('university_id', $request->university_id)
            ->first();

        if ($existingProgramType) {
            $notification = [
                'message' => 'This program already exiest This University!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $data = new ProgramType();
        $data->name = $request->name;
        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename =  $request->name . '_thumbnail_' . $file->getClientOriginalName();
            $file->move(public_path('upload/programtype'), $filename);
            Image::make(public_path('upload/programtype') . '/' . $filename)->resize(300, 200)->save('upload/programtype/' . $filename);
            $data->thumbnail = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Program Type Insert Success!',
            'alert-type' => 'success'
        ];

        return redirect()->route('program.type')->with($notification);
    }

    public function edit($id)
    {
        $data = ProgramType::findOrFail($id);
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $selectedCountryId = $data->country_id;
        $selectedUniversityId = $data->university_id;

        return view('admin.primium.program-type.edit', compact('data', 'universities', 'countries', 'selectedCountryId', 'selectedUniversityId'));
    }


   public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required',
        'country_id' => 'required',
        'university_id' => 'required',
    ]);

    $existingProgramType = ProgramType::where('name', $request->name)
        ->where('university_id', $request->university_id)
        ->first();

    if ($existingProgramType && $existingProgramType->id != $id) {
        return back()->withErrors(['name' => 'This program already exists in this university!']);
    }

    $data = ProgramType::findOrFail($id);
    $data->name = $request->name;
    $data->country_id = $request->country_id;
    $data->university_id = $request->university_id;

    if ($request->file('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename =  $request->name . 'thumbnail_' . $file->getClientOriginalName();
        $filePath = public_path('upload/programtype') . '/' . $filename;

        try {
            $file->move(public_path('upload/programtype'), $filename);
            Image::make($filePath)->resize(300, 200)->save($filePath);
            $data->thumbnail = $filename;
        } catch (\Exception $e) {
            return back()->withErrors(['thumbnail' => 'Error uploading or resizing image!']);
        }
    }

    $data->save();

    $notification = array(
        'message' => 'Program Type Update Success!',
        'alert-type' => 'success'
    );
    return redirect()->route('program.type')->with($notification);
}


    public function delete($id)
    {
        $data = ProgramType::findOrFail($id);

        $universities = PrimiumCourse::where('program_type_id', $id)->count();
        if ($universities > 0) {
            $notification = [
                'message' => 'Cannot Remove program type! Please Remove associated department first.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $data->delete();

        $notification = array(
            'message' => 'Program Type Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('program.type')->with($notification);
    } // end method

    public function fetchProgram(Request $request)
    {
        $university_id = $request->input('university_id');

        // Assuming Program is your model representing programs
        $programs = ProgramType::where('university_id', $university_id)->get();

        return response()->json(['programs' => $programs]);
    }


    public function getUniversities(Request $request)
    {
        $countryId = $request->get('country_id');
        $universities = PrimiumUniversity::where('country_id', $countryId)->pluck('name', 'id');

        return response()->json($universities);
    }
}
