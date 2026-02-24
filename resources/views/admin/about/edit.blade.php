@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>Edit About Us</h2>

    <form action="{{ route('admin.about.update',$about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ $about->title }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $about->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Image</label><br>
            @if($about->image)
                <img src="{{ asset('uploads/about/'.$about->image) }}" width="100"><br><br>
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

@endsection