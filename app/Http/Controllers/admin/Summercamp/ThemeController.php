<?php
// app/Http/Controllers/ThemeController.php
namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    // ADMIN LIST
    public function adminIndex()
    {
        $themes = Theme::orderBy('sort_order')->get();
        return view('backend.Summercamp.Theme.index', compact('themes'));
    }

    // CREATE FORM
    public function create()
    {
        return view('backend.Summercamp.Theme.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Theme::create($request->all());

        return redirect()->route('themes.index')->with('success', 'Theme Added');
    }

    // EDIT FORM
    public function edit($id)
    {
        $theme = Theme::findOrFail($id);
        return view('backend.Summercamp.Theme.edit', compact('theme'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $theme = Theme::findOrFail($id);

        $theme->update($request->all());

        return redirect()->route('themes.index')->with('success', 'Theme Updated');
    }

    // DELETE
    public function destroy($id)
    {
        Theme::findOrFail($id)->delete();
        return back()->with('success', 'Theme Deleted');
    }
}
