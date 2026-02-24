<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceSubCategoryController extends Controller
{
    //This method will show Service Sub Category listing
    public function index(){
        $service_subcategory = ServiceSubcategory::get();
        $service_categories = ServiceCategory::get();
        return view('backend.service_system.subcategory.index',compact('service_subcategory','service_categories'));
    }

    //This method will store a record of service sub category
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'subcategory_name' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceSubcategory();
            $create->category_id = $request->category_id;
            $create->subcategory_name = $request->subcategory_name;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $create->save();

            return redirect()->back()->with('success','Service Sub Category Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show service sub categories form for updating a listing
    public function edit($id){
        $edit = ServiceSubcategory::find($id);
        $service_categories = ServiceCategory::get();
        return view('backend.service_system.subcategory.edit',compact('edit','service_categories'));
    }

    //This method will update a existing listing of service sub category
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'subcategory_name' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceSubcategory::find($id);
            $update->category_id = $request->category_id;
            $update->subcategory_name = $request->subcategory_name;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));

            $update->save();

            return redirect()->route('admin.service-subcategory')->with('success','Service Sub Category Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceSubcategory::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceSubCategory_toggleStatus(Request $request)
    {
        $toggle = ServiceSubcategory::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
