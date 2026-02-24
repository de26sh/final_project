@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>Slider List</h2>

    <a href="{{ route('admin.slider.create') }}" class="btn btn-primary mb-3">Add Slider</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sliders as $key => $slider)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $slider->title }}</td>
                <td>
                    <img src="{{ asset($slider->image) }}" width="100">
                </td>
                <td>
                    {{ $slider->status == 1 ? 'Active' : 'Inactive' }}
                </td>
                <td>
                    <a href="{{ route('admin.slider.edit',$slider->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('admin.slider.destroy',$slider->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection