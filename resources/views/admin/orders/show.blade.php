@extends('admin.layout.app')

@section('main')
<div class="app-content">
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="row mb-3 mt-3">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Order #{{ $order->order_number }}</h3>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Orders
                </a>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-3">

            {{-- LEFT: Order + Product Info --}}
            <div class="col-lg-8">

                {{-- Product Card --}}
                <div class="card mb-3">
                    <div class="card-header fw-semibold">
                        <i class="bi bi-box me-1"></i> Product Details
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <tr>
                                <th width="35%">Product Name</th>
                                <td>{{ $order->product->name ?? '—' }}</td>
                            </tr>
                            <tr>
                                <th>Unit Price</th>
                                <td>₹ {{ number_format($order->unit_price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Quantity</th>
                                <td>{{ $order->quantity }}</td>
                            </tr>
                            <tr>
                                <th>Total Price</th>
                                <td><strong>₹ {{ number_format($order->total_price, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <th>Payment Method</th>
                                <td>
                                    <span class="badge text-bg-secondary text-uppercase">
                                        {{ $order->payment_method }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Order Date</th>
                                <td>{{ $order->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            @if($order->notes)
                            <tr>
                                <th>Notes</th>
                                <td>{{ $order->notes }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>

                {{-- Customer Billing Card --}}
                @if($order->customer)
                <div class="card mb-3">
                    <div class="card-header fw-semibold">
                        <i class="bi bi-person me-1"></i> Customer / Billing Details
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="text-muted small">Full Name</label>
                                <p class="mb-1 fw-semibold">
                                    {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Company</label>
                                <p class="mb-1">{{ $order->customer->company_name ?: '—' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Email</label>
                                <p class="mb-1">{{ $order->customer->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Phone</label>
                                <p class="mb-1">{{ $order->customer->phone }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Address</label>
                                <p class="mb-1">
                                    {{ $order->customer->address_line1 }}
                                    @if($order->customer->address_line2)
                                        , {{ $order->customer->address_line2 }}
                                    @endif
                                    <br>
                                    {{ $order->customer->city }}, {{ $order->customer->state }} - {{ $order->customer->postcode }}
                                    <br>
                                    {{ $order->customer->country }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Address (if different) --}}
                @if($order->customer->ship_to_different)
                <div class="card mb-3">
                    <div class="card-header fw-semibold">
                        <i class="bi bi-truck me-1"></i> Shipping Address
                    </div>
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="text-muted small">Full Name</label>
                                <p class="mb-1 fw-semibold">
                                    {{ $order->customer->shipping_first_name }} {{ $order->customer->shipping_last_name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <label class="text-muted small">Phone</label>
                                <p class="mb-1">{{ $order->customer->shipping_phone ?: '—' }}</p>
                            </div>
                            <div class="col-12">
                                <label class="text-muted small">Address</label>
                                <p class="mb-1">
                                    {{ $order->customer->shipping_address_line1 }}
                                    @if($order->customer->shipping_address_line2)
                                        , {{ $order->customer->shipping_address_line2 }}
                                    @endif
                                    <br>
                                    {{ $order->customer->shipping_city }}, {{ $order->customer->shipping_state }} - {{ $order->customer->shipping_postcode }}
                                    <br>
                                    {{ $order->customer->shipping_country }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif

            </div>

            {{-- RIGHT: Status Update --}}
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-semibold">
                        <i class="bi bi-pencil-square me-1"></i> Update Order Status
                    </div>
                    <div class="card-body">

                        {{-- Current Status Badge --}}
                        <div class="mb-3 text-center">
                            <span class="fs-6 text-muted">Current Status:</span><br>
                            @php
                                $badge = match($order->status) {
                                    'pending'   => 'warning',
                                    'confirmed' => 'info',
                                    'shipped'   => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger',
                                    default     => 'secondary',
                                };
                            @endphp
                            <span class="badge text-bg-{{ $badge }} fs-6 text-capitalize mt-1 px-3 py-2">
                                {{ $order->status }}
                            </span>
                        </div>

                        <hr>

                        {{-- Status Update Form --}}
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Change Status</label>
                                <select name="status" class="form-select">
                                    @foreach(['pending','confirmed','shipped','delivered','cancelled'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $order->status === $status ? 'selected' : '' }}
                                            class="text-capitalize">
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-check-circle me-1"></i> Update Status
                            </button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection