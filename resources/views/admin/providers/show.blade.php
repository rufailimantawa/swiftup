@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">
        <div class="float-start">
            Provider Information
        </div>
        <div class="float-end">
            <a href="{{ route('admin.providers.index') }}" class="btn btn-success btn-sm">&larr; Back</a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $provider->name }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>URL:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $provider->url }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>API URL:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $provider->api_url }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Status:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                @if ($provider->status)
                    <span class="badge bg-success">ON</span>
                @else
                    <span class="badge bg-danger">OFF</span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body"></div>
</div>
@endsection