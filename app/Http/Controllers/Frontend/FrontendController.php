<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Country;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Facilities;
use App\Models\Payfees;
use App\Models\PaymentInvoice;
use App\Models\PrimiumCountry;
use App\Models\PrimiumCourse;
use App\Models\PrimiumUniversity;
use App\Models\PrimiumUniversityCourse;
use App\Models\ProgramType;
use App\Models\Services;
use App\Models\NocForm;
use App\Models\Slider;
use App\Models\StudentFeedback;
use App\Models\SuccessCount;
use App\Models\University;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FrontendController extends Controller
{
    public function paymentPdf($id, $token)
    {
        $payment = Payfees::findOrFail($id);
        $pdfPath = 'public/upload/paymentinvoice/payment_receipt_' . $payment->receipt_id . '.pdf';
        return response()->file(storage_path('app/' . $pdfPath));
    }
    public function nocVerifyPdf($id, $token)
    {
        $noc = NocForm::findOrFail($id);
        $pdfPath = 'app/' . $noc->pdf_path;
        $filename = basename($noc->pdf_path);
        $response = response()->file(storage_path($pdfPath));
        $response->headers->set('Content-Disposition', "inline; filename=\"$filename\"");
        return $response;
    }

    public function listPdfs()
    {
        $pdfDirectory = storage_path('app/public/upload/paymentinvoice');
        $pdfFiles = File::files($pdfDirectory);

        $pdfData = array_map(function ($file) {
            return [
                'name' => pathinfo($file, PATHINFO_BASENAME),
                'filename' => pathinfo($file, PATHINFO_FILENAME),
                'path' => $file->getRealPath(),
            ];
        }, $pdfFiles);

        return view('pdf_list', compact('pdfData'));
    }

    // Serve PDF
    public function servePdf($filename)
    {
        $filePath = storage_path("app/public/upload/paymentinvoice/{$filename}.pdf");

        if (!File::exists($filePath)) {
            return response()->json(['error' => 'File does not exist.'], 404);
        }

        return response()->file($filePath);
    }

    public function index()
    {
        $sliders = Slider::where('status', 1)->latest()->get();
        $success = SuccessCount::where('status', 1)->latest()->limit(4)->get();

        $courses = PrimiumUniversityCourse::where('status', 1)->get();
        $groupedCourses = $courses->groupBy('name');

        $type = ProgramType::all();
        $services = Services::where('status', 1)->latest()->limit(8)->get();
        $countries = PrimiumCountry::where('status', 1)->latest()->limit(6)->get();
        $universities = PrimiumUniversity::where('status', 1)->latest()->limit(8)->get();
        $blogs = Blog::where('status', 1)->latest()->limit(4)->get();
        $totalUniversity = PrimiumUniversity::where('status', 1)->count();
        $totalCountry = PrimiumCountry::where('status', 1)->count();
        $feedback = StudentFeedback::where('status', 1)->latest()->get();
        return view('frontend.index', compact('sliders', 'success', 'groupedCourses', 'services', 'countries', 'universities', 'blogs', 'totalUniversity', 'totalCountry', 'feedback', 'type'));
    } // end method

    public function couseUniversity($slug)
    {
        $courses = PrimiumUniversityCourse::where('status', 1)->where('name', $slug)->get();
        $universityIds = $courses->pluck('university_id');

        $universities = PrimiumUniversity::whereIn('id', $universityIds)->inRandomOrder()->get();

        $facilities = Facilities::inRandomOrder()->get();

        return view('frontend.department.show', compact('universities', 'facilities', 'slug'));
    }

    public function universitydetails($slug)
    {
        $universities = PrimiumUniversity::where('status', 1)->where('slug', '!=', $slug)->inRandomOrder()->limit(8)->get();

        $unidetails = PrimiumUniversity::where('slug', $slug)->firstOrFail();

        $courses = PrimiumUniversityCourse::where('university_id', $unidetails->id)
            ->where('status', 1)
            ->get();
        $facilities = Facilities::where('status', 1)->get();

        return view('frontend.university.uni__details', compact('unidetails', 'universities', 'facilities', 'courses'));
    }

    public function servicedetails($slug)
    {
        $serviceDetails = Services::where('slug', $slug)->first();
        $services = Services::where('status', 1)
            ->where('slug', '!=', $slug)
            ->latest()
            ->get();
        return view('frontend.service.service_details', compact('serviceDetails', 'services'));
    }

    public function blogdetails($slug)
    {
        $blogdetails = Blog::where('slug', $slug)->first();
        $blogs = Blog::where('status', 1)
                ->where('slug','!=',$slug)
                ->latest()->get();
        return view('frontend.blog.blogdetails', compact('blogdetails', 'blogs'));
    } // end method

    public function countrydetails($slug)
    {
        $countrydetails = PrimiumCountry::where('slug', $slug)->first();
        $countries = PrimiumCountry::where('status', 1)->where('slug', '!=', $slug)->latest()->get();
        return view('frontend.country.country_details', compact('countrydetails', 'countries'));
    } // end method

    public function search(Request $request)
    {
        if ($request->ajax()) {
            $universities = PrimiumUniversity::where('name', 'LIKE', '%' . $request->search . '%')->get();
            $countriess = PrimiumCountry::where('name', 'LIKE', '%' . $request->search . '%')->get();

            $output = '';

            if (count($universities) > 0 || count($countriess) > 0) {
                $output = '';
                foreach ($universities as $university) {
                    $output .= '<li><a href="' . route('universitydetails.page', ['slug' => $university->slug]) . '" class="search__result_show">' . $university->name . ' (University)</a></li>';
                }

                foreach ($countriess as $country) {
                    $output .= '<li><a href="' . route('countrydetails.page', ['slug' => $country->slug]) . '" class="search__result_show">' . $country->name . ' (Country)</a></li>';
                }

                $output .= '</ul>';
            } else {
                $output .= '<li style="padding:10px">No data</li>';
            }

            return $output;
        }
        return view('frontend.includes.slider');
    } // end method

    public function page($page_slug)
    {
        $page = DB::table('pages')->where('page_slug', $page_slug)->first();
        return view('frontend.pages.index', compact('page'));
    } // end method

    public function getUniversitiesReg(Request $request, $countryId)
    {
        $universities = PrimiumUniversity::where('country_id', $countryId)->orderBy('name', 'ASC')->get();
        return response()->json($universities);
    }
    public function getProgramTypeReg($university)
    {
        $programTypes = ProgramType::where('university_id', $university)->get();
        return response()->json($programTypes);
    }
    public function getCoursesReg(Request $request, $programTypeId)
    {
        $courses = PrimiumCourse::where('program_type_id', $programTypeId)->orderBy('name', 'ASC')->get();
        return response()->json($courses);
    }
    public function getUniCoursesReg(Request $request, $courseId)
    {
        $uniCourses = PrimiumUniversityCourse::where('course_id', $courseId)->orderBy('name', 'ASC')->get();
        return response()->json($uniCourses);
    }

    public function coupon_get(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon_code)->first();
        $now = Carbon::now();
        if ($coupon) {
            if ($coupon->status == 0) {
                return response()->json(['error' => 'Coupon Is Now InActive.']);
            }
            if ($coupon->date != '') {
                $enddate = $coupon->date;
                if ($now->gt($enddate)) {
                    return response()->json(['error' => 'Coupon Expired date.']);
                }
            }
            return response()->json(['success' => 'Added your coupon', 'coupon' => $coupon]);
        } else {
            return response()->json(['error' => 'Coupon not found.']);
        }
    }

    public function getUniversitiesByCountry($countryId)
    {
        $universities = PrimiumUniversity::where('country_id', $countryId)->orderBy('name', 'ASC')->get();
        return response()->json($universities);
    }

    public function getProgramTypesByUniversity($universityId)
    {
        $programTypes = ProgramType::where('university_id', $universityId)->orderBy('name', 'ASC')->get();
        return response()->json($programTypes);
    }

    public function getCoursesByProgramType($programTypeId)
    {
        $courses = PrimiumCourse::where('program_type_id', $programTypeId)->orderBy('name', 'ASC')->get();
        return response()->json($courses);
    }

    public function getUniversityCoursesByCourse($courseId)
    {
        $universityCourses = PrimiumUniversityCourse::where('course_id', $courseId)->orderBy('name', 'ASC')->get();
        return response()->json($universityCourses);
    }
}
