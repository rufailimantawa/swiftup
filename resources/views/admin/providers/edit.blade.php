@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">
        <div class="float-start">
            Edit Services Provider
        </div>
        <div class="float-end">
            <a href="{{ route('admin.providers.index') }}" class="btn btn-success btn-sm">&larr; Back</a>
        </div>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.providers.update', $provider->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3 form-floating">
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            placeholder="Name"
            name="name"
            value="{{ $provider->name }}">
          <label for="name" class="col-md-4 col-form-label">Name</label>
          @if ($errors->has('name'))
              <span class="text-danger">{{ $errors->first('name') }}</span>
          @endif
        </div>

        <div class="mb-3 form-floating">
          <input
            type="text"
            class="form-control @error('url') is-invalid @enderror"
            placeholder="URL"
            id="url"
            name="url"
            value="{{ $provider->url }}">
          <label for="url" class="col-md-4 col-form-label">URL</label>
          @if ($errors->has('url'))
              <span class="text-danger">{{ $errors->first('url') }}</span>
          @endif
        </div>

        <div class="mb-3 form-floating">
          <input
            type="text"
            class="form-control @error('api_url') is-invalid @enderror"
            id="api_url"
            placeholder="API URL"
            name="api_url"
            value="{{ $provider->api_url }}">
          <label for="api_url" class="col-md-4 col-form-label">API URL</label>
          @if ($errors->has('api_url'))
            <span class="text-danger">{{ $errors->first('api_url') }}</span>
          @endif
        </div>

        <div class="mb-3">
          <label for="status" class="col-md-4 col-form-label">Status</label>
          <select class="form-select @error('status') is-invalid @enderror" aria-label="Status" id="status" name="status">
            <option value="0" {{ !$provider->status ? 'selected' : '' }}>OFF</option>
            <option value="1" {{ $provider->status ? 'selected' : '' }}>ON</option>
          </select>
          @if ($errors->has('status'))
              <span class="text-danger">{{ $errors->first('status') }}</span>
          @endif
        </div>

        <div class="mb-3 d-grid">
            <input type="submit" class="btn btn-block btn-success" value="Update Provider">
        </div>
      </form>
    </div>
</div>
@endsection