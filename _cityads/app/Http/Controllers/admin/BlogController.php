<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //This method will show listing for blog post
    public function index(){
        $blogs = Blog::latest()->get();
        return view('backend.blog_system.blog.index',compact('blogs'));
    }

    //This method will show form for creating a listing of blogs
    public function create(){
        $blog_categories = BlogCategory::where('status',1)->get();
        return view('backend.blog_system.blog.create',compact('blog_categories'));
    }


    //This method will store a record of blog
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'nullable',
        ]);

        if($validator->passes()){
            $create = new Blog();
            $create->category_id = $request->category_id;
            $create->title = $request->title;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $create->short_description = $request->short_description;
            $create->description = $request->description;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            }   

            $create->save();

            return redirect()->route('admin.blog')->with('success','Blogs Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }


    //This method will show blog form for updating a listing
    public function edit($id){
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::where('status',1)->get();
        return view('backend.blog_system.blog.edit',compact('blog','blog_categories'));
    }


    //This method will update a existing listing of blog
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'nullable',
        ]);

        if($validator->passes()){
            $update = Blog::find($id);
            $update->title = $request->title;
            $update->category_id = $request->category_id;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $update->short_description = $request->short_description;
            $update->description = $request->description;

            if ($request->input('remove_image') == "1") {
                if ($update->image && file_exists(public_path('img/' . $update->image))) {
                    unlink(public_path('img/' . $update->image));
                }
                $update->image = null;
            }

            if ($request->hasFile('image')) {
                if ($update->image && file_exists(public_path('img/' . $update->image))) {
                    unlink(public_path('img/' . $update->image));
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $update->image = $filename;
            }
  

            $update->save();

            return redirect()->route('admin.blog')->with('success','Blogs Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        Blog::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function blog_toggleStatus(Request $request)
    {
        $toggle = Blog::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
