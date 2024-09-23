<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function notice(){
        $data=Notice::first();
        return view('admin.notice.notice',compact('data'));
    } // end mthod

    public function noticeupdate(Request $request, $id){
        $data = Notice::findOrFail($id);

        $data->description = $request->input('description');

        $data->save();

        return redirect()->back()->with('success', 'Notice updated successfully');
    }
}
