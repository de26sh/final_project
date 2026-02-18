<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Str;

class FamilyController extends Controller
{
    public function index()
    {
        $families = Family::latest()->get();
        return view('admin.family.index', compact('families'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'family_name' => 'required|unique:families,name',
            'family_description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/families'), $imageName);
        }

        Family::create([
            'name' => $request->family_name,
            'description' => $request->family_description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.family.index')
            ->with('success', 'Product Family Created Successfully');
    }

    public function edit(Family $family)
    {
        return view('admin.family.edit', compact('family'));
    }

    public function update(Request $request, $id)
    {
        $family = Family::findOrFail($id);

        $request->validate([
            'family_name' => 'required|unique:families,name,' . $family->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imageName = $family->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($family->image && file_exists(public_path('uploads/families/' . $family->image))) {
                unlink(public_path('uploads/families/' . $family->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/families'), $imageName);
        }

        $family->update([
            'name' => $request->family_name,
            'slug' => Str::slug($request->family_name),
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.family.index')
            ->with('success', 'Family Updated Successfully');
    }

    public function destroy(Family $family)
    {
        if ($family->image && file_exists(public_path('uploads/families/' . $family->image))) {
            unlink(public_path('uploads/families/' . $family->image));
        }

        $family->delete();

        return redirect()->route('admin.family.index')
            ->with('success', 'Product Family Deleted Successfully');
    }
}
