@extends('admin.layout.app')
@section('main')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Sub Category</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Sub Category</li>
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

        <!-- CREATE FORM -->
        <div class="card">
            <div class="card col-md-6">
                <form action="{{ route('admin.sub-category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">

                        {{-- Category Dropdown --}}
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror"
                                name="category">
                                <option value="">Choose Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old('category') == $cat->id ? 'selected' : '' }}>
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
                                class="form-control @error('sub_category_name') is-invalid @enderror"
                                name="sub_category_name"
                                value="{{ old('sub_category_name') }}"
                                placeholder="Enter Sub Category Name">

                            @error('sub_category_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Sub Category Description</label>
                            <textarea class="form-control @error('sub_category_description') is-invalid @enderror"
                                name="sub_category_description"
                                placeholder="Enter Description">{{ old('sub_category_description') }}</textarea>

                            @error('sub_category_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="input-group mb-3">
                            <input type="file"
                                class="form-control @error('sub_category_image') is-invalid @enderror"
                                name="sub_category_image">
                            <label class="input-group-text">Upload Image</label>
                        </div>

                        @error('sub_category_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>

        <hr>

        <!-- TABLE -->
        <div class="card">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 50px">#</th>
                        <th>Category</th>
                        <th>Sub Category</th>
                        <th>Description</th>
                        <th style="width: 80px">Image</th>
                        <th style="width: 150px">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($subCategories as $key => $sub)
                        <tr class="align-middle">
                            <td>{{ $key + 1 }}</td>

                            <td>{{ $sub->category->name ?? '-' }}</td>

                            <td>{{ $sub->name }}</td>

                            <td>{{ $sub->description }}</td>

                            <td>
                                @if ($sub->image)
                                    <img src="{{ asset('uploads/sub_categories/' . $sub->image) }}"
                                        width="60">
                                @endif
                            </td>

                            <td>
                                {{-- Edit --}}
                                <a href="{{ route('admin.sub-category.edit', $sub->id) }}"
                                    class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.sub-category.destroy', $sub->id) }}"
                                    method="POST"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this sub category?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No Sub Categories Found</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</main>
@endsection