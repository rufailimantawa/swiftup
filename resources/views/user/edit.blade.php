@extends('user.master')

@section('user.main')
<div class="user-edit">
  <div class="bg-white rounded-3 px-3 pt-3">
    <h3>Edit Profile</h3>
    @if ($message = Session::get('success'))
      <div class="pt-2">
        <div class="alert alert-success">{{ $message }}</div>
      </div>
    @endif
    <form method="POST">
      @csrf

      {{-- Full Name input --}}
      <div class="form-floating my-3 mt-2">
        <input
          type="text"
          id="fullname"
          name="fullname"
          placeholder="Full Name"
          class="form-control @error('fullname') is-invalid @enderror"
          value="{{ old('fullname') ?? Auth::user()->fullname }}" />
        <label class="form-label" for="fullname">Full Name</label>
        @if ($errors->has('fullname'))
            <span class="text-danger">{{ $errors->first('fullname') }}</span>
        @endif
      </div>

      {{-- Mobile Number input --}}
      <div class="form-floating my-3">
        <input
          type="text"
          id="mobile_number"
          name="mobile_number"
          placeholder="Mobile Number"
          class="form-control @error('mobile_number') is-invalid @enderror"
          value="{{ old('mobile_number') ?? Auth::user()->mobile_number }}" />
        <label class="form-label" for="mobile_number">Mobile Number</label>
        @if ($errors->has('mobile_number'))
            <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
        @endif
      </div>

      {{-- Username input --}}
      <div class="form-floating my-3">
        <input
          type="text"
          id="username"
          name="username"
          placeholder="Username"
          class="form-control @error('username') is-invalid @enderror"
          value="{{ old('username') ?? Auth::user()->username }}" />
        <label class="form-label" for="username">Username</label>
        @if ($errors->has('username'))
            <span class="text-danger">{{ $errors->first('username') }}</span>
        @endif
      </div>

      {{-- Gender input --}}
      <div class="form-floating my-3">
        <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror">
          <option @if (!in_array(old('gender') ?? Auth::user()->gender, ['male', 'female'])) selected @endif value=""></option>
          <option @if ((old('gender') ?? Auth::user()->gender) == 'male') selected @endif value="male">Male</option>
          <option @if ((old('gender') ?? Auth::user()->gender) == 'female') selected @endif value="female">Female</option>
        </select>
        <label class="form-label" for="gender">Gender</label>
        @if ($errors->has('gender'))
            <span class="text-danger">{{ $errors->first('gender') }}</span>
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