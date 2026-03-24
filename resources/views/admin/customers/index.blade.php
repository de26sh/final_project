@extends('admin.layout.app')

@section('main')
<div class="app-content">
    <div class="container-fluid">

        <div class="row mb-3 mt-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h3 class="mb-0"><i class="bi bi-people-fill me-2"></i>Customers</h3>
                <span class="badge text-bg-secondary fs-6">Total: {{ $customers->total() }}</span>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Total Orders</th>
                            <th>Total Spent</th>
                            <th>Since</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td class="fw-semibold">
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                    @if($customer->company_name)
                                        <br><small class="text-muted">{{ $customer->company_name }}</small>
                                    @endif
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->city }}, {{ $customer->country }}</td>
                                <td>
                                    <span class="badge text-bg-primary">
                                        {{ $customer->orders_count }}
                                    </span>
                                </td>
                                <td>₹ {{ number_format($customer->orders_sum_total_price ?? 0, 2) }}</td>
                                <td><small>{{ $customer->created_at->format('d M Y') }}</small></td>
                                <td>
                                    <a href="{{ route('admin.customers.show', $customer->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-muted">
                                    <i class="bi bi-people fs-3 d-block mb-2"></i>
                                    No customers yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($customers->hasPages())
                <div class="card-footer">
                    {{ $customers->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection