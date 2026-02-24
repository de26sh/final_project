@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>Create About Us</h2>

    <form action="{{ route('admin.about.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-success">Submit</button>
    </form>
</div>

@endsection