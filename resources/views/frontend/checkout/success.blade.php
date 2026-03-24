@extends('frontend.layout.app')
@section('content')
<div class="container pt-100px pb-100px">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 text-center">
            <div style="border: 1px solid #e8e8e8; border-radius: 8px; padding: 50px 40px;">
                
                <div style="font-size: 60px; margin-bottom: 20px;">🎉</div>
                
                <h2 style="color: #2c2c2c; font-size: 28px; font-weight: 700; margin-bottom: 15px;">
                    Order Placed Successfully!
                </h2>
                
                <p style="color: #666; font-size: 15px; margin-bottom: 8px;">
                    Thank you, <strong>{{ $order->customer->first_name }}</strong>! 
                    Your order for <strong>{{ $order->product->name }}</strong> 
                    (x{{ $order->quantity }}) has been received.
                </p>
                
                <p style="color: #666; font-size: 15px; margin-bottom: 30px;">
                    Total: <strong>₹ {{ number_format($order->total_price, 2) }}</strong> 
                    &mdash; Cash on Delivery
                </p>

                <hr style="margin-bottom: 30px; border-color: #e8e8e8;">

                <a href="{{ url('/') }}" class="btn-hover" 
                   style="padding: 14px 40px; font-size: 15px; font-weight: 600; 
                          letter-spacing: 1px; display: inline-block; background-color: var(--bs-orange); color:white">
                    Continue Shopping
                </a>

            </div>
        </div>
    </div>
</div>
@endsection