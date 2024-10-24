<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\PrimiumCountry;
use App\Models\PrimiumCourse;
use App\Models\PrimiumStudent;
use App\Models\CoursesList;
use App\Models\PrimiumUniversity;
use Illuminate\Support\Facades\Mail;
use App\Models\PrimiumUniversityContent;
use App\Models\PrimiumUniversityCourse;
use App\Models\ProgramType;
use Image;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;

class PrimiumStudentController extends Controller
{
    //country
    public function list()
    {
        $data = PrimiumCountry::latest()->get();
        return view('admin.primium.country.list', compact('data'));
    } // end method

    public function create()
    {
        return view('admin.primium.country.create');
    } // end method_exists

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:primium_countries|max:255',
            'thumbnail' => 'required|mimes:png,jpg,webp,jpeg',
            'breadcrumb' => 'required|mimes:png,jpg,webp,jpeg',
        ]);

        $data = new PrimiumCountry();
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->description = $request->description;
        $data->status = '0';

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $request->name . '_thumbnail.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/country'), $filename);
            Image::make(public_path('upload/country') . '/' . $filename)
                ->resize(1280, 720)
                ->save('upload/country/' . $filename);
            $data->thumbnail = $filename;
        }

        if ($request->hasFile('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = $request->name . '_breadcrumb.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/country/'), $filename);
            $data->breadcrumb = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Country Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.country.list')->with($notification);
    } // end method

    public function edit($id)
    {
        $data = PrimiumCountry::findOrFail($id);
        return view('admin.primium.country.edit', compact('data'));
    } // end method

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = PrimiumCountry::findOrFail($id);
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->description = $request->description;

        if ($request->hasFile('thumbnail')) {
            if ($data->thumbnail && file_exists(public_path('upload/country/' . $data->thumbnail))) {
                unlink(public_path('upload/country/' . $data->thumbnail));
            }

            $file = $request->file('thumbnail');
            $filename = $request->name . '_thumbnail.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/country'), $filename);
            Image::make(public_path('upload/country') . '/' . $filename)
                ->resize(1280, 720)
                ->save('upload/country/' . $filename);
            $data->thumbnail = $filename;
        }

        if ($request->hasFile('breadcrumb')) {
            if ($data->breadcrumb && file_exists(public_path('upload/country/' . $data->breadcrumb))) {
                unlink(public_path('upload/country/' . $data->breadcrumb));
            }

            $file = $request->file('breadcrumb');
            $filename = $request->name . '_breadcrumb.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/country/'), $filename);
            $data->breadcrumb = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'Country Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.country.list')->with($notification);
    }

    public function destroy($id)
    {
        $data = PrimiumCountry::findOrFail($id);

        $universities = PrimiumUniversity::where('country_id', $id)->count();
        if ($universities > 0) {
            $notification = [
                'message' => 'Cannot Remove country! Please Remove associated universities first.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $basePath = public_path('upload/country/');

        if ($data->thumbnail) {
            $thumbnailPath = $basePath . $data->thumbnail;
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            } else {
                error_log("File not found: " . $thumbnailPath);
            }
        }
        
        if ($data->breadcrumb) {
            $breadcrumbPath = $basePath . $data->breadcrumb;
            if (file_exists($breadcrumbPath)) {
                unlink($breadcrumbPath);
            } else {
                error_log("File not found: " . $breadcrumbPath);
            }
        }
       

        $data->delete();

        $notification = [
            'message' => ' Country Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function active($id)
    {
        PrimiumCountry::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => ' Country Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        PrimiumCountry::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => ' Country Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    //university
    public function universitylist()
    {
        $data = PrimiumUniversity::latest()->get();
        $countries = PrimiumCountry::where('status', 1)->get();
        return view('admin.primium.university.list', compact('data', 'countries'));
    } // end method

    public function universitycreate()
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        return view('admin.primium.university.create', compact('countries'));
    } // end method

    public function universitystore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:primium_universities',
            'country_id' => 'required',
            'email' => 'required|unique:primium_universities',
            'logo' => 'required|mimes:png,jpg,webp,jpeg',
            'thumbnail' => 'required|mimes:png,jpg,webp,jpeg',
            'breadcrumb' => 'required|mimes:png,jpg,webp,jpeg',
        ]);

        $data = new PrimiumUniversity();
        $data->country_id = $request->country_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->email = $request->email;
        $data->university_id = $request->university_id;
        $data->address = $request->address;
        $data->about = $request->about;
        $data->status = '0';

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = $request->name . '_logo.' . $file->getClientOriginalExtension(); // Concatenating with
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)
                ->resize(80, 80)
                ->save('upload/university/' . $filename);
            $data->logo = $filename;
        }

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $request->name . '_thumbnail.' . $file->getClientOriginalExtension(); // Concatenating with
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)
                ->resize(300, 200)
                ->save('upload/university/' . $filename);
            $data->thumbnail = $filename;
        }

        if ($request->file('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = $request->name . '_breadcrumb.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/university/'), $filename);
            $data->breadcrumb = $filename;
        }

        $data->save();

        $notification = [
            'message' => 'University Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.university.list')->with($notification);
    } // end method

    public function universityedit($id)
    {
        $data = PrimiumUniversity::findOrFail($id);
        $countries = PrimiumCountry::where('status', 1)->get();

        $selectedCountryId = $data->country_id;

        return view('admin.primium.university.edit', compact('data', 'countries', 'selectedCountryId'));
    } // end method

    public function universityupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $data = PrimiumUniversity::findOrFail($id);
        $data->country_id = $request->country_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);
        $data->email = $request->email;
        $data->university_id = $request->university_id;
        $data->address = $request->address;
        $data->about = $request->about;

        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = $request->name . '_logo.' . $file->getClientOriginalExtension(); // Concatenating with
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)
                ->resize(80, 80)
                ->save('upload/university/' . $filename);
            $data->logo = $filename;
        }

        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $request->name . '_thumbnail.' . $file->getClientOriginalExtension(); // Concatenating with
            $file->move(public_path('upload/university'), $filename);
            Image::make(public_path('upload/university') . '/' . $filename)
                ->resize(300, 200)
                ->save('upload/university/' . $filename);
            $data->thumbnail = $filename;
        }

        if ($request->file('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = $request->name . '_breadcrumb.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/university/'), $filename);
            $data->breadcrumb = $filename;
        }
        $data->save();

        $notification = [
            'message' => 'University Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.university.list')->with($notification);
    } // end method

    public function universitydestroy($id)
    {
        $data = PrimiumUniversity::findOrFail($id);

        $programType = ProgramType::where('university_id', $id)->count();
        if ($programType > 0) {
            $notification = [
                'message' => 'Cannot Remove University! Please Remove associated Program Type first.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        $basePath = public_path('upload/university/');

        if ($data->thumbnail) {
            $thumbnailPath = $basePath . $data->thumbnail;
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }
        
        if ($data->breadcrumb) {
            $breadcrumbPath = $basePath . $data->breadcrumb;
            if (file_exists($breadcrumbPath)) {
                unlink($breadcrumbPath);
            }
        }
        
        if ($data->logo) {
            $logoPath = $basePath . $data->logo;
            if (file_exists($logoPath)) {
                unlink($logoPath);
            }
        }

        $data->delete();

        $notification = [
            'message' => ' University Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function universityactive($id)
    {
        PrimiumUniversity::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => ' University Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function universityinactive($id)
    {
        PrimiumUniversity::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Primium University Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    //university course content

    public function content()
    {
        $data = PrimiumUniversityContent::latest()->get();
        $universityCourse = PrimiumUniversityCourse::where('status', 1)->get();
        return view('admin.primium.content.list', compact('data', 'universityCourse'));
    }

    public function contentcreate()
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $uniCourse = PrimiumUniversityCourse::where('status', 1)->get();
        $departments = PrimiumCourse::where('status', 1)->get();
        $programtype = ProgramType::all();
        return view('admin.primium.content.create', compact('uniCourse', 'departments', 'programtype', 'universities', 'countries'));
    } // end method

    public function getUniversitiesUniContent(Request $request)
    {
        $countryId = $request->country_id;
        $universities = PrimiumUniversity::where('country_id', $countryId)->pluck('name', 'id');
        return response()->json($universities);
    }

    public function getProgramTypesUniContent(Request $request)
    {
        $universityId = $request->university_id;
        $programTypes = ProgramType::where('university_id', $universityId)->pluck('name', 'id');
        return response()->json($programTypes);
    }

    public function getCoursesUniContent(Request $request)
    {
        $programTypeId = $request->program_type_id;
        $courses = PrimiumCourse::where('program_type_id', $programTypeId)->pluck('name', 'id');
        return response()->json($courses);
    }

    public function getUniversityCoursesUniContent(Request $request)
    {
        $courseId = $request->course_id;
        $universityCourses = PrimiumUniversityCourse::where('course_id', $courseId)->pluck('name', 'id');
        return response()->json($universityCourses);
    }

    public function contentstore(Request $request)
    {
        $validated = $request->validate([
            'universitycourse_id' => 'required',
        ]);

        $existingContent = PrimiumUniversityContent::where('universitycourse_id', $request->universitycourse_id)->first();

        if ($existingContent) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Content with this University Course already exists!',
                    'alert-type' => 'error',
                ]);
        } else {
            // If no record with the same universitycourse_id exists, create a new one
            PrimiumUniversityContent::create([
                'country_id' => $request->country_id,
                'university_id' => $request->university_id,
                'program_type_id' => $request->program_type_id,
                'course_id' => $request->course_id,
                'universitycourse_id' => $request->universitycourse_id,
                'overview' => $request->overview,
                'criteria' => $request->criteria,
                'scholarship' => $request->scholarship,
                'career' => $request->career,
                'fee' => $request->fee,
                'assistance' => $request->assistance,
                'faq' => $request->faq,
                'status' => '0',
            ]);

            return redirect()
                ->route('primium.content.list')
                ->with([
                    'message' => ' Content Insert Success!',
                    'alert-type' => 'success',
                ]);
        }
    }

    public function contentedit($id)
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $programtype = ProgramType::all();
        $departments = PrimiumCourse::where('status', 1)->get();
        $uniCourse = PrimiumUniversityCourse::where('status', 1)->get();
        $data = PrimiumUniversityContent::findOrFail($id);

        return view('admin.primium.content.edit', compact('uniCourse', 'countries', 'universities', 'programtype', 'departments', 'data'));
    } // end method

    public function contentshow($id)
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $programtype = ProgramType::all();
        $departments = PrimiumCourse::where('status', 1)->get();
        $uniCourse = PrimiumUniversityCourse::where('status', 1)->get();
        $data = PrimiumUniversityContent::findOrFail($id);

        return view('admin.primium.content.show', compact('uniCourse', 'countries', 'universities', 'programtype', 'departments', 'data'));
    }

    public function contentupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'universitycourse_id' => 'required',
        ]);

        $data = PrimiumUniversityContent::findOrFail($id);
        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->program_type_id = $request->program_type_id;
        $data->course_id = $request->course_id;
        $data->universitycourse_id = $request->universitycourse_id;
        $data->overview = $request->overview;
        $data->criteria = $request->criteria;
        $data->scholarship = $request->scholarship;
        $data->career = $request->career;
        $data->fee = $request->fee;
        $data->assistance = $request->assistance;
        $data->faq = $request->faq;
        // return $data;
        $data->save();

        $notification = [
            'message' => ' Content Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.content.list')->with($notification);
    } // end method

    public function contentactive($id)
    {
        PrimiumUniversityContent::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => ' Content Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function contentnactive($id)
    {
        PrimiumUniversityContent::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => ' Content Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function contentdestroy($id)
    {
        $data = PrimiumUniversityContent::findOrFail($id);

        $data->delete();

        $notification = [
            'message' => ' Content Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    //course
    public function courselist()
    {
        $data = PrimiumCourse::orderBy('name', 'asc')->get();
        $programtypes = ProgramType::all();
        return view('admin.primium.course.list', compact('data', 'programtypes'));
    } // end method

    public function coursecreate()
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $programtypes = ProgramType::all();
        return view('admin.primium.course.create', compact('programtypes', 'universities', 'countries'));
    }

    public function coursestore(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required',
            'country_id' => 'required',
            'university_id' => 'required',
            'program_type_id' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,webp,jpeg',
            'breadcrumb' => 'required|mimes:png,jpg,webp,jpeg',
        ]);

        // Check for duplicates
        $existingCourse = PrimiumCourse::where('name', $request->name)
            ->where('country_id', $request->country_id)
            ->where('university_id', $request->university_id)
            ->where('program_type_id', $request->program_type_id)
            ->first();

        if ($existingCourse) {
            $notification = [
                'message' => 'Course already exists with the same Department, Country, University, and Program Type.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Create a new course instance
        $data = new PrimiumCourse();
        $data->name = $request->name;
        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->program_type_id = $request->program_type_id;
        $data->slug = Str::slug($request->name);
        $data->status = '0';

        // Handle thumbnail upload
        if ($request->file('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $request->name . 'thumbnail_' . $file->getClientOriginalName();
            $file->move(public_path('upload/course'), $filename);
            Image::make(public_path('upload/course') . '/' . $filename)
                ->resize(300, 200)
                ->save('upload/course/' . $filename);
            $data->thumbnail = $filename;
        }

        // Handle breadcrumb upload
        if ($request->file('breadcrumb')) {
            $file = $request->file('breadcrumb');
            $filename = $request->name . 'breadcrumb_' . $file->getClientOriginalName();
            $file->move(public_path('upload/course/'), $filename);
            $data->breadcrumb = $filename;
        }

        // Save the new course
        $data->save();

        // Set success notification
        $notification = [
            'message' => 'Department Insert Success!',
            'alert-type' => 'success',
        ];

        // Redirect to the course list with notification
        return redirect()->route('primium.course.list')->with($notification);
    }

    public function courseedit($id)
    {
        $data = PrimiumCourse::findOrFail($id);
        $universities = PrimiumUniversity::where('status', 1)->get();
        $programtypes = ProgramType::all();
        $countries = PrimiumCountry::where('status', 1)->get();

        return view('admin.primium.course.edit', compact('data', 'universities', 'programtypes', 'countries'));
    } // end method

    public function courseupdate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $data = PrimiumCourse::findOrFail($id);
        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->program_type_id = $request->program_type_id;
        $data->name = $request->name;
        $data->slug = Str::slug($request->name);

        // Check if new thumbnail is uploaded
        if ($request->hasFile('thumbnail')) {
            // Delete previous thumbnail
            if ($data->thumbnail) {
                $oldThumbnailPath = public_path('upload/course/') . $data->thumbnail;
                if (file_exists($oldThumbnailPath)) {
                    unlink($oldThumbnailPath);
                }
            }
            // Upload new thumbnail
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = $request->name . '_thumbnail_' . $thumbnailFile->getClientOriginalName();
            $thumbnailFile->move(public_path('upload/course'), $thumbnailFileName);
            Image::make(public_path('upload/course') . '/' . $thumbnailFileName)
                ->resize(300, 200)
                ->save('upload/course/' . $thumbnailFileName);
            $data->thumbnail = $thumbnailFileName;
        }

        // Check if new breadcrumb is uploaded
        if ($request->hasFile('breadcrumb')) {
            // Delete previous breadcrumb
            if ($data->breadcrumb) {
                $oldBreadcrumbPath = public_path('upload/course/') . $data->breadcrumb;
                if (file_exists($oldBreadcrumbPath)) {
                    unlink($oldBreadcrumbPath);
                }
            }
            // Upload new breadcrumb
            $breadcrumbFile = $request->file('breadcrumb');
            $breadcrumbFileName = $request->name . '_breadcrumb_' . $breadcrumbFile->getClientOriginalName();
            $breadcrumbFile->move(public_path('upload/course'), $breadcrumbFileName);
            $data->breadcrumb = $breadcrumbFileName;
        }

        $data->save();

        $notification = [
            'message' => 'Department Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.course.list')->with($notification);
    }

    public function coursedestroy($id)
    {
        $data = PrimiumCourse::findOrFail($id);

        $department = PrimiumUniversityCourse::where('course_id', $id)->count();
        if ($department > 0) {
            $notification = [
                'message' => 'Cannot Remove department! Please Remove associated course first.',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }

        // Delete thumbnail if exists
        if ($data->thumbnail) {
            $thumbnailPath = public_path('upload/course/') . $data->thumbnail;
            if (file_exists($thumbnailPath)) {
                unlink($thumbnailPath);
            }
        }

        // Delete breadcrumb if exists
        if ($data->breadcrumb) {
            $breadcrumbPath = public_path('upload/course/') . $data->breadcrumb;
            if (file_exists($breadcrumbPath)) {
                unlink($breadcrumbPath);
            }
        }

        $data->delete();

        $notification = [
            'message' => 'Department Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    public function courseactive($id)
    {
        PrimiumCourse::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Department Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function courseinactive($id)
    {
        PrimiumCourse::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => 'Department Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function getUniversities(Request $request)
    {
        $countryId = $request->country_id;
        $universities = PrimiumUniversity::where('country_id', $countryId)->pluck('name', 'id');
        return response()->json($universities);
    }

    public function getProgramTypes(Request $request)
    {
        $universityId = $request->university_id;
        $programTypes = ProgramType::where('university_id', $universityId)->pluck('name', 'id');
        return response()->json($programTypes);
    }

    //university course
    public function unicourselist()
    {
        $data = PrimiumUniversityCourse::get();
        $courses = PrimiumCourse::where('status', 1)->get();
        $programtypes = ProgramType::all();
        return view('admin.primium.universityCourse.list', compact('data', 'courses', 'programtypes'));
    } // end method

    public function unicoursecreate()
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $courses = PrimiumCourse::where('status', 1)->get();
        $programtypes = ProgramType::all();
        $courselist = CoursesList::latest()->get();
        // return $countries;
        return view('admin.primium.universityCourse.create', compact('countries', 'universities', 'programtypes', 'courses', 'courselist'));
    }

    public function unicoursestore(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required',
            'university_id' => 'required',
            'program_type_id' => 'required',
            'course_id' => 'required',
            'name' => 'required',
        ]);

        // Get the selected course image from the request
          $courselist = CoursesList::all();
        $imageName = '';
        foreach ($courselist as $item) {
            if ($item->name == $request->name) {
                $imageName = $item->image;
                break;
            }
        }

        $data = PrimiumUniversityCourse::firstOrCreate(
            [
                'country_id' => $request->country_id,
                'university_id' => $request->university_id,
                'program_type_id' => $request->program_type_id,
                'course_id' => $request->course_id,
                'name' => $request->name,
            ],
            [
                'status' => '0',
                'image' => $imageName, // Store the course image
            ],
        );

        if ($data->wasRecentlyCreated) {
            $notification = [
                'message' => ' University Course Insert Success!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => ' University Course already exists!',
                'alert-type' => 'error',
            ];
        }

        return redirect()->route('primium.unicourse.list')->with($notification);
    }

    public function unicourseedit($id)
    {
        $countries = PrimiumCountry::where('status', 1)->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $programtypes = ProgramType::all();
        $courses = PrimiumCourse::where('status', 1)->get();
        $uniCourse = PrimiumUniversityCourse::findOrFail($id);
        // return $uniCourse;
        return view('admin.primium.universityCourse.edit', compact('countries', 'universities', 'programtypes', 'courses', 'uniCourse'));
    } // end method

    public function unicourseupdate(Request $request, $id)
    {
        $data = PrimiumUniversityCourse::findOrFail($id);
        $data->country_id = $request->country_id;
        $data->university_id = $request->university_id;
        $data->program_type_id = $request->program_type_id;
        $data->course_id = $request->course_id;
        $data->name = $request->name;

        $data->save();

        $notification = [
            'message' => ' Course Insert Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('primium.unicourse.list')->with($notification);
    } // end method

    public function unicoursedestroy($id)
    {
        $data = PrimiumUniversityCourse::findOrFail($id);

        $data->delete();

        $notification = [
            'message' => ' Course Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function unicoursective($id)
    {
        PrimiumUniversityCourse::where('id', $id)->update(['status' => 1]);
        $notification = [
            'message' => 'Primium University Course Active Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function unicourseinactive($id)
    {
        PrimiumUniversityCourse::where('id', $id)->update(['status' => 0]);
        $notification = [
            'message' => ' University Course Inactive Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    } // end method

    public function getUniversitiesNajmul(Request $request)
    {
        $universities = PrimiumUniversity::where('country_id', $request->country_id)->pluck('name', 'id');
        return response()->json($universities);
    }

    public function getProgramTypesNajmul(Request $request)
    {
        $programTypes = ProgramType::where('university_id', $request->university_id)->pluck('name', 'id');
        return response()->json($programTypes);
    }

    public function getCoursesNajmul(Request $request)
    {
        $courses = PrimiumCourse::where('program_type_id', $request->program_type_id)->pluck('name', 'id');
        return response()->json($courses);
    }

    public function primiumUniversityDetails()
    {
        $countries = PrimiumCountry::where('status', 1)->orderBy('name', 'asc')->latest()->get();
        $universities = PrimiumUniversity::where('status', 1)->get();
        $courses = PrimiumCourse::where('status', 1)->get();
        $universityCourse = PrimiumUniversityCourse::where('status', 1)->get();
        $content = PrimiumUniversityContent::get();
        return view('user.primium.university_details', compact('countries', 'courses', 'universities', 'universityCourse', 'content'));
    }

    public function fetchUniversity(Request $request)
    {
        $countryId = $request->input('country_id');
        $universities = PrimiumUniversity::where('country_id', $countryId)->get();

        return response()->json(['university' => $universities]);
    } // end method

    public function fetchCourse(Request $request)
    {
        $universityId = $request->input('university_id');
        $courses = PrimiumCourse::where('university_id', $universityId)->get();

        return response()->json(['courses' => $courses]);
    } // end method

    public function fetchDepartment(Request $request)
    {
        $programId = $request->input('program_id'); // Adjusted to match the AJAX data
        $departments = PrimiumCourse::where('program_type_id', $programId)->get();

        return response()->json(['departments' => $departments]);
    }

    public function fetchUniversityCourse(Request $request)
    {
        $courseId = $request->input('course_id');
        $universityCourses = PrimiumUniversityCourse::where('course_id', $courseId)->get();

        return response()->json(['universityCourses' => $universityCourses]);
    } // end method

    public function fetchUniversityContent(Request $request)
    {
        $contentId = $request->input('universitycourse_id');
        $universityContent = PrimiumUniversityContent::where('status', 1)->where('universitycourse_id', $contentId)->get();

        return response()->json(['universityContent' => $universityContent]);
    } // end method

    public function primiumStudent(Request $request)
    {
        // Save the student's payment details
        $data = new PrimiumStudent();
        $data->user_id = auth()->user()->id;
        $data->display_amount = $request->display_amount;
        $data->payment_method_item = $request->payment_method_item;
        $data->txt_number = $request->txt_number;
        $data->bank_name = $request->bank_name;
        $data->bank_txt_upload = $request->bank_txt_upload;
        $data->status = '0';
        $data->save();

        // Retrieve the super admin's email address dynamically
        $superAdmin = User::where('role_id', 1)->first();

        if ($superAdmin) {
            $superAdminEmail = $superAdmin->email;
            $user = auth()->user();

            // Compose the email message
            $message = "New payment submitted by a student.\n\n";
            $message .= 'User Name: ' . $user->name . "\n";
            $message .= 'User Email: ' . $user->email . "\n";
            $message .= 'Please review.';

            // Send the email notification to the super admin
            Mail::raw($message, function ($email) use ($superAdminEmail) {
                $email->to($superAdminEmail)->subject('New Payment Submission');
            });
        }

        // Prepare the notification message
        $notification = [
            'message' => 'Payment for Premium Subscription Success!',
            'alert-type' => 'success',
        ];

        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }
}
