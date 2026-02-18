@extends('admin.layout.app')
@section('main')

<main class="app-main">

<div class="app-content">

    {{-- Success --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- CREATE FORM -->
    <div class="card col-md-6">
        <form action="{{ route('admin.family.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                <div class="mb-3">
                    <label>Family Name</label>
                    <input type="text"
                        name="family_name"
                        class="form-control @error('family_name') is-invalid @enderror"
                        value="{{ old('family_name') }}">

                    @error('family_name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Description</label>
                    <textarea name="family_description"
                        class="form-control @error('family_description') is-invalid @enderror">{{ old('family_description') }}</textarea>

                    @error('family_description')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file"
                        name="image"
                        class="form-control @error('image') is-invalid @enderror">

                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>
    </div>

    <hr>

    <!-- TABLE -->
    <div class="card">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Family Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th width="150">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($families as $key => $family)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $family->name }}</td>
                        <td>{{ $family->description }}</td>
                        <td>
                            @if($family->image)
                                <img src="{{ asset('uploads/families/'.$family->image) }}" width="60">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.family.edit', $family->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.family.destroy', $family->id) }}"
                                method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this family?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            No Product Families Found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
</main>
@endsection