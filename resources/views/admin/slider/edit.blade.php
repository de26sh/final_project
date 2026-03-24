@extends('admin.layout.app')

@section('main')

<link rel="stylesheet" href="{{ asset('css/slider-admin.css') }}">

<div class="slider-container">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <p class="page-subtitle">Content Management</p>
            <h1 class="page-title">Edit <span>Slider</span></h1>
        </div>
        <a href="{{ route('admin.slider.index') }}" class="btn btn-ghost">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="glass-card">
        <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- Title --}}
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $slider->title }}" placeholder="Slider title">
                </div>

                {{-- Subtitle --}}
                <div class="form-group">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ $slider->subtitle }}" placeholder="Subtitle">
                </div>

                {{-- Description --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Description...">{{ $slider->description }}</textarea>
                </div>

                {{-- Current Image --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Current Image</label>
                    <div class="image-preview-block">
                        <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}">
                        <div class="image-preview-label">This is the currently active image for this slider.</div>
                    </div>
                </div>

                {{-- Replace Image --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Replace Image <span style="color:var(--text-muted);font-weight:400;text-transform:none;letter-spacing:0">(optional)</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                {{-- Status Toggle --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Visibility</label>
                    <div class="toggle-group">
                        <label class="toggle-switch">
                            <input type="checkbox" name="status" value="1" {{ $slider->status == 1 ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>{{ $slider->status == 1 ? 'Active' : 'Inactive' }}</strong>
                            <small>Toggle to show or hide this slider</small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v14a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    Update Slider
                </button>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</div>

@endsection
