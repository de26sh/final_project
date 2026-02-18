@extends('admin.layout.app')
@section('main')

<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Edit Category</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="card col-md-6">
            <form action="{{ route('admin.category.update', $category->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    <div class="mb-3">
                        <label>Category Name</label>
                        <input type="text"
                            name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror"
                            value="{{ old('category_name', $category->name) }}">

                        @error('category_name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>

                        @error('description')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($category->image)
                        <div class="mb-3">
                            <label>Current Image</label><br>
                            <img src="{{ asset('uploads/categories/'.$category->image) }}" width="100">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label>Change Image</label>
                        <input type="file"
                            name="image"
                            class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</main>
@endsection