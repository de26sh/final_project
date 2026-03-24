@extends('admin.layout.app')

@section('main')

{{-- Link the custom stylesheet --}}
<link rel="stylesheet" href="{{ asset('css/slider-admin.css') }}">

<div class="slider-container">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <p class="page-subtitle">Content Management</p>
            <h1 class="page-title">Slider <span>Gallery</span></h1>
        </div>
        <a href="{{ route('admin.slider.create') }}" class="btn btn-primary">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Add Slider
        </a>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    {{-- Table --}}
    <div class="slider-table-wrapper">
        <table class="slider-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Preview</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sliders as $key => $slider)
                <tr>
                    <td><span class="row-num">{{ $key + 1 }}</span></td>
                    <td>{{ $slider->title }}</td>
                    <td>
                        <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}" class="table-thumb">
                    </td>
                    <td>
                        @if($slider->status == 1)
                            <span class="status-badge status-active">Active</span>
                        @else
                            <span class="status-badge status-inactive">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-cell">
                            <a href="{{ route('admin.slider.edit', $slider->id) }}" class="btn btn-warning">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this slider?')">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/></svg>
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-state-icon">🖼️</div>
                            <p>No sliders yet. Add your first one.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
