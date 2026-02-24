@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>Add Slider</h2>

    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="checkbox" name="status" value="1" checked> Active
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

@endsection