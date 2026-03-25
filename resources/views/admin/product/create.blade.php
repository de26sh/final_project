@extends('admin.layout.app')

@section('main')
    <div class="container">
        <h2>Add Product</h2>

        {{-- Show Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Product Name</label>
                <input type="text" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" id="category" class="form-control">
                    <option value="">Select</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Sub Category</label>
                <select name="sub_category_id" id="subcategory" class="form-control">
                    <option value="">Select</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Family</label>
                <select name="family_id" class="form-control">
                    <option value="">Select</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="text" name="price" class="form-control">
            </div>

            <div class="mb-3">
                <label>Short Description</label>
                <textarea name="short_description" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Long Description</label>
                <textarea name="long_description" id="editor" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Images</label>
                <input type="file" name="images[]" multiple class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                    <option value="unpublished">Unpublished</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save Product</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            // CKEditor
            if (document.getElementById('editor')) {
                CKEDITOR.replace('editor');
            }

            // Category Change Event
            let categorySelect = document.getElementById('category');

            if (categorySelect) {

                categorySelect.addEventListener('change', function() {

                    let categoryId = this.value;

                    if (!categoryId) return;

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
            }

        });
    </script>
@endpush
