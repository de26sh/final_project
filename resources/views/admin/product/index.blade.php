@extends('admin.layout.app')

@section('main')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>Products</h3>
        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Family</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>
                                @if($product->images->first())
                                    <img src="{{ asset('storage/' . $product->images->first()->image) }}" 
                                         width="60" height="60" 
                                         style="object-fit:cover;">
                                @else
                                    No Image
                                @endif
                            </td>

                            <td>{{ $product->name }}</td>

                            <td>{{ $product->category->name ?? '-' }}</td>

                            <td>{{ $product->subCategory->name ?? '-' }}</td>

                            <td>{{ $product->family->name ?? '-' }}</td>

                            <td>₹ {{ number_format($product->price, 2) }}</td>

                            <td>
                                @if($product->status == 'published')
                                    <span class="badge badge-success">Published</span>
                                @elseif($product->status == 'draft')
                                    <span class="badge badge-warning">Draft</span>
                                @else
                                    <span class="badge badge-danger">Unpublished</span>
                                @endif
                            </td>

                            <td>
                                <a href="{{ route('admin.product.edit', $product->id) }}" 
                                   class="btn btn-sm btn-info">
                                   Edit
                                </a>

                                <form action="{{ route('admin.product.destroy', $product->id) }}" 
                                      method="POST" 
                                      style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" 
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">No Products Found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
