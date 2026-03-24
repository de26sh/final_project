@extends('admin.layout.app')

@section('main')
<div class="app-content">
    <div class="container-fluid">

        <div class="row mb-3 mt-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h3 class="mb-0">
                    <i class="bi bi-person-circle me-2"></i>
                    {{ $customer->first_name }} {{ $customer->last_name }}
                </h3>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Back to Customers
                </a>
            </div>
        </div>

        <div class="row g-3">

            {{-- LEFT: Customer Info --}}
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header bg-dark text-white fw-semibold">
                        <i class="bi bi-person me-1"></i> Customer Details
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-1">Full Name</p>
                        <p class="fw-semibold mb-3">{{ $customer->first_name }} {{ $customer->last_name }}</p>

                        @if($customer->company_name)
                        <p class="text-muted small mb-1">Company</p>
                        <p class="mb-3">{{ $customer->company_name }}</p>
                        @endif

                        <p class="text-muted small mb-1">Email</p>
                        <p class="mb-3">{{ $customer->email }}</p>

                        <p class="text-muted small mb-1">Phone</p>
                        <p class="mb-3">{{ $customer->phone }}</p>

                        <p class="text-muted small mb-1">Address</p>
                        <p class="mb-3">
                            {{ $customer->address_line1 }}
                            @if($customer->address_line2), {{ $customer->address_line2 }}@endif<br>
                            {{ $customer->city }}, {{ $customer->state }} — {{ $customer->postcode }}<br>
                            {{ $customer->country }}
                        </p>

                        <p class="text-muted small mb-1">Customer Since</p>
                        <p class="mb-0">{{ $customer->created_at->format('d M Y') }}</p>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="card">
                    <div class="card-header bg-dark text-white fw-semibold">
                        <i class="bi bi-bar-chart me-1"></i> Stats
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total Orders</span>
                            <span class="badge text-bg-primary fs-6">{{ $customer->orders->count() }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Total Spent</span>
                            <strong>₹ {{ number_format($customer->orders->sum('total_price'), 2) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Order History --}}
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-dark text-white fw-semibold">
                        <i class="bi bi-clock-history me-1"></i> Order History
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <thead class="table-secondary">
                                <tr>
                                    <th>Order No.</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->orders as $order)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold text-primary">
                                                {{ $order->order_number }}
                                            </span>
                                        </td>
                                        <td>{{ $order->product->name ?? '—' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>₹ {{ number_format($order->total_price, 2) }}</td>
                                        <td>
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
                                            <span class="badge text-bg-{{ $badge }} text-capitalize">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td><small>{{ $order->created_at->format('d M Y') }}</small></td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection