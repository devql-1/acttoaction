<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends Controller
{
    //This method will show Service Category listing
    public function index(){
        $service_category = ServiceCategory::get();
        return view('backend.service_system.category.index',compact('service_category'));
    }

    //This method will store a record of service category
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceCategory();
            $create->category_name = $request->category_name;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $create->save();

            return redirect()->back()->with('success','Service Category Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show service categories form for updating a listing
    public function edit($id){
        $edit = ServiceCategory::find($id);
        return view('backend.service_system.category.edit',compact('edit'));
    }

    //This method will update a existing listing of service category
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'category_name' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceCategory::find($id);
            $update->category_name = $request->category_name;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $update->save();

            return redirect()->route('admin.service-category')->with('success','Service Category Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceCategory::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceCategory_toggleStatus(Request $request)
    {
        $toggle = ServiceCategory::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
