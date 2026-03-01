<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceEssential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceEssentialController extends Controller
{
    //This method will show listing a services essentials
    public function index(){
        $service_essentials = ServiceEssential::where('status',1)->get();
        return view('backend.service_system.essentials.index',compact('service_essentials'));
    }

    //This method will show listing a services essentials
    public function create(){
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.essentials.create',compact('service_info'));
    }

    //This method will store a record of services essentials
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceEssential();
            $create->service_id = $request->service_id;
            $create->title = $request->title;
            $create->icon = $request->icon;
            $create->description = $request->description;

            $create->save();

            return redirect()->route('admin.service-essentials')->with('success','Service Essentials Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show service essentials form for updating a listing
    public function edit($id){
        $service_essentials = ServiceEssential::find($id);
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.essentials.edit',compact('service_essentials','service_info'));
    }

    //This method will update a existing listing of service essentials
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceEssential::find($id);
            $update->service_id = $request->service_id;
            $update->title = $request->title;
            $update->icon = $request->icon;
            $update->description = $request->description;
            
  

            $update->save();

            return redirect()->route('admin.service-essentials')->with('success','Service Essentials Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceEssential::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceEssentials_toggleStatus(Request $request)
    {
        $toggle = ServiceEssential::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
