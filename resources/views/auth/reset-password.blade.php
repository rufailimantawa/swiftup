@extends('auth.master')
@section('main')
<section class="background-radial-gradient overflow-hidden">
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center justify-content-center mb-3">
      <div class="col-lg-6 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-3 py-5 px-md-4">
            <h3 class="text-center">Reset Password</h3>
            <form method="POST">
              @csrf
              <div class="py-3">
                <span>Remember password?</span>
                <a href="{{ route('auth.login') }}">Login now!</a>
              </div>
              {{-- Email input --}}
              <input type="hidden" name="email" value="{{ $email }}">
              {{-- Token input --}}
              <input type="hidden" name="token" value="{{ $token }}">
              
              {{-- Password input --}}
              <div>
                <div class="form-floating mb-3">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Password"
                    class="form-control @error('password') is-invalid @enderror" />
                  <label class="form-label" for="password">Password</label>
                  @if ($errors->has('password'))
                      <span class="text-danger">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="form-floating mb-3">
                  <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm Password"
                    class="form-control @error('password') is-invalid @enderror" />
                  <label class="form-label" for="password_confirmation">Confirm Password</label>
                </div>
              </div>

              {{-- Submit button --}}
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">
                  Reset password
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
