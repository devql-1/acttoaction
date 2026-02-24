<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    //This method will show Testimonial listing
    public function index(){
        $testimonials = Testimonial::get();
        return view('backend.testimonials.index',compact('testimonials'));
    }

    //This method will show testimonial form for creating a listing
    public function create(){
        return view('backend.testimonials.create');
    }

    //This method will store a record of testimonials
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'designation' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        if($validator->passes()){
            $create = new Testimonial();
            $create->name = $request->name;
            $create->designation = $request->designation;
            $create->message = $request->message;
            $create->rating = $request->rating;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            }   

            $create->save();

            return redirect()->route('admin.testimonial')->with('success','Testimonial Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show testimonial form for updating a listing
    public function edit($id){
        $testimonials = Testimonial::find($id);
        return view('backend.testimonials.edit',compact('testimonials'));
    }

    //This method will update a existing listing of testimonial
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'designation' => 'nullable|string|max:255',
            'message' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        if($validator->passes()){
            $update = Testimonial::find($id);
            $update->name = $request->name;
            $update->designation = $request->designation;
            $update->message = $request->message;
            $update->rating = $request->rating;

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

            return redirect()->route('admin.testimonial')->with('success','Testimonial Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        Testimonial::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function testimonial_toggleStatus(Request $request)
    {
        $toggle = Testimonial::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
