<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceBenefitController extends Controller
{
    //This method will show listing a services benefits
    public function index(){
        $service_benefits = ServiceBenefit::where('status',1)->get();
        return view('backend.service_system.benefits.index',compact('service_benefits'));
    }

    //This method will show listing a services benefits
    public function create(){
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.benefits.create',compact('service_info'));
    }

    //This method will store a record of services benefits
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceBenefit();
            $create->service_id = $request->service_id;
            $create->title = $request->title;
            $create->icon = $request->icon;
            $create->description = $request->description;

            $create->save();

            return redirect()->route('admin.service-benefits')->with('success','Service Benefits Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show service benefits form for updating a listing
    public function edit($id){
        $service_benefits = ServiceBenefit::find($id);
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.benefits.edit',compact('service_benefits','service_info'));
    }

    //This method will update a existing listing of service benefits
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceBenefit::find($id);
            $update->service_id = $request->service_id;
            $update->title = $request->title;
            $update->icon = $request->icon;
            $update->description = $request->description;
            
  

            $update->save();

            return redirect()->route('admin.service-benefits')->with('success','Service Benefits Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceBenefit::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceBenefits_toggleStatus(Request $request)
    {
        $toggle = ServiceBenefit::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
