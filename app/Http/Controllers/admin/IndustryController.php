<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IndustryController extends Controller
{
    //This method will show listing for Industry
    public function index(){
        $industries = Industry::latest()->get();
        return view('backend.industry_system.industry.index',compact('industries'));
    }


    //This method will show form for creating a listing of industry
    public function create(){
        return view('backend.industry_system.industry.create');
    }


    //This method will store a record of industry
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new Industry();
            $create->title = $request->title;
            $create->subtitle = $request->subtitle;
            $create->subtitle2 = $request->subtitle2;
            $create->features_headings = $request->features_headings;
            $create->features_short_description = $request->features_short_description;
            $create->service_headings = $request->service_headings;
            $create->service_short_description = $request->service_short_description;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $create->short_description = $request->short_description;
            $create->description = $request->description;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            }   

            $create->save();

            return redirect()->route('admin.industry')->with('success','Industry Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show edit form for updating a listing
    public function edit($id){
        $industry = Industry::find($id);
        return view('backend.industry_system.industry.edit',compact('industry'));
    }

    //This method will update a existing listing of industry
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = Industry::find($id);
            $update->title = $request->title;
            $update->subtitle = $request->subtitle;
            $update->subtitle2 = $request->subtitle2;
            $update->features_headings = $request->features_headings;
            $update->features_short_description = $request->features_short_description;
            $update->service_headings = $request->service_headings;
            $update->service_short_description = $request->service_short_description;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $update->short_description = $request->short_description;
            $update->description = $request->description;

            if ($request->input('remove_image') == "1") {
                if ($update->image && file_exists(public_path('img/' . $update->image))) {
                    unlink(public_path('img/' . $update->image));
                }
                $update->image = null;
            }

            if ($request->hasFile('image')) {
                if ($update->image && file_exists(public_path('img/' . $update->image))) {
                    unlink(public_path('img/' . $update->image));
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $update->image = $filename;
            }
  

            $update->save();

            return redirect()->route('admin.industry')->with('success','Industry Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }


    //This method will destroy a particular listing
    public function destroy($id){
        Industry::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function Industry_toggleStatus(Request $request)
    {
        $toggle = Industry::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
