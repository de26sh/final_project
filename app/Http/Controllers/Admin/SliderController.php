<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        $slider->status = $request->status ? 1 : 0;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            $slider->image = 'uploads/sliders/'.$filename;
        }

        $slider->save();

        return redirect()->route('admin.slider.index')->with('success','Slider Added Successfully');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $slider->title = $request->title;
        $slider->subtitle = $request->subtitle;
        $slider->description = $request->description;
        $slider->status = $request->status ? 1 : 0;

        if ($request->hasFile('image')) {

            if (File::exists(public_path($slider->image))) {
                File::delete(public_path($slider->image));
            }

            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/sliders'), $filename);
            $slider->image = 'uploads/sliders/'.$filename;
        }

        $slider->update();

        return redirect()->route('admin.slider.index')->with('success','Slider Updated Successfully');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (File::exists(public_path($slider->image))) {
            File::delete(public_path($slider->image));
        }

        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success','Slider Deleted Successfully');
    }
}