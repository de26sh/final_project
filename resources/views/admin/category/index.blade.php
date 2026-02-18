@extends('admin.layout.app')
@section('main')
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Category</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </div>
                </div>

            </div>

        </div>
        <div class="app-content">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card">
                <div class="card col-md-6">
                    <form action="{{ route('admin.category.store') }}" method="POST" enctype='multipart/form-data'>
                        @csrf
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror"
                                    name="category_name" value="{{ old('category_name') }}"
                                    placeholder="Enter a category name" />

                                @error('category_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Category Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>

                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" />

                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <label class="input-group-text" for="inputGroupFile02">Upload Image</label>
                            </div>
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                </div>
            </div>
            <hr>
            <div class="card">
                <table class="table table-bordered" role="table">
                    <thead>
                        <tr>
                            <th style="width: 10px" scope="col">#</th>
                            <th style="width: 60px" scope="col">Category Name</th>
                            <th scope="col" style="width: 60px">Description</th>
                            <th style="width: 20px" scope="col">Image</th>
                            <th style="width: 20px" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $cat)
                            <tr class="align-middle">
                                <td>1.</td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    {{ $cat->description }}
                                </td>
                                <td>
                                    @if ($cat->image)
                                        <img src="{{ asset('uploads/categories/' . $cat->image) }}" width="60">
                                    @endif
                                </td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.category.edit', $cat->id) }}" class="btn btn-sm btn-warning">
                                        Edit
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

    </main>
@endsection
