@extends('admin.layout.app')

@section('main')

<div class="container-fluid">

    <h3 class="mb-3">Edit Product</h3>

    <form action="{{ route('admin.product.update', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                {{-- Product Name --}}
                <div class="mb-3">
                    <label>Product Name</label>
                    <input type="text" 
                           name="name" 
                           value="{{ old('name', $product->name) }}"
                           class="form-control">
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category_id" 
                            id="category" 
                            class="form-control">
                        <option value="">Select</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Sub Category --}}
                <div class="mb-3">
                    <label>Sub Category</label>
                    <select name="sub_category_id" 
                            id="subcategory" 
                            class="form-control">
                        <option value="">Select</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->id }}"
                                {{ $product->sub_category_id == $sub->id ? 'selected' : '' }}>
                                {{ $sub->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Family --}}
                <div class="mb-3">
                    <label>Family</label>
                    <select name="family_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($families as $family)
                            <option value="{{ $family->id }}"
                                {{ $product->family_id == $family->id ? 'selected' : '' }}>
                                {{ $family->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" 
                           name="price" 
                           value="{{ old('price', $product->price) }}"
                           class="form-control">
                </div>

                {{-- Short Description --}}
                <div class="mb-3">
                    <label>Short Description</label>
                    <textarea name="short_description" 
                              class="form-control">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                {{-- Long Description --}}
                <div class="mb-3">
                    <label>Long Description</label>
                    <textarea name="long_description" 
                              id="editor"
                              class="form-control">
                        {{ old('long_description', $product->long_description) }}
                    </textarea>
                </div>

                {{-- Existing Images --}}
                <div class="mb-3">
                    <label>Existing Images</label>
                    <div class="row">

                        @foreach($product->images as $image)
                            <div class="col-md-2 mb-3 text-center">

                                <img src="{{ asset('storage/' . $image->image) }}" 
                                     width="100" height="100"
                                     style="object-fit:cover;">

                                <form action="{{ route('admin.product.image.delete', $image->id) }}" 
                                      method="POST"
                                      class="mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        @endforeach

                    </div>
                </div>

                {{-- Add New Images --}}
                <div class="mb-3">
                    <label>Add More Images</label>
                    <input type="file" 
                           name="images[]" 
                           multiple 
                           class="form-control">
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="draft"
                            {{ $product->status == 'draft' ? 'selected' : '' }}>
                            Draft
                        </option>

                        <option value="published"
                            {{ $product->status == 'published' ? 'selected' : '' }}>
                            Published
                        </option>

                        <option value="unpublished"
                            {{ $product->status == 'unpublished' ? 'selected' : '' }}>
                            Unpublished
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">
                    Update Product
                </button>

            </div>
        </div>

    </form>

</div>

@endsection


@push('scripts')

<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    if (document.getElementById('editor')) {
        CKEDITOR.replace('editor');
    }

    document.getElementById('category').addEventListener('change', function() {

        let categoryId = this.value;

        fetch("{{ url('admin/get-subcategories') }}/" + categoryId)
            .then(response => response.json())
            .then(data => {

                let subcategory = document.getElementById('subcategory');
                subcategory.innerHTML = '<option value="">Select</option>';

                data.forEach(function(item) {
                    subcategory.innerHTML += 
                        `<option value="${item.id}">${item.name}</option>`;
                });

            });

    });

});
</script>

@endpush
