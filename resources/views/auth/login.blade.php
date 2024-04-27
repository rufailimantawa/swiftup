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
            <h3 class="text-center">Login</h3>
            <form method="POST">
              @csrf
              <div class="py-3">
                <span>Not a user?</span>
                <a href="/register">Register today!</a>
              </div>
              @if (count($errors) > 0 || $err === true)
                <div class="mb-3 p-3" style="background-color: rgba(184, 127, 127, 0.3)">
                  <span class="text-danger">Invalid login credentials</span>
                </div>
              @endif
              {{-- Email input --}}
              <div class="form-floating mb-3">
                <input
                  type="email"
                  id="emailAddress"
                  name="email"
                  placeholder="Email address"
                  class="form-control @if (count($errors) > 0 || $err === true) is-invalid @endif"
                  value="{{ old('email') }}" />
                <label class="form-label" for="emailAddress">Email address</label>
              </div>

              {{-- Password input --}}
              <div class="form-floating mb-3">
                <input
                  type="password"
                  id="password"
                  name="password"
                  placeholder="Password"
                  class="form-control @if (count($errors) > 0 || $err === true) is-invalid @endif" />
                <label class="form-label" for="password">Password</label>
              </div>

              {{-- Submit button --}}
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">
                  Sign In
                </button>
              </div>
              <div class="pt-3 text-center">
                <span>Forgot Password?</span>
                <a href="/forgot-password">Reset now</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
