<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceFaqController extends Controller
{
    //This method will show listing a services faq
    public function index(){
        $service_faq = ServiceFaq::where('status',1)->get();
        return view('backend.service_system.faq.index',compact('service_faq'));
    }

    //This method will show listing a services faq
    public function create(){
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.faq.create',compact('service_info'));
    }

    //This method will store a record of services faq
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'question' => 'required',
        ]);

        if($validator->passes()){
            $create = new ServiceFaq();
            $create->service_id = $request->service_id;
            $create->question = $request->question;
            $create->answer = $request->answer;

            $create->save();

            return redirect()->route('admin.service-faq')->with('success','Service Faq Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show service faq form for updating a listing
    public function edit($id){
        $service_faq = ServiceFaq::find($id);
        $service_info = Service::where('status',1)->get();
        return view('backend.service_system.faq.edit',compact('service_faq','service_info'));
    }

    //This method will update a existing listing of service faq
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'question' => 'required',
        ]);

        if($validator->passes()){
            $update = ServiceFaq::find($id);
            $update->service_id = $request->service_id;
            $update->question = $request->question;
            $update->answer = $request->answer;
            
  

            $update->save();

            return redirect()->route('admin.service-faq')->with('success','Service Faq Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        ServiceFaq::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function serviceFaq_toggleStatus(Request $request)
    {
        $toggle = ServiceFaq::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
