@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>Edit Slider</h2>

    <form action="{{ route('admin.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" value="{{ $slider->subtitle }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $slider->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ asset($slider->image) }}" width="120">
        </div>

        <div class="mb-3">
            <label>Change Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Status</label>
            <input type="checkbox" name="status" value="1" {{ $slider->status == 1 ? 'checked' : '' }}> Active
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection