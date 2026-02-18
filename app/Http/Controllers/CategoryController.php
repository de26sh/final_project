<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::latest()->get();
        return view('admin.category.index', compact('category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        Category::create([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category Created Successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $imageName = $category->image;

        if ($request->hasFile('image')) {

            // delete old image
            if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
                unlink(public_path('uploads/categories/' . $category->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/categories'), $imageName);
        }

        $category->update([
            'name' => $request->category_name,
            'slug' => Str::slug($request->category_name),
            'description' => $request->description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category Updated Successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->image && file_exists(public_path('uploads/categories/' . $category->image))) {
            unlink(public_path('uploads/categories/' . $category->image));
        }

        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category Deleted Successfully');
    }
}