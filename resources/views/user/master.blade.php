@extends('master')

@section('main')
<main class="auth-user">
  @include('user.header')
  <div class="p-3 px-md-0">
    @if ($message = Session::get('success'))
      <div class="alert alert-success">
        {{ $message }}
      </div>
    @endif
    @yield('user.main')
  </div>
  @include('footer')
</main>
@endsection
