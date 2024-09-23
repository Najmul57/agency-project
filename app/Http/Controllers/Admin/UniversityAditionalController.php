<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoursesList;
use App\Models\DepartmentList;
use App\Models\ProgramTypeList;
use Illuminate\Support\Str;
use Image;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UniversityAditionalController extends Controller
{
    public function index()
    {
        $data = ProgramTypeList::latest()->get();
        return view('admin.universityAditional.programtype.index', compact('data'));
    } // end index()

    public function create()
    {
        return view('admin.universityAditional.programtype.create');
    } // end create()

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:program_type_lists,name',
        ]);

        ProgramTypeList::create([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Program Type Insert Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('programTypeInser.index')->with($notification);
    } // end store()

    public function edit($id)
    {
        $data = ProgramTypeList::find($id);
        return view('admin.universityAditional.programtype.edit', compact('data'));
    } // end edit()
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:program_type_lists,name',
        ]);

        $data = ProgramTypeList::findOrFail($id);
        $data->name = $request->name;

        $data->save();

        $notification = [
            'message' => 'Program Type Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('programTypeInser.index')->with($notification);
    } // end update()
    public function destroy($id)
    {
        $data = ProgramTypeList::find($id);

        $data->delete();

        $notification = [
            'message' => 'Program Type Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('programTypeInser.index')->with($notification);
    } // end destroy()

    //department list
    public function list()
    {
        $data = DepartmentList::latest()->get();
        return view('admin.universityAditional.department.index', compact('data'));
    } // end index()

    public function add()
    {
        return view('admin.universityAditional.department.create');
    } // end create()

    public function departmentstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:department_lists,name',
        ]);

        DepartmentList::create([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        $notification = [
            'message' => 'Department List Insert Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('departmentlist.index')->with($notification);
    } // end store()

    public function departmentedit($id)
    {
        $data = DepartmentList::find($id);
        return view('admin.universityAditional.department.edit', compact('data'));
    } // end edit()
    public function departmentupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:department_lists,name',
        ]);

        $data = DepartmentList::findOrFail($id);
        $data->name = $request->name;

        $data->save();

        $notification = [
            'message' => 'Program Type Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('departmentlist.index')->with($notification);
    } // end update()
    public function delete($id)
    {
        $data = DepartmentList::find($id);

        $data->delete();

        $notification = [
            'message' => 'Department Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('departmentlist.index')->with($notification);
    } // end destroy()

    //course list
    public function courselist()
    {
        $data = CoursesList::orderby('name', 'asc')->orderby('created_at', 'desc')->get();
        // return $data;
        return view('admin.universityAditional.course.index', compact('data'));
    } // end index()

    public function courseadd()
    {
        return view('admin.universityAditional.course.create');
    } // end create()

    public function coursestore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:courses_lists,name',
        ]);

        $data = new CoursesList();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = $request->name . $file->getClientOriginalName();
            $file->move(public_path('upload/courselist'), $filename);
            Image::make(public_path('upload/courselist') . '/' . $filename)
                ->resize(840, 560)
                ->save('upload/courselist/' . $filename);
            $data->image = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Course Insert Success!',
            'alert-type' => 'success',
        ];

        return redirect()->route('courselist.index')->with($notification);
    } // end store()

    public function courseedit($id)
    {
        $data = CoursesList::find($id);
        return view('admin.universityAditional.course.edit', compact('data'));
    } // end edit()
    public function courseupdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:courses_lists,name,' . $id,
        ]);

        $data = CoursesList::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name, '-');

        if ($request->file('image')) {
            if ($data->image) {
                $image_path = public_path('upload/courselist/' . $data->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $file = $request->file('image');
            $filename = $request->name . $file->getClientOriginalName();
            $file->move(public_path('upload/courselist'), $filename);
            Image::make(public_path('upload/courselist') . '/' . $filename)
                ->resize(840, 560)
                ->save('upload/courselist/' . $filename);
            $data->image = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Course Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('courselist.index')->with($notification);
    } // end update()
    public function coursedelete($id)
    {
        $data = CoursesList::find($id);

        $data->delete();

        $notification = [
            'message' => 'Course Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('courselist.index')->with($notification);
    } // end destroy()
}
