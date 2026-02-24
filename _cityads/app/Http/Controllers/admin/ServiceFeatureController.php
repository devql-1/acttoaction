<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceFeatureController extends Controller
{
    //This method will show listing a services features
    public function index(){
        $service_features = ServiceFeature::where('status',1)->get();
        return view('backend.service_system.features.index',compact('service_features'));
    }

    //This method will show listing a services features
    public function create(){
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.features.create',compact('service_info'));
    }

    //This method will store a record of services features
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceFeature();
            $create->service_id = $request->service_id;
            $create->title = $request->title;
            $create->icon = $request->icon;
            $create->description = $request->description;

            $create->save();

            return redirect()->route('admin.service-features')->with('success','Service Features Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show service features form for updating a listing
    public function edit($id){
        $service_features = ServiceFeature::find($id);
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.features.edit',compact('service_features','service_info'));
    }

    //This method will update a existing listing of service features
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceFeature::find($id);
            $update->service_id = $request->service_id;
            $update->title = $request->title;
            $update->icon = $request->icon;
            $update->description = $request->description;
            
  

            $update->save();

            return redirect()->route('admin.service-features')->with('success','Service Features Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceFeature::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceFeatures_toggleStatus(Request $request)
    {
        $toggle = ServiceFeature::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
