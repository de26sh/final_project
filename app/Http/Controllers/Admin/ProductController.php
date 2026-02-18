<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display listing
     */
    public function index()
    {
        $products = Product::with(['category','subCategory','family','images'])
                            ->latest()
                            ->get();

        return view('admin.product.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::all();
        $families = Family::all();

        return view('admin.product.create', compact('categories','families'));
    }

    /**
     * Store product
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::create($request->except('images'));

        // Multiple Image Upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        return redirect()->route('admin.product.index')
                         ->with('success','Product Created Successfully');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::all();
        $families = Family::all();
        $subcategories = SubCategory::where('category_id', $product->category_id)->get();

        return view('admin.product.edit', compact(
            'product',
            'categories',
            'families',
            'subcategories'
        ));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product->update($request->except('images'));

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                $path = $image->store('products', 'public');

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }
        dd("Here");
        return redirect()->route('admin.product.index')
                         ->with('success','Product Updated Successfully');
    }

    /**
     * Delete product
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete related images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')
                         ->with('success','Product Deleted Successfully');
    }

    /**
     * AJAX Subcategory
     */
    public function getSubCategories($id)
    {
        $subcategories = SubCategory::where('category_id', $id)->get();
        return response()->json($subcategories);
    }

    public function deleteImage($id)
{
    $image = ProductImage::findOrFail($id);

    // delete file from storage
    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    // delete database record
    $image->delete();

    return back()->with('success', 'Image Deleted Successfully');
}
}
