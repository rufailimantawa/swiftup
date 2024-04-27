@extends('user.master')

@section('user.main')
<div class="user-edit">
  <div class="bg-white rounded-3 px-3 pt-3">
    <h3>Change PIN</h3>
    @if ($message = Session::get('success'))
      <div class="pt-2">
        <div class="alert alert-success">{{ $message }}</div>
      </div>
    @endif
    <form method="POST">
      @csrf

      {{-- PIN input --}}
      <div class="form-floating my-3 mt-2">
        <input
          type="number"
          id="pin"
          name="pin"
          max="9999"
          placeholder="PIN"
          class="form-control @error('pin') is-invalid @enderror"
          value="" />
        <label class="form-label" for="pin">PIN</label>
        @if ($errors->has('pin'))
            <span class="text-danger">{{ $errors->first('pin') }}</span>
        @endif
      </div>
      <div class="form-floating my-3">
        <input
          type="number"
          max="9999"
          id="pin_confirmation"
          name="pin_confirmation"
          placeholder="Confirm PIN"
          class="form-control @error('pin') is-invalid @enderror" />
        <label class="form-label" for="pin">Confirm PIN</label>
      </div>

      {{-- Password input --}}
      <div class="form-floating my-3">
        <input
          type="password"
          id="password"
          name="password"
          placeholder="Username"
          class="form-control @error('password') is-invalid @enderror" />
        <label class="form-label" for="password">Password</label>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>

      {{-- Submit button --}}
      <div class="d-grid pb-3">
        <button type="submit" class="btn btn-success btn-block">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>
@endsection