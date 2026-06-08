@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1">Edit: {{ $pageName }}</h1>
                    <a href="{{ route('pages.index') }}" class="btn btn-secondary">Back to pages</a>
                </div>
                <x-success-alert />
                <x-danger-alert />
                <form method="post" action="{{ route('pages.update', $page) }}">
                    @csrf
                    @method('PUT')
                    @foreach ($sections as $group => $rows)
                        <div class="card p-3 shadow mb-4">
                            <h4 class="mb-3"><strong>{{ $group }}</strong></h4>
                            @foreach ($rows as $row)
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ $row->label }}</label>
                                    @if ($row->type === 'textarea')
                                        <textarea name="sections[{{ $row->section_key }}]" rows="3"
                                            class="form-control">{{ $row->value }}</textarea>
                                    @else
                                        <input type="text" name="sections[{{ $row->section_key }}]"
                                            value="{{ $row->value }}" class="form-control">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary mb-5">Save changes</button>
                </form>
            </div>
        </div>
    </div>
@endsection
