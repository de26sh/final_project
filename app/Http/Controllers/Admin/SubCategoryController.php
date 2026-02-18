<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->get();
        $categories = Category::all();

        return view('admin.sub-category.index', compact('subCategories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // return view('admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:categories,id',
            'sub_category_name' => 'required|unique:sub_categories,name',
            'sub_category_image' => 'nullable|image'
        ]);

        $imageName = null;

        if ($request->hasFile('sub_category_image')) {
            $imageName = time() . '.' . $request->sub_category_image->extension();
            $request->sub_category_image->move(public_path('uploads/sub_categories'), $imageName);
        }

        SubCategory::create([
            'category_id' => $request->category,
            'name' => $request->sub_category_name,
            'slug' => Str::slug($request->sub_category_name),
            'description' => $request->sub_category_description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Sub Category Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $categories = Category::all();

        return view(
            'admin.sub-category.edit',
            compact('subCategory', 'categories')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        $request->validate([
            'category' => 'required|exists:categories,id',
            'sub_category_name' => 'required|unique:sub_categories,name,' . $id,
            'sub_category_image' => 'nullable|image'
        ]);

        $imageName = $subCategory->image;

        if ($request->hasFile('sub_category_image')) {

            // Delete old image
            if ($subCategory->image && file_exists(public_path('uploads/sub_categories/' . $subCategory->image))) {
                unlink(public_path('uploads/sub_categories/' . $subCategory->image));
            }

            $imageName = time() . '.' . $request->sub_category_image->extension();
            $request->sub_category_image->move(public_path('uploads/sub_categories'), $imageName);
        }

        $subCategory->update([
            'category_id' => $request->category,
            'name' => $request->sub_category_name,
            'slug' => Str::slug($request->sub_category_name),
            'description' => $request->sub_category_description,
            'image' => $imageName
        ]);

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Sub Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);

        if ($subCategory->image && file_exists(public_path('uploads/sub_categories/' . $subCategory->image))) {
            unlink(public_path('uploads/sub_categories/' . $subCategory->image));
        }

        $subCategory->delete();

        return redirect()->route('admin.sub-category.index')
            ->with('success', 'Sub Category Deleted Successfully');
    }
}
