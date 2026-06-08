@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1">Pages</h1>
                    <p>Edit the content shown on each public page.</p>
                </div>
                <x-success-alert />
                <div class="row">
                    @foreach ($pages as $slug => $name)
                        <div class="col-md-4 mb-3">
                            <div class="card p-3 shadow">
                                <h4>{{ $name }}</h4>
                                <a href="{{ route('pages.edit', $slug) }}" class="btn btn-primary mt-2">
                                    <i class="fa fa-edit"></i> Edit content
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
