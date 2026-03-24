<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $families = Family::all();
        $products = Product::where('status', 'published')->orderBy('created_at', 'desc')->limit(9)->get();

        return view('frontend.index', compact('sliders', 'families', 'products'));
    }

    //  OUTSIDE index function
    public function productDetail($id)
    {
        $product = Product::where('status', 'published')->with(['category', 'subcategory', 'family', 'images'])
            ->findOrFail(Crypt::decrypt($id));
        // dd($product);
        return view('frontend.product-detail', compact('product'));
    }

    public function familyProducts($id)
    {
        $family = Family::findOrFail($id);

        $products = Product::where('family_id', $id)
            ->with('images')
            ->get();

        return view('frontend.family-products', compact('family', 'products'));
    }
    public function about_us()
    {
        return view('frontend.aboutus');
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);

        $products = Product::where('category_id', $id)
            ->with('images')
            ->get();

        return view('frontend.category-products', compact('category', 'products'));
    }
    public function contact_us(){
        return view('frontend.contact-us');
    }
}
