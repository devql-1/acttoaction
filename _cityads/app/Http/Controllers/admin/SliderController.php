<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    //This method will show slider listing
    public function index(){
        $sliders = Slider::get();
        return view('backend.slider.slider',compact('sliders'));
    }

    // This method store data in database 
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            // 'title' => 'required',
            // 'short_desc' => 'required',
            // 'banner' => 'required|image'
        ]);

        if($validator->passes()){
            $create = Slider::create();
            $create->title = $request->title;
            $create->short_desc = $request->short_desc;

            if ($request->has('add_remove_image') && $request->add_remove_image == 1) {
                $create->banner = null;
            } elseif ($request->hasFile('banner')) {
                $filename = time().'.'.$request->banner->extension();
                $request->banner->move(public_path('img'), $filename);
                $create->banner = $filename;
            }   

            $create->save();

            return redirect()->route('admin.slider')->with('success','Slider Data Added Successfully');
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    // This method store data in database 
    public function update(Request $request){

        $validator = Validator::make($request->all(),[
            
        ]);

        if($validator->passes()){
            $update = Slider::find($request->id);
            $update->title = $request->title;
            $update->short_desc = $request->short_desc;

            if ($request->has('remove_image') && $request->remove_image == 1) {
                $update->banner = null;
            } elseif ($request->hasFile('banner')) {
                $filename = time().'.'.$request->banner->extension();
                $request->banner->move(public_path('img'), $filename);
                $update->banner = $filename;
            }
   

            $update->save();

            return redirect()->route('admin.slider')->with('success','Slider Data Updated Successfully');
        }else{
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    public function destroy($id){
        $destroy = Slider::where('id',$id)->delete();
        return response()->json(['success' => true]);
    }

    public function slider_toggleStatus(Request $request)
    {
        $toggle = Slider::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }






}
