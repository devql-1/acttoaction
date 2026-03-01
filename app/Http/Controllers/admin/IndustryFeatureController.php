<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use App\Models\IndustryFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustryFeatureController extends Controller
{
    //This method will show listing a Industry features
    public function index(){
        $industry_features = IndustryFeature::where('status',1)->get();
        return view('backend.industry_system.industry-features.index',compact('industry_features'));
    }

    //This method will show listing a industry features
    public function create(){
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-features.create',compact('industry_info'));
    }

    //This method will store a record of industry features
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'short_description' => 'nullable'
        ]);

        if($validator->passes()){
            $create = new IndustryFeature();
            $create->industry_id = $request->industry_id;
            $create->title = $request->title;
            $create->icon = $request->icon;
            $create->description = $request->description;

            $create->save();

            return redirect()->route('admin.industry-features')->with('success','Industry Features Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will show industry features form for updating a listing
    public function edit($id){
        $industry_features = IndustryFeature::find($id);
        $industry_info = Industry::where('status',1)->get();
        return view('backend.industry_system.industry-features.edit',compact('industry_features','industry_info'));
    }

    //This method will update a existing listing of industry features
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'nullable' => 'nullable'
        ]);

        if($validator->passes()){
            $update = IndustryFeature::find($id);
            $update->industry_id = $request->industry_id;
            $update->title = $request->title;
            $update->icon = $request->icon;
            $update->description = $request->description;
            
  

            $update->save();

            return redirect()->route('admin.industry-features')->with('success','Industry Features Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        IndustryFeature::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function industryFeatures_toggleStatus(Request $request)
    {
        $toggle = IndustryFeature::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
