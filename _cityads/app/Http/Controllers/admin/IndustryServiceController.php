<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustryServiceController extends Controller
{
    //This method will show listing a Industry services
    public function index(){
        $industry_service = IndustryService::where('status',1)->get();
        return view('backend.industry_system.industry-service.index',compact('industry_service'));
    }

    //This method will show listing a industry services
    public function create(){
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-service.create',compact('industry_info'));
    }

    //This method will store a record of industry services
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new IndustryService();
            $create->industry_id = $request->industry_id;
            $create->title = $request->title;
            $create->icon = $request->icon;
            $create->short_description = $request->short_description;

            $create->save();

            return redirect()->route('admin.industry-service')->with('success','Industry Service Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show industry service form for updating a listing
    public function edit($id){
        $industry_service = IndustryService::find($id);
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-service.edit',compact('industry_service','industry_info'));
    }

    //This method will update a existing listing of industry service
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = IndustryService::find($id);
            $update->industry_id = $request->industry_id;
            $update->title = $request->title;
            $update->icon = $request->icon;
            $update->short_description = $request->short_description;
            
  

            $update->save();

            return redirect()->route('admin.industry-service')->with('success','Industry Service Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        IndustryService::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function industryService_toggleStatus(Request $request)
    {
        $toggle = IndustryService::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
