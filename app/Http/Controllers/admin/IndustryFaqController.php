<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustryFaqController extends Controller
{
    //This method will show listing a industry faq
    public function index(){
        $industry_faq = IndustryFaq::where('status',1)->get();
        return view('backend.industry_system.industry-faq.index',compact('industry_faq'));
    }

    //This method will show listing a industry faq
    public function create(){
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-faq.create',compact('industry_info'));
    }

    //This method will store a record of industry faq
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'question' => 'required',
        ]);

        if($validator->passes()){
            $create = new IndustryFaq();
            $create->industry_id = $request->industry_id;
            $create->question = $request->question;
            $create->answer = $request->answer;

            $create->save();

            return redirect()->route('admin.industry-faq')->with('success','Industry Faq Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show industry faq form for updating a listing
    public function edit($id){
        $industry_faq = IndustryFaq::find($id);
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-faq.edit',compact('industry_faq','industry_info'));
    }

    //This method will update a existing listing of industry faq
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'question' => 'required',
        ]);

        if($validator->passes()){
            $update = IndustryFaq::find($id);
            $update->industry_id = $request->industry_id;
            $update->question = $request->question;
            $update->answer = $request->answer;
            
  

            $update->save();

            return redirect()->route('admin.industry-faq')->with('success','Industry Faq Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        IndustryFaq::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function industryFaq_toggleStatus(Request $request)
    {
        $toggle = IndustryFaq::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
