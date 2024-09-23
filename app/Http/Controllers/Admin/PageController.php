<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function page()
    {
        $pages = DB::table('pages')->latest()->get();
        return view('admin.settings.pages.index', compact('pages'));
    } // end method

    public function create()
    {
        return view('admin.settings.pages.create');
    } // end method

    public function store(Request $request)
    {
        $data = array();
        // $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name);
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['created_at'] = Carbon::now();

        DB::table('pages')->insert($data);
        $notification = array(
            'message' => 'Page Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('page.index')->with($notification);
    } // end method
    public function edit($id)
    {
        $data = DB::table('pages')->where('id', $id)->first();
        return view('admin.settings.pages.edit', compact('data'));
    } // end method
    public function update(Request $request, $id)
    {
        $data = array();
        // $data['page_position'] = $request->page_position;
        $data['page_name'] = $request->page_name;
        $data['page_slug'] = Str::slug($request->page_name);
        $data['page_title'] = $request->page_title;
        $data['page_description'] = $request->page_description;
        $data['updated_at'] = Carbon::now();

        DB::table('pages')->where('id', $id)->update($data);
        $notification = array(
            'message' => 'Page Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('page.index')->with($notification);
    } // end method
    public function destroy($id)
    {
        DB::table('pages')->where('id', $id)->delete();
        $notification = array(
            'message' => 'Page Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

}
