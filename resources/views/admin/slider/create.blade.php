@extends('admin.layout.app')

@section('main')

<link rel="stylesheet" href="{{ asset('css/slider-admin.css') }}">

<div class="slider-container">

    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <p class="page-subtitle">Content Management</p>
            <h1 class="page-title">Add <span>Slider</span></h1>
        </div>
        <a href="{{ route('admin.slider.index') }}" class="btn btn-ghost">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
            Back to List
        </a>
    </div>

    {{-- Form Card --}}
    <div class="glass-card">
        <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-grid">

                {{-- Title --}}
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter slider title" value="{{ old('title') }}">
                </div>

                {{-- Subtitle --}}
                <div class="form-group">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" placeholder="Enter subtitle" value="{{ old('subtitle') }}">
                </div>

                {{-- Description --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Write a short description...">{{ old('description') }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>

                {{-- Status Toggle --}}
                <div class="form-group form-group-full">
                    <label class="form-label">Visibility</label>
                    <div class="toggle-group">
                        <label class="toggle-switch">
                            <input type="checkbox" name="status" value="1" checked>
                            <span class="toggle-slider"></span>
                        </label>
                        <div class="toggle-info">
                            <strong>Active</strong>
                            <small>Slider will be displayed on the site</small>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Actions --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Save Slider
                </button>
                <a href="{{ route('admin.slider.index') }}" class="btn btn-ghost">Cancel</a>
            </div>

        </form>
    </div>

</div>

@endsection
