<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AboutCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutCategoryController extends Controller
{
    //This method will show listing for about category
    public function index(){
        $about_category = AboutCategory::get();
        return view('backend.about_system.category.index',compact('about_category'));
    }

    //This method will store a record of about category
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if($validator->passes()){
            $create = new AboutCategory();
            $create->category_name = $request->category_name;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $create->save();

            return redirect()->back()->with('success','About Category Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show about categories form for updating a listing
    public function edit($id){
        $edit = AboutCategory::find($id);
        return view('backend.about_system.category.edit',compact('edit'));
    }

    //This method will update a existing listing of about category
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if($validator->passes()){
            $update = AboutCategory::find($id);
            $update->category_name = $request->category_name;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $update->save();

            return redirect()->route('admin.about-category')->with('success','About Category Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        AboutCategory::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function aboutCategory_toggleStatus(Request $request)
    {
        $toggle = AboutCategory::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
