<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use App\Models\YoutubeCategory;
use Illuminate\Http\Request;
  use Illuminate\Support\Str;

class YoutubeCategoryController extends Controller{


    public function index(){

        $youtubeCategories = YoutubeCategory::all();
        return view('backend.youtube_categories.index', compact('youtubeCategories'));
    }

    public function create(){
        return view('backend.youtube_categories.create');
    }


public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:youtube_categories,name'
    ]);

    YoutubeCategory::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name)
    ]);

    return redirect()->route('youtubeCategory.index')->with('success', 'Category Created Successfully');
}


    public function edit($id){
    $youtubeCategory = YoutubeCategory::findOrFail($id);

    return view('backend.youtube_categories.edit', compact('youtubeCategory'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required',
        'slug' => 'required|unique:youtube_categories,slug,' . $id
    ]);

    $youtubeCategory = YoutubeCategory::findOrFail($id);

    $youtubeCategory->update([
        'name' => $request->name,
        'slug' => $request->slug
    ]);

    return redirect()->route('youtubeCategory.index')->with('success', 'Youtube Category Updated Successfully');
}

public function destroy($id){
    $youtubeCategory = YoutubeCategory::findOrFail($id);
    $youtubeCategory->delete();

    return redirect()->route('youtubeCategory.index')->with('success', 'Youtube Category Deleted Successfully');
}
}