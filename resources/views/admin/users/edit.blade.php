@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">
        <div class="float-start">
          Edit User
        </div>
        <div class="float-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-success btn-sm">&larr; Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post">
            @csrf
            @method("PUT")

            {{-- 2 column grid layout with text inputs for the fullname and username --}}
            <div class="row">
              <div class="col-md-6 mb-3">
                <div class="form-floating">
                  <input
                    type="fullname"
                    id="fullname"
                    name="fullname"
                    placeholder="Full Name"
                    class="form-control @error('fullname') is-invalid @enderror"
                    value="{{ $user->fullname }}" />
                  <label class="form-label" for="fullname">Full Name</label>
                  @if ($errors->has('fullname'))
                      <span class="text-danger">{{ $errors->first('fullname') }}</span>
                  @endif
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <div class="form-floating">
                  <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Mobile number"
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ $user->username }}" />
                  <label class="form-label" for="username">Username</label>
                  @if ($errors->has('username'))
                      <span class="text-danger">{{ $errors->first('username') }}</span>
                  @endif
                </div>
              </div>
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
                    value="{{ $user->email }}" />
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
                    value="{{ $user->mobile_number }}" />
                  <label class="form-label" for="mobileNumber">Mobile number</label>
                  @if ($errors->has('mobile_number'))
                      <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                  @endif
                </div>
              </div>
            </div>

            {{-- Password input --}}
            <div class="row">
              <div class="col-sm-6">
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
              <div class="col-sm-6">
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

            <div class="mb-3">
              <label for="role" class="form-label">Role</label>
              <select class="form-select @error('role') is-invalid @enderror" aria-label="Roles" id="role" name="role">
                  @forelse ($roles as $role)
                    @if ($role->name!='Super Admin')
                      <option value="{{ $role->id }}" {{ $role->id == $userRole->id ? 'selected' : '' }}>
                        {{ $role->name }}
                      </option>
                    @elseif (Auth::user()->hasRole('Super Admin'))   
                      <option value="{{ $role->id }}" {{ $role->id == $userRole->id ? 'selected' : '' }}>
                      {{ $role->name }}
                      </option>
                    @endif
                  @empty
                  @endforelse
              </select>
              @if ($errors->has('role'))
                  <span class="text-danger">{{ $errors->first('role') }}</span>
              @endif
            </div>
            <div class="mb-3 row">
                <input type="submit" class="col-md-3 offset-md-5 btn btn-success" value="Update User">
            </div>
        </form>
    </div>
</div>    
@endsection
