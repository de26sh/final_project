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
use Razorpay\Api\Api;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $families = Family::all();
        $products = Product::where('status', 'published')
            ->orderBy('created_at', 'desc')->limit(9)->get();

        return view('frontend.index', compact('sliders', 'families', 'products'));
    }

    public function productDetail($id)
    {
        $product = Product::where('status', 'published')
            ->with(['category', 'subcategory', 'family', 'images'])
            ->findOrFail(Crypt::decrypt($id));

        return view('frontend.product-detail', compact('product'));
    }

    public function familyProducts($id)
    {
        $family = Family::findOrFail($id);
        $products = Product::where('family_id', $id)->with('images')->get();

        return view('frontend.family-products', compact('family', 'products'));
    }

    public function about_us()
    {
        return view('frontend.aboutus');
    }

    public function categoryProducts($id)
    {
        $category = Category::findOrFail($id);
        $products = Product::where('category_id', $id)->with('images')->get();

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
        $total = $product->price * $quantity;

        return view('frontend.checkout.index', compact('product', 'quantity', 'total', 'p_id'));
    }

    // ─── Shared helper: save/update customer ──────────────────────────────────
    private function resolveCustomer(Request $request): Customer
    {
        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'address_line1' => $request->address_line1,
            'address_line2' => $request->address_line2,
            'city' => $request->city,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'ship_to_different' => $request->has('ship_to_different'),
        ];

        if ($request->has('ship_to_different')) {
            $data = array_merge($data, [
                'shipping_first_name' => $request->shipping_first_name,
                'shipping_last_name' => $request->shipping_last_name,
                'shipping_company_name' => $request->shipping_company_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_country' => $request->shipping_country,
                'shipping_address_line1' => $request->shipping_address_line1,
                'shipping_address_line2' => $request->shipping_address_line2,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_postcode' => $request->shipping_postcode,
            ]);
        }

        $customer = Customer::where('email', $request->email)->first();

        return $customer
            ? tap($customer)->update($data)
            : Customer::create($data);
    }

    // ─── Shared validation rules ──────────────────────────────────────────────
    private function orderValidationRules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'country' => 'required|string',
            'address_line1' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postcode' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'product_id' => 'required|exists:products,id',
        ];
    }

    // ─── COD: Place Order ─────────────────────────────────────────────────────
    public function place_order(Request $request)
    {
        $request->validate($this->orderValidationRules());
 
        $product    = Product::findOrFail($request->product_id);
        $quantity   = $request->quantity;
        $unitPrice  = $product->price;
        $totalPrice = $unitPrice * $quantity;
 
        $customer = $this->resolveCustomer($request);
 
        $order = Order::create([
            'order_number'   => Order::generateOrderNumber(),
            'product_id'     => $product->id,
            'customer_id'    => $customer->id,
            'quantity'       => $quantity,
            'unit_price'     => $unitPrice,
            'total_price'    => $totalPrice,
            'payment_method' => 'cod',
            'status'         => 'pending',
            'notes'          => $request->notes,
        ]);
 
        // ✉️ Send confirmation email
        Mail::to($customer->email)->send(new OrderConfirmed($order->load('product', 'customer')));
 
        return redirect()
            ->route('frontend.order.success', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    // ─── Razorpay Step 1: Create Razorpay Order ───────────────────────────────
    public function razorpay_create_order(Request $request)
    {
        $request->validate($this->orderValidationRules());

        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalPrice = $product->price * $quantity;

        // Create Razorpay order (amount in paise)
        $api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );

        $razorpayOrder = $api->order->create([
            'receipt' => 'rcpt_' . time(),
            'amount' => (int) ($totalPrice * 100), // paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        // Save all form data in session for after payment
        $request->session()->put('razorpay_checkout', $request->all());
        $request->session()->put('razorpay_order_id', $razorpayOrder->id);

        return response()->json([
            'razorpay_order_id' => $razorpayOrder->id,
            'amount' => (int) ($totalPrice * 100),
            'currency' => 'INR',
            'key_id' => config('services.razorpay.key_id'),
            'name' => $product->name,
            'customer_name' => $request->first_name . ' ' . $request->last_name,
            'customer_email' => $request->email,
            'customer_phone' => $request->phone,
        ]);
    }

    // ─── Razorpay Step 2: Verify Payment & Save Order ────────────────────────
    public function razorpay_verify_payment(Request $request)
    {
        $request->validate([
            'razorpay_order_id'  => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
        ]);
 
        $api = new Api(
            config('services.razorpay.key_id'),
            config('services.razorpay.key_secret')
        );
 
        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed.'], 422);
        }
 
        $checkoutData = session('razorpay_checkout');
 
        if (! $checkoutData) {
            return response()->json(['success' => false, 'message' => 'Session expired.'], 422);
        }
 
        $product    = Product::findOrFail($checkoutData['product_id']);
        $quantity   = $checkoutData['quantity'];
        $unitPrice  = $product->price;
        $totalPrice = $unitPrice * $quantity;
 
        $fakeRequest = new Request($checkoutData);
        $customer    = $this->resolveCustomer($fakeRequest);
 
        $order = Order::create([
            'order_number'     => Order::generateOrderNumber(),
            'product_id'       => $product->id,
            'customer_id'      => $customer->id,
            'quantity'         => $quantity,
            'unit_price'       => $unitPrice,
            'total_price'      => $totalPrice,
            'payment_method'   => 'razorpay',
            'status'           => 'confirmed',
            'notes'            => $checkoutData['notes'] ?? null,
            'razorpay_order_id' => $request->razorpay_order_id,
            'payment_id'       => $request->razorpay_payment_id,
        ]);
 
        // ✉️ Send confirmation email
        Mail::to($customer->email)->send(new OrderConfirmed($order->load('product', 'customer')));
 
        session()->forget(['razorpay_checkout', 'razorpay_order_id']);
 
        return response()->json([
            'success'  => true,
            'redirect' => route('frontend.order.success', $order->id),
        ]);
    }
}
