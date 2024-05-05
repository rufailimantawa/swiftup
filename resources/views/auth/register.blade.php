@extends('auth.master')
@section('main')
<!-- Section: Design Block -->
<section class="background-radial-gradient overflow-hidden">
  <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-3">
      <div class="col-lg-6 mb-3 mb-lg-0" style="z-index: 10">
        <h1 class="my-5 my-lg-4 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          The cheap offer <br />
          <span style="color: hsl(218, 81%, 75%)">for your communication</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          We offer instant recharge of Airtime, Data bundles
          for <strong>9mobile</strong>, <strong>Airtel</strong>, <strong>Glo</strong>, & 
          <strong>MTN</strong> network subscribers.
        </p>
      </div>

      <div class="col-lg-6 position-relative">
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

        <div class="card bg-glass">
          <div class="card-body px-3 py-5 px-md-4">
            <h3 class="text-center">Create an account</h3>
            <form method="POST">
              @csrf
              <div class="py-3">
                <span>Already a user?</span>
                <a href="{{ route('auth.login') }}">Login now!</a>
              </div>

              {{-- Fullname input --}}
              <div class="form-floating mb-3" data-mdb-input-init>
                <input
                  type="text"
                  id="fullname"
                  name="fullname"
                  placeholder="E"
                  class="form-control @error('fullname') is-invalid @enderror"
                  value="{{ old('fullname') }}" />
                <label class="form-label" for="fullname">Fullname</label>
                @if ($errors->has('fullname'))
                    <span class="text-danger">{{ $errors->first('fullname') }}</span>
                @endif
              </div>

              {{-- 2 column grid layout with text inputs for the email and mobile number --}}
              <div class="row">
                <div class="col-md-6 mb-3">
                  <div class="form-floating">
                    <input
                      type="email"
                      id="emailAddress"
                      name="email"
                      placeholder="Email address"
                      class="form-control @error('email') is-invalid @enderror"
                      value="{{ old('email') }}" />
                    <label class="form-label" for="emailAddress">Email address</label>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <div class="form-floating">
                    <input
                      type="tel"
                      id="mobileNumber"
                      name="mobile_number"
                      placeholder="Mobile number"
                      class="form-control @error('mobile_number') is-invalid @enderror"
                      value="{{ old('mobile_number') }}" />
                    <label class="form-label" for="mobileNumber">Mobile number</label>
                    @if ($errors->has('mobile_number'))
                        <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              {{-- Username input --}}
              <div class="form-floating mb-3">
                <input
                  type="text"
                  id="username"
                  name="username"
                  placeholder="Username"
                  class="form-control @error('username') is-invalid @enderror"
                  value="{{ old('username') }}" />
                <label class="form-label" for="username">Username</label>
                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
              </div>

              {{-- Password input --}}
              <div class="row">
                <div class="col-sm-6 mb-3">
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
                </div>
                <div class="col-sm-6 mb-3">
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
              </div>

              {{-- Submit button --}}
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- Section: Design Block -->
@endsection