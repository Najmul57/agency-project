<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Str;

class SettingController extends Controller
{

    public function about()
    {
        $data = DB::table('abouts')->first();
        return view('admin.settings.about', compact('data'));
    } // end method

    public function aboutSetting(Request $request, $id)
    {
        $data = array();
        $data['about'] = $request->about;
        $data['updated_at'] = Carbon::now();

        DB::table('abouts')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'About Page Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function seo()
    {
        $data = DB::table('seos')->first();
        return view('admin.settings.seo', compact('data'));
    } // end method

    public function seoSetting(Request $request, $id)
    {
        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['meta_keywords'] = $request->meta_keywords;
        $data['google_verification'] = $request->google_verification;
        $data['google_analytics'] = $request->google_analytics;
        $data['alexa_varification'] = $request->alexa_varification;
        $data['google_adsense'] = $request->google_adsense;
        $data['updated_at'] = Carbon::now();

        DB::table('seos')->where('id', $id)->update($data);

        $notification = array(
            'message' => 'SEO Setting Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function smtp()
    {
        $smtp = DB::table('smtp')->first();
        return view('admin.settings.smtp', compact('smtp'));
    } // end method

    public function smtpSetting(Request $request, $id)
    {
        $smtp = array();
        $smtp['mailer'] = $request->mailer;
        $smtp['host'] = $request->host;
        $smtp['port'] = $request->port;
        $smtp['user_name'] = $request->user_name;
        $smtp['password'] = $request->password;
        $smtp['updated_at'] = Carbon::now();

        DB::table('smtp')->where('id', $id)->update($smtp);

        $notification = array(
            'message' => 'SMTP Setting Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method


    public function setting()
    {
        $setting = DB::table('settings')->first();
        return view('admin.settings.website_setting', compact('setting'));
    } // end method

    public function updatesetting(Request $request, $id)
    {
        $existingSetting = DB::table('settings')->where('id', $id)->first();

        $setting = [
            'currency' => $request->currency,
            'doller_rate' => $request->doller_rate,
            'inr_rate' => $request->inr_rate,
            'euro' => $request->euro_rate,
            'canada' => $request->canada_rate,
            // 'offer_letter' => $request->offer_letter,
            // 'admission_letter' => $request->admission_letter,
            // 'doctor_appoinment' => $request->doctor_appoinment,
            // 'another_letter' => $request->another_letter,
            'primium_subscription' => $request->primium_subscription,
            'partner_subscription' => $request->partner_subscription,
            'phone_one' => $request->phone_one,
            'phone_two' => $request->phone_two,
            'main_email' => $request->main_email,
            'support_email' => $request->support_email,
            'address' => $request->address,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'youtube' => $request->youtube,
            'short_about' => $request->short_about,
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('logo')) {
            // Handle logo upload
            $file = $request->file('logo');
            if (!empty($existingSetting->logo) && file_exists(public_path('upload/logo/' . $existingSetting->logo))) {
                unlink(public_path('upload/logo/' . $existingSetting->logo));
            }
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/logo'), $filename);
            Image::make(public_path('upload/logo') . '/' . $filename)->resize(150, 74)->save('upload/logo/' . $filename);
            $setting['logo'] = $filename;
        }

        if ($request->file('favicon')) {
            // Handle favicon upload
            $file = $request->file('favicon');
            if (!empty($existingSetting->favicon) && file_exists(public_path('upload/favicon/' . $existingSetting->favicon))) {
                unlink(public_path('upload/favicon/' . $existingSetting->favicon));
            }
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/favicon'), $filename);
            Image::make(public_path('upload/favicon') . '/' . $filename)->resize(32, 32)->save('upload/favicon/' . $filename);
            $setting['favicon'] = $filename;
        }

        if ($request->file('signature')) {
            // Handle favicon upload
            $file = $request->file('signature');
            if (!empty($existingSetting->signature) && file_exists(public_path('upload/authorsignature/' . $existingSetting->signature))) {
                unlink(public_path('upload/authorsignature/' . $existingSetting->signature));
            }
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/authorsignature'), $filename);
            Image::make(public_path('upload/authorsignature') . '/' . $filename)->resize(300, 80)->save('upload/authorsignature/' . $filename);
            $setting['signature'] = $filename;
        }

        // Update the settings record in the database
        DB::table('settings')->where('id', $id)->update($setting);

        // Create a notification message
        $notification = [
            'message' => 'Setting Update Success!',
            'alert-type' => 'success'
        ];

        // Redirect back to the settings page with the notification
        return redirect()->route('website.setting')->with($notification);
    }
}
