@extends('admin.layout.app')

@section('main')
<div class="app-content">
    <div class="container-fluid">

        {{-- Page Header --}}
        <div class="row mb-3 mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">Orders</h3>
                    <span class="text-muted fs-6">Total: {{ $orders->total() }} orders</span>
                </div>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Orders Table --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            @if($order->customer)
                                                <div class="fw-semibold">
                                                    {{ $order->customer->first_name }} {{ $order->customer->last_name }}
                                                </div>
                                                <small class="text-muted">{{ $order->customer->email }}</small>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>{{ $order->product->name ?? '—' }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>₹ {{ number_format($order->total_price, 2) }}</td>
                                        <td>
                                            <span class="badge text-bg-secondary text-uppercase">
                                                {{ $order->payment_method }}
                                            </span>
                                        </td>
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
                                        <td>
                                            <small>{{ $order->created_at->format('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-4 text-muted">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($orders->hasPages())
                        <div class="card-footer">
                            {{ $orders->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
@endsection