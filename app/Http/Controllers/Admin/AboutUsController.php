<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function index()
    {
        $about = AboutUs::latest()->get();
        return view('admin.about.index', compact('about'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable|image'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $data['image'] = $imageName;
        }

        AboutUs::create($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'About Us Created Successfully');
    }

    public function edit($id)
    {
        $about = AboutUs::findOrFail($id);
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = AboutUs::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $data['image'] = $imageName;
        }

        $about->update($data);

        return redirect()->route('admin.about.index')
            ->with('success', 'About Us Updated Successfully');
    }

    public function destroy($id)
    {
        $about = AboutUs::findOrFail($id);
        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', 'Deleted Successfully');
    }
}