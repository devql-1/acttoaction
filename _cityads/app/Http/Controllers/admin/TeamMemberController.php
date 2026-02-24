<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamMemberController extends Controller
{
    //This method will show TeamMembers listing
    public function index(){
        $team_members = TeamMember::get();
        return view('backend.team_members.index',compact('team_members'));
    }

    //This method will show TeamMembers form for creating a listing
    public function create(){
        return view('backend.team_members.create');
    }

    //This method will store a record of TeamMembers
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'designation' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string',
            'facebook_url' => 'nullable|string',
            'twitter_url' => 'nullable|string',
            'linkedin_url' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp'
        ]);

        if($validator->passes()){
            $create = new TeamMember();
            $create->name = $request->name;
            $create->designation = $request->designation;
            $create->instagram_url = $request->instagram_url;
            $create->facebook_url = $request->facebook_url;
            $create->twitter_url = $request->twitter_url;
            $create->linkedin_url = $request->linkedin_url;

            if ($request->hasFile('image')) {
                $filename = time().'.'.$request->image->extension();
                $request->image->move(public_path('img'), $filename);
                $create->image = $filename;
            }   

            $create->save();

            return redirect()->route('admin.team_members')->with('success','Team Members Data Added Successfully');
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }

        
    }

    //This method will show TeamMembers form for updating a listing
    public function edit($id){
        $team_members = TeamMember::find($id);
        return view('backend.team_members.edit',compact('team_members'));
    }

    //This method will update a existing listing of TeamMembers
  public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'designation'   => 'nullable|string|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url'  => 'nullable|url|max:255',
            'twitter_url'   => 'nullable|url|max:255',
            'linkedin_url'  => 'nullable|url|max:255',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'add_social'    => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $update = TeamMember::findOrFail($id);

        $update->name        = $request->name;
        $update->designation = $request->designation;

        // ✅ Agar checkbox tick hai → values save karo
        if ($request->has('add_social')) {
            $update->instagram_url = $request->instagram_url;
            $update->facebook_url  = $request->facebook_url;
            $update->twitter_url   = $request->twitter_url;
            $update->linkedin_url  = $request->linkedin_url;
        } else {
            // ✅ Agar checkbox unchecked hai → sab null save karo
            $update->instagram_url = null;
            $update->facebook_url  = null;
            $update->twitter_url   = null;
            $update->linkedin_url  = null;
        }

        // ✅ Image Remove
        if ($request->input('remove_image') == "1") {
            if ($update->image && file_exists(public_path('img/' . $update->image))) {
                unlink(public_path('img/' . $update->image));
            }
            $update->image = null;
        }

        // ✅ New Image Upload
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

        return redirect()->route('admin.team_members')->with('success', 'Team Members Data Updated Successfully');
    }


    //This method will destroy a particular listing
    public function destroy($id){
        TeamMember::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function teammembers_toggleStatus(Request $request)
    {
        $toggle = TeamMember::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
