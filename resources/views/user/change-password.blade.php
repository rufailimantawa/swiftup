@extends('user.master')

@section('user.main')
<div class="user-edit">
  <div class="bg-white rounded-3 px-3 pt-3">
    <h3>Change Password</h3>
    @if ($message = Session::get('success'))
      <div class="pt-2">
        <div class="alert alert-success">{{ $message }}</div>
      </div>
    @endif
    <form method="POST">
      @csrf

      {{-- Old Password input --}}
      <div class="form-floating my-3 mt-2">
        <input
          type="password"
          id="old_password"
          name="old_password"
          placeholder="Old Password"
          class="form-control @error('old_password') is-invalid @enderror"
          value="" />
        <label class="form-label" for="old_password">Old Password</label>
        @if ($errors->has('old_password'))
            <span class="text-danger">{{ $errors->first('old_password') }}</span>
        @endif
      </div>

      {{-- New Password input --}}
      <div class="form-floating my-3">
        <input
          type="password"
          id="password"
          name="password"
          placeholder="New Password"
          class="form-control @error('password') is-invalid @enderror" />
        <label class="form-label" for="password">New Password</label>
        @if ($errors->has('password'))
            <span class="text-danger">{{ $errors->first('password') }}</span>
        @endif
      </div>

      {{-- Confirm Password input --}}
      <div class="form-floating my-3">
        <input
          type="password"
          id="password_confirmation"
          name="password_confirmation"
          placeholder="Confirm Password"
          class="form-control @error('password') is-invalid @enderror" />
        <label class="form-label" for="password">Confirm Password</label>
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