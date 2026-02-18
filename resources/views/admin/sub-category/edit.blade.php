@extends('admin.layout.app')
@section('main')

<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Sub Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.sub-category.index') }}">Sub Category</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card col-md-6">

                <form action="{{ route('admin.sub-category.update', $subCategory->id) }}"
                      method="POST"
                      enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        {{-- Category Dropdown --}}
                        <div class="mb-3">
                            <label class="form-label">Category</label>

                            <select class="form-select @error('category') is-invalid @enderror"
                                    name="category">

                                <option value="">Choose Category</option>

                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category', $subCategory->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach

                            </select>

                            @error('category')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Sub Category Name --}}
                        <div class="mb-3">
                            <label class="form-label">Sub Category Name</label>

                            <input type="text"
                                   name="sub_category_name"
                                   class="form-control @error('sub_category_name') is-invalid @enderror"
                                   value="{{ old('sub_category_name', $subCategory->name) }}"
                                   placeholder="Enter Sub Category Name">

                            @error('sub_category_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Sub Category Description</label>

                            <textarea name="sub_category_description"
                                      class="form-control @error('sub_category_description') is-invalid @enderror"
                                      placeholder="Enter Description">{{ old('sub_category_description', $subCategory->description) }}</textarea>

                            @error('sub_category_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Current Image --}}
                        @if($subCategory->image)
                            <div class="mb-3">
                                <label class="form-label">Current Image</label><br>
                                <img src="{{ asset('uploads/sub_categories/' . $subCategory->image) }}"
                                     width="100">
                            </div>
                        @endif

                        {{-- Upload New Image --}}
                        <div class="input-group mb-3">
                            <input type="file"
                                   name="sub_category_image"
                                   class="form-control @error('sub_category_image') is-invalid @enderror">
                            <label class="input-group-text">Change Image</label>
                        </div>

                        @error('sub_category_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <a href="{{ route('admin.sub-category.index') }}"
                           class="btn btn-secondary">
                            Back
                        </a>

                        <button type="submit"
                                class="btn btn-primary">
                            Update
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>

</main>

@endsection