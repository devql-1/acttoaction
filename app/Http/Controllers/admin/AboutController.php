<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\AboutCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    //This method will show About listing
    public function index(){
        $aboutus = About::get();
        return view('backend.about_system.about.index',compact('aboutus'));
    }

    //This method will show about form for creating a listing
    public function create(){
        $about_categories = AboutCategory::where('status',1)->get();
        return view('backend.about_system.about.create',compact('about_categories'));
    }

    //This method will store a record of aboutus
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'category_id' => 'nullable|integer|exists:about_categories,id',
            'title'       => 'required|string|max:255',
            
        ]);

        if($validator->passes()){
            $create = new About();
            $create->category_id = $request->category_id ? $request->category_id : null; 
            $create->title = $request->title;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $create->description = $request->description;
            $create->description2 = $request->description2;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            }   

            $images = [];
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('img'), $filename);
                    $images[] = $filename;
                }
            }
        
            $create->multiple_images = json_encode($images);

            $create->save();

            return redirect()->route('admin.about')->with('success','About Us Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show about form for updating a listing
    public function edit($id){
        $edit = About::find($id);
        $about_categories = AboutCategory::where('status',1)->get();
        return view('backend.about_system.about.edit',compact('edit','about_categories'));
    }

    //This method will update a existing listing of aboutus
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = About::find($id);
            $update->category_id = $request->category_id;
            $update->title = $request->title;
            $update->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $update->description = $request->description;
            $update->description2 = $request->description2;

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

            $existingImages = $update->multiple_images ? json_decode($update->multiple_images, true) : [];

            // Remove images
            if ($request->has('remove_images')) {
                foreach ($request->remove_images as $removeImg) {
                    if (($key = array_search($removeImg, $existingImages)) !== false) {
                        unset($existingImages[$key]);
                        if (file_exists(public_path('img/' . $removeImg))) {
                            unlink(public_path('img/' . $removeImg));
                        }
                    }
                }
            }
        
            // Keep images
            $finalImages = $request->keep_images ?? [];
        
            // Add new uploaded images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $file) {
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('img'), $filename);
                    $finalImages[] = $filename;
                }
            }
        
            $update->multiple_images = json_encode($finalImages);
  

            $update->save();

            return redirect()->route('admin.about')->with('success','About Us Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id){
        About::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function about_toggleStatus(Request $request)
    {
        $toggle = About::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}