@extends('admin.layout.app') {{-- change if your layout is different --}}

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Slider Management</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('slider.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add Slider
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Slider List</h3>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @forelse($sliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->title }}</td>

                                <td>
                                    @if($slider->image)
                                        <img src="{{ asset('storage/'.$slider->image) }}" width="80">
                                    @else
                                        No Image
                                    @endif
                                </td>

                                <td>
                                    @if($slider->status == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('slider.edit', $slider->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('slider.destroy', $slider->id) }}"
                                          method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Are you sure?')"
                                                class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Sliders Found</td>
                            </tr>
                        @endforelse

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</div>

@endsection