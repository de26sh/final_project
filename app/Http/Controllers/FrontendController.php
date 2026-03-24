<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Family;
use App\Models\Order;
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
    public function contact_us()
    {
        return view('frontend.contact-us');
    }

    public function product_checkout($p_id)
    {
        $product = Product::where('status', 'published')
            ->with(['category', 'images'])
            ->findOrFail(Crypt::decrypt($p_id));

        $quantity = request('qty', 1);
        $total    = $product->price * $quantity;

        return view('frontend.checkout.index', compact('product', 'quantity', 'total', 'p_id'));
    }
    public function place_order(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'email'         => 'required|email',
            'phone'         => 'required|string|max:20',
            'country'       => 'required|string',
            'address_line1' => 'required|string',
            'city'          => 'required|string',
            'state'         => 'required|string',
            'postcode'      => 'required|string',
            'quantity'      => 'required|integer|min:1',
            'product_id'    => 'required|exists:products,id',
        ]);

        $product    = Product::findOrFail($request->product_id);
        $quantity   = $request->quantity;
        $unitPrice  = $product->price;
        $totalPrice = $unitPrice * $quantity;

        // Create order
        $order = Order::create([
            'product_id'     => $product->id,
            'quantity'       => $quantity,
            'unit_price'     => $unitPrice,
            'total_price'    => $totalPrice,
            'payment_method' => 'cod',
            'status'         => 'pending',
            'notes'          => $request->notes,
        ]);

        // Create customer
        $customerData = $request->only([
            'first_name',
            'last_name',
            'company_name',
            'email',
            'phone',
            'country',
            'address_line1',
            'address_line2',
            'city',
            'state',
            'postcode',
        ]);
        $customerData['order_id']           = $order->id;
        $customerData['ship_to_different']  = $request->has('ship_to_different');

        if ($request->has('ship_to_different')) {
            $customerData = array_merge($customerData, $request->only([
                'shipping_first_name',
                'shipping_last_name',
                'shipping_company_name',
                'shipping_email',
                'shipping_phone',
                'shipping_country',
                'shipping_address_line1',
                'shipping_address_line2',
                'shipping_city',
                'shipping_state',
                'shipping_postcode',
            ]));
        }

        Customer::create($customerData);

        return redirect()->route('frontend.order.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }
}
