@extends('frontend.layout.app')

@section('title', 'Track Your Order')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Outfit:wght@300;400;500;600&display=swap');

  :root {
    --ink:    #0f0f0f;
    --muted:  #6b7280;
    --faint:  #f3f1ed;
    --white:  #ffffff;
    --green:  #a8e063;
    --card-radius: 20px;
    --font-display: 'Playfair Display', Georgia, serif;
    --font-body:    'Outfit', sans-serif;
  }

  .track-page {
    font-family: var(--font-body);
    background: var(--faint);
    min-height: 100vh;
    padding: 60px 20px 100px;
  }

  /* ── Hero ── */
  .track-hero { text-align: center; margin-bottom: 48px; }

  .track-hero .eyebrow {
    display: inline-block;
    font-size: 11px; font-weight: 600;
    letter-spacing: 2.5px; text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 14px;
    background: #e8e4de;
    padding: 6px 16px; border-radius: 100px;
  }

  .track-hero h1 {
    font-family: var(--font-display);
    font-size: clamp(36px, 6vw, 60px);
    color: var(--ink); line-height: 1.1; margin-bottom: 16px;
  }

  .track-hero p {
    font-size: 16px; color: var(--muted);
    max-width: 420px; margin: 0 auto; line-height: 1.6;
  }

  /* ── Form Card ── */
  .track-form-card {
    max-width: 520px; margin: 0 auto 48px;
    background: var(--white);
    border-radius: var(--card-radius);
    padding: 40px;
    box-shadow: 0 4px 40px rgba(0,0,0,.07);
  }

  .form-group { margin-bottom: 20px; }

  .form-group label {
    display: block;
    font-size: 12px; font-weight: 600;
    letter-spacing: 1px; text-transform: uppercase;
    color: var(--muted); margin-bottom: 8px;
  }

  .form-group input {
    width: 100%; padding: 14px 18px;
    border: 1.5px solid #e5e0d8; border-radius: 10px;
    font-family: var(--font-body); font-size: 15px; color: var(--ink);
    background: #faf9f7; outline: none;
    transition: border-color .2s, box-shadow .2s;
    box-sizing: border-box;
  }

  .form-group input:focus {
    border-color: var(--ink);
    box-shadow: 0 0 0 3px rgba(15,15,15,.06);
    background: #fff;
  }

  .form-group input::placeholder { color: #bbb; }

  .track-error {
    background: #fff0f0; border: 1px solid #fca5a5;
    border-radius: 10px; padding: 12px 16px;
    font-size: 13px; color: #991b1b;
    margin-bottom: 20px; display: flex; align-items: center; gap: 8px;
  }

  .field-error { color: #dc2626; font-size: 12px; margin-top: 6px; }

  .btn-track {
    width: 100%; padding: 15px;
    background: var(--ink); color: #fff;
    border: none; border-radius: 10px;
    font-family: var(--font-body); font-size: 15px; font-weight: 600;
    cursor: pointer; letter-spacing: 0.5px;
    transition: transform .15s, box-shadow .15s;
  }

  .btn-track:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(0,0,0,.15); }
  .btn-track:active { transform: translateY(0); }

  /* ── Result ── */
  .result-wrap {
    max-width: 660px; margin: 0 auto;
    animation: slideUp .4s ease both;
  }

  @keyframes slideUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Order Header */
  .order-header {
    background: var(--ink);
    border-radius: var(--card-radius) var(--card-radius) 0 0;
    padding: 36px 40px; color: #fff;
    display: flex; justify-content: space-between;
    align-items: flex-start; flex-wrap: wrap; gap: 16px;
  }

  .ord-label {
    font-size: 11px; font-weight: 600;
    letter-spacing: 2px; text-transform: uppercase;
    opacity: .55; margin-bottom: 6px;
  }

  .ord-number {
    font-family: var(--font-display);
    font-size: 26px; letter-spacing: -0.5px;
  }

  .ord-date { font-size: 13px; opacity: .55; margin-top: 6px; }

  .status-pill {
    display: inline-flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 600;
    padding: 8px 18px; border-radius: 100px; letter-spacing: 0.5px;
  }

  .pill-dot { width: 8px; height: 8px; border-radius: 50%; background: currentColor; opacity: .8; }

  .pill-pending   { background: #fff3cd; color: #92650a; }
  .pill-confirmed { background: #d1fae5; color: #065f46; }
  .pill-shipped   { background: #dbeafe; color: #1e40af; }
  .pill-delivered { background: #a8e063; color: #1e3a00; }
  .pill-cancelled { background: #fee2e2; color: #991b1b; }

  /* Order Body */
  .order-body {
    background: var(--white);
    border-radius: 0 0 var(--card-radius) var(--card-radius);
    padding: 40px;
    box-shadow: 0 8px 40px rgba(0,0,0,.08);
  }

  .section-label {
    font-size: 11px; font-weight: 600;
    letter-spacing: 1.5px; text-transform: uppercase;
    color: var(--muted); margin: 0 0 20px;
    padding-bottom: 10px; border-bottom: 1px solid #f0ebe3;
  }

  /* Timeline */
  .timeline { padding: 4px 0 28px; }

  .tl-step {
    display: flex; align-items: flex-start; gap: 16px;
    position: relative; margin-bottom: 0;
  }

  .tl-step:not(:last-child) { padding-bottom: 20px; }

  .tl-step:not(:last-child)::after {
    content: '';
    position: absolute; left: 21px; top: 44px;
    width: 2px; bottom: 0; background: #e8e4de;
  }

  .tl-icon {
    width: 44px; height: 44px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; flex-shrink: 0; position: relative; z-index: 1;
  }

  .tl-done   { background: #a8e063; font-weight: 700; }
  .tl-active { background: var(--ink); color: #fff; }
  .tl-future { background: #e8e4de; }

  .tl-label         { font-size: 15px; font-weight: 600; color: var(--ink); margin: 0 0 3px; }
  .tl-label-future  { color: #bbb; }
  .tl-sub           { font-size: 13px; color: var(--muted); margin: 0; }

  /* Divider */
  .divider { height: 1px; background: #f0ebe3; margin: 28px 0; }

  /* Product */
  .product-row {
    display: flex; justify-content: space-between;
    align-items: flex-start; gap: 16px;
    padding: 16px; background: var(--faint); border-radius: 12px;
  }

  .prod-name  { font-size: 15px; font-weight: 600; color: var(--ink); }
  .prod-meta  { font-size: 13px; color: var(--muted); margin-top: 4px; }
  .prod-price { font-size: 16px; font-weight: 600; color: var(--ink); white-space: nowrap; }

  /* Summary Grid */
  .summary-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 16px; margin-top: 16px;
  }

  @media(max-width: 500px) {
    .summary-grid { grid-template-columns: 1fr; }
    .order-header { flex-direction: column; }
  }

  .summary-cell { background: var(--faint); border-radius: 12px; padding: 16px 18px; }
  .sc-label { font-size: 11px; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: var(--muted); margin-bottom: 6px; }
  .sc-value { font-size: 15px; font-weight: 600; color: var(--ink); line-height: 1.4; }
  .sc-value-sm { font-weight: 400; font-size: 13px; color: #555; }

  .pay-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 13px; font-weight: 600; padding: 4px 12px;
    border-radius: 100px;
  }
  .pay-razorpay { background: #ede9fe; color: #5b21b6; }
  .pay-cod      { background: #f3f4f6; color: #374151; }
  .pay-bank     { background: #e0f2fe; color: #075985; }
</style>

<div class="container pt-100px pb-100px">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            {{-- FORM --}}
            <div style="border: 1px solid #e8e8e8; border-radius: 8px; padding: 40px; margin-bottom: 30px;">

                <h3 style="text-align:center; font-weight:700; margin-bottom:25px;">
                    Track Your Order
                </h3>

                @if($errors->has('not_found'))
                    <div style="color:red; margin-bottom:15px;">
                        {{ $errors->first('not_found') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('frontend.track.search') }}">
                    @csrf

                    <div style="margin-bottom:15px;">
                        <label>Order Number</label>
                        <input type="text" name="order_number"
                            value="{{ old('order_number') }}"
                            class="form-control"
                            placeholder="ORD-XXXX">
                    </div>

                    <div style="margin-bottom:20px;">
                        <label>Email</label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            class="form-control"
                            placeholder="you@example.com">
                    </div>

                    <button type="submit" class="btn-hover"
                        style="width:100%; padding:12px; background:var(--bs-orange); color:#fff;">
                        Track Order
                    </button>
                </form>
            </div>

            {{-- RESULT --}}
            @isset($order)
            <div style="border: 1px solid #e8e8e8; border-radius: 8px; padding: 40px;">

                <h4 style="font-weight:700; margin-bottom:15px;">
                    Order #{{ $order->order_number }}
                </h4>

                <p style="color:#666; font-size:14px;">
                    Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                </p>

                <hr>

                {{-- STATUS --}}
                <p style="margin-bottom:15px;">
                    <strong>Status:</strong>
                    <span style="color:green;">
                        {{ ucfirst($order->status) }}
                    </span>
                </p>

                {{-- SIMPLE TIMELINE --}}
                @php
                    $steps = ['pending','confirmed','shipped','delivered'];
                @endphp

                <ul style="list-style:none; padding-left:0; margin-bottom:25px;">
                    @foreach($steps as $step)
                        <li style="padding:8px 0; border-left:3px solid
                            {{ $order->status == $step || array_search($step,$steps) < array_search($order->status,$steps) ? 'green' : '#ddd' }};
                            padding-left:10px;">
                            {{ ucfirst($step) }}
                        </li>
                    @endforeach
                </ul>

                <hr>

                {{-- PRODUCT --}}
                <p>
                    <strong>{{ $order->product->name }}</strong><br>
                    Qty: {{ $order->quantity }} × ₹{{ number_format($order->unit_price,2) }}
                </p>

                <p>
                    <strong>Total:</strong> ₹{{ number_format($order->total_price,2) }}
                </p>

                <hr>

                {{-- CUSTOMER --}}
                <p style="font-size:14px;">
                    <strong>Shipping Address:</strong><br>
                    {{ $order->customer->first_name }} {{ $order->customer->last_name }}<br>
                    {{ $order->customer->address_line1 }}<br>
                    {{ $order->customer->city }}, {{ $order->customer->state }} - {{ $order->customer->postcode }}
                </p>

            </div>
            @endisset

        </div>
    </div>
</div>

@endsection