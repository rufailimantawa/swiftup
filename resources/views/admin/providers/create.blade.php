@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">
        <div class="float-start">
            Add New Services Provider
        </div>
        <div class="float-end">
            <a href="{{ route('admin.providers.index') }}" class="btn btn-success btn-sm">&larr; Back</a>
        </div>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.providers.store') }}" method="post">
        @csrf

        <div class="mb-3 form-floating">
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            placeholder="Name"
            name="name"
            value="{{ old('name') }}">
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
            value="{{ old('url') }}">
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
            value="{{ old('api_url') }}">
          <label for="api_url" class="col-md-4 col-form-label">API URL</label>
          @if ($errors->has('api_url'))
            <span class="text-danger">{{ $errors->first('api_url') }}</span>
          @endif
        </div>

        <div class="mb-3">
          <label for="status" class="col-md-4 col-form-label">Status</label>
          <select class="form-select @error('status') is-invalid @enderror" aria-label="Status" id="status" name="status">
            <option value="0">OFF</option>
            <option value="1">ON</option>
          </select>
          @if ($errors->has('status'))
              <span class="text-danger">{{ $errors->first('status') }}</span>
          @endif
        </div>

        <div class="mb-3 d-grid">
            <input type="submit" class="btn btn-block btn-success" value="Add Provider">
        </div>
      </form>
    </div>
</div>
@endsection