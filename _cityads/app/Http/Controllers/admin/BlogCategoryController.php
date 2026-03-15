<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    //This method will show listing for blog category
    public function index()
    {
        $blogs_category = BlogCategory::get();
        return view('backend.blog_system.category.index', compact('blogs_category'));
    }

    //This method will store a record of blog category
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->passes()) {
            $create = new BlogCategory();
            $create->category_name = $request->category_name;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $create->save();

            return redirect()->back()->with('success', 'Blogs Category Data Added Successfully');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }


    }

    //This method will show blog categories form for updating a listing
    public function edit($id)
    {
        $edit = BlogCategory::find($id);
        return view('backend.blog_system.category.edit', compact('edit'));
    }

    //This method will update a existing listing of blog category
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
        ]);

        if ($validator->passes()) {
            $update = BlogCategory::find($id);
            $update->category_name = $request->category_name;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $update->save();

            return redirect()->route('admin.blog-category')->with('success', 'Blogs Category Data Updated Successfully');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id)
    {
        BlogCategory::find($id)->delete();
        return redirect()->route('admin.blog-category')->with('success', 'Blogs Category Data Deleted Successfully');
    }

    // This method will show for published unpublished notification
    public function blogCategory_toggleStatus(Request $request)
    {
        $toggle = BlogCategory::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }

}
