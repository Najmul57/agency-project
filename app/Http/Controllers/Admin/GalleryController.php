<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Image;

class GalleryController extends Controller
{
    public function index()
    {
        $data = Gallery::latest()->get();
        return view('admin.gallery.index', compact('data'));
    } // end method

    public function create()
    {
        return view('admin.gallery.create');
    } // end method

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => 'required|image|mimes:jpeg,webp,png,svg,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('gallery.index')->withErrors($validator);
        }

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $file) {
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/gallery'), $filename);

                $data = new Gallery();
                $data->image = $filename;
                $data->save();
            }
        }

        $notification = [
            'message' => 'Gallery Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('gallery.index')->with($notification);
    } // end method

    public function edit($id)
    {
        $data = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('data'));
    } // end method

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/gallery'), $filename);
            $data = Gallery::findOrFail($id);

            if ($data->image) {
                $oldBannerPath = public_path('upload/gallery/' . $data->image);
                if (file_exists($oldBannerPath)) {
                    unlink($oldBannerPath);
                }
            }
            $data->image = $filename;
            $data->save();
        }

        $notification = [
            'message' => 'Gallery Image Update Success!',
            'alert-type' => 'success',
        ];
        return redirect()->route('gallery.index')->with($notification);
    } // end method

    public function destroy($id)
    {
        $data = Gallery::findOrFail($id);
        $filePath = public_path('upload/gallery/' . $data->image);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $data->delete();

        $notification = [
            'message' => 'Gallery image Delete Success!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }
}
