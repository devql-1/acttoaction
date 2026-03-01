<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    //This method will show listing for brands
    public function index(){
        $brands = Brand::get();
        return view('backend.brands.index',compact('brands'));
    }

    //This method will store a record of brands
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'brand_name' => 'required',
        ]);

        if($validator->passes()){
            $create = new Brand();
            $create->brand_name = $request->brand_name;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            } 
            

            $create->save();

            return redirect()->back()->with('success','Brand Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show brands form for updating a listing
    public function edit($id){
        $brands = Brand::find($id);
        return view('backend.brands.edit',compact('brands'));
    }

    //This method will update a existing listing of brands
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'brand_name' => 'required',
        ]);

        if($validator->passes()){
            $update = Brand::find($id);
            $update->brand_name = $request->brand_name;

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

            return redirect()->route('admin.brands')->with('success','Brand Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        Brand::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function brands_toggleStatus(Request $request)
    {
        $toggle = Brand::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
