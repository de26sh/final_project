@extends('admin.layout.app')

@section('main')

<div class="container">
    <h2>About Us List</h2>

    <a href="{{ route('admin.about.create') }}" class="btn btn-primary">Add About</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($about as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->description }}</td>
                <td>
                    @if($row->image)
                        <img src="{{ asset('uploads/about/'.$row->image) }}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.about.edit',$row->id) }}" class="btn btn-warning">Edit</a>

                    <form action="{{ route('admin.about.destroy',$row->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection