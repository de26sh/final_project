@extends('admin.layout.app')

@section('main')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit Product Family</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.family.index') }}">Family</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="card col-md-6">
            <form action="{{ route('admin.family.update', $family->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Family Name --}}
                    <div class="mb-3">
                        <label class="form-label">Family Name</label>
                        <input type="text"
                               name="family_name"
                               class="form-control @error('family_name') is-invalid @enderror"
                               value="{{ old('family_name', $family->name) }}"
                               placeholder="Enter family name">

                        @error('family_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Family Description --}}
                    <div class="mb-3">
                        <label class="form-label">Family Description</label>
                        <textarea name="description"
                                  class="form-control @error('description') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Enter description">{{ old('description', $family->description) }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Image Upload --}}
                    <div class="mb-3">
                        <label class="form-label">Family Image</label>
                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror">

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Existing Image --}}
                    @if($family->image)
                        <div class="mb-3">
                            <label class="form-label">Current Image:</label><br>
                            <img src="{{ asset('uploads/families/'.$family->image) }}"
                                 width="100"
                                 class="img-thumbnail">
                        </div>
                    @endif

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        Update Family
                    </button>
                    <a href="{{ route('admin.family.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

</main>
@endsection