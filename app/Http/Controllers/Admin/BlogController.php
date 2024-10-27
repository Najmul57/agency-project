<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class BlogController extends Controller
{
    public function index(){
        $data=Blog::latest()->get();
        return view('admin.blog.index',compact('data'));
    } //end method

    public function create(){
        return view('admin.blog.create');
    } //end method

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|unique:blogs',
            'image' => 'image|mimes:jpeg,png,jpg,webp,gif',
        ]);

        $data = new Blog();
        $data->title = $request->title;
        $data->slug = Str::slug($request->title,'-');
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;
        $data->status = '0';

        // if ($request->file('image')) {
        //     $file = $request->file('image');
        //     $filename = date('YmdHi') . $file->getClientOriginalName();
        //     $file->move(public_path('upload/blog'), $filename);
        //     Image::make(public_path('upload/blog') . '/' . $filename)->resize(840, 560)->save('upload/blog/' . $filename);
        //     $data->image = $filename;
        // }

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $filenameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME); 
            $webpFilename = $filenameWithoutExtension . '.webp'; 
        
            $file->move(public_path('upload/blog'), $filename);
        
            Image::make(public_path('upload/blog') . '/' . $filename)
                ->resize(840, 560)
                ->encode('webp', 100) // Encode as WebP with 100% quality
                ->save(public_path('upload/blog') . '/' . $webpFilename);
            unlink(public_path('upload/blog') . '/' . $filename);
            $data->image = $webpFilename;
        }

        $data->save();
        $notification = array(
            'message' => 'Blog Insert Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
    } //end method

    public function edit($id){
        $data = Blog::findOrFail($id);
        return view('admin.blog.edit',compact('data'));
    } //end method

    public function update(Request $request,$id){
        $request->validate([
            'title' => 'required|string',
        ]);

        $data = Blog::findOrFail($id);
        $data->title = $request->title;
        $data->slug = Str::slug($request->title,'-');
        $data->short_description = $request->short_description;
        $data->long_description = $request->long_description;

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/blog'), $filename);
            if ($data->image) {
                $oldImage = public_path('upload/blog/' . $data->image);
                if (file_exists($oldImage)) {
                    unlink($oldImage);
                }
            }
            Image::make(public_path('upload/blog') . '/' . $filename)->resize(840, 560)->save('upload/blog/' . $filename);
            $data->image = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Blog Update Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
    } //end method

    public function destroy($id){
        $data = Blog::findOrFail($id);
        if ($data->image) {
            unlink(public_path('upload/blog/' . $data->image));
        }

        $data->delete();

        $notification = array(
            'message' => 'Blog Delete Success!',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.index')->with($notification);
    } //end method
    public function active($id)
    {
        Blog::where('id', $id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Blog Active Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function inactive($id)
    {
        Blog::where('id', $id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Blog Inactive Success!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
