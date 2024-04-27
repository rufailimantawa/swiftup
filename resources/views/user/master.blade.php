@extends('master')

@section('main')
<main class="auth-user">
  @include('user.header')
  <div class="p-3 px-md-0">
    @yield('user.main')
  </div>
  @include('footer')
  @include('script')
</main>
@endsection
