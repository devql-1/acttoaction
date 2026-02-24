<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    //This method will show listing for service post
    public function index(){
        $services = Service::latest()->get();
        return view('backend.service_system.service.index',compact('services'));
    }

    // This method will get sub categories
    public function serviceSubcategories(Request $request)
    {
        $service_subcategories = ServiceSubcategory::where('category_id', $request->category_id)
            ->where('status', 1)
            ->get();

        return response()->json($service_subcategories);
    }


    //This method will show form for creating a listing of service
    public function create(){
        $service_categories = ServiceCategory::where('status',1)->get();
        return view('backend.service_system.service.create',compact('service_categories'));
    }


    //This method will store a record of service
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $create = new Service();
            $create->title = $request->title;
            $create->advantages = $request->advantages;
            $create->eligibility = $request->eligibility;
            $create->category_id = $request->category_id;
            $create->subcategory_id = $request->subcategory_id;
            $create->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
            $create->short_description = $request->short_description;
            $create->description = $request->description;

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

            return redirect()->route('admin.service')->with('success','Service Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show edit form for updating a listing
    public function edit($id){
        $service = Service::find($id);
        $service_categories = ServiceCategory::where('status',1)->get();
        return view('backend.service_system.service.edit',compact('service','service_categories'));
    }

    //This method will update a existing listing of service
    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
        ]);

        if($validator->passes()){
            $update = Service::find($id);
            $update->title = $request->title;
            $update->advantages = $request->advantages;
            $update->eligibility = $request->eligibility;
            $update->category_id = $request->category_id;
            $update->subcategory_id = $request->subcategory_id;
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

            return redirect()->route('admin.service')->with('success','Service Data Updated Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }


    //This method will destroy a particular listing
    public function destroy($id){
        Service::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function service_toggleStatus(Request $request)
    {
        $toggle = Service::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
