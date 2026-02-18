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
                        <h3 class="mb-0">Sub Category</h3>
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

            <div class="card">
                <div class="card-header">
                    {{-- Titel goes here --}}
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card col-md-6">
                            <form action="{{ route('admin.sub-category.store') }}" method="POST" enctype='multipart/form-data'>
                                @csrf
                                <!--begin::Body-->
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="validationCustom04" class="form-label">Category<span
                                                class="required-indicator sr-only"> (required)</span></label>
                                        <select class="form-select @error('category') is-invalid @enderror" name="category">
                                            <option selected="" disabled="" value="">Choose...</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach


                                        </select>
                                        @error('category')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Please select a valid state.</div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                                        <input type="text"
                                            class="form-control @error('sub_category_name') is-invalid @enderror"
                                            name="sub_category_name" value="{{ old('sub_category_name') }}">
                                        @error('sub_category_name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Sub Category Description</label>
                                        <textarea class="form-control @error('sub_category_description') is-invalid @enderror" name="sub_category_description">{{ old('sub_category_description') }}</textarea>

                                        @error('sub_category_description')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="file"
                                            class="form-control @error('sub_category_image') is-invalid @enderror"
                                            name="sub_category_image">

                                        @error('sub_category_image')
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
                </div>
            </div>

        </div>

    </main>
@endsection
