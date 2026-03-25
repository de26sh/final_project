<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
    /**
     * Show the tracking form page.
     */
    public function index()
    {
        return view('frontend.track-order');
    }

    /**
     * Look up an order by order_number + customer email.
     */
    public function track(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'email'        => 'required|email',
        ]);

        $order = Order::with(['product', 'customer'])
            ->where('order_number', strtoupper(trim($request->order_number)))
            ->whereHas('customer', function ($q) use ($request) {
                $q->where('email', strtolower(trim($request->email)));
            })
            ->first();

        if (! $order) {
            return back()
                ->withInput()
                ->withErrors(['not_found' => 'No order found with those details. Please check and try again.']);
        }

        return view('frontend.track-order', compact('order'));
    }
}