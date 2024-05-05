<header class="navbar navbar-expand-sm bg-success text-white">
  <div class="container-fluid">
    <a href="/" class="navbar-brand p-0" style="line-height: normal">
      <img src="{{ asset('logo-32.png') }}" alt="{{ config('app.name') }}">
    </a>
    <div class="d-flex">
      @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Super Admin'))
        <a href="{{ route('admin.index') }}" class="nav-link">
          <span class="fa fa-user-tie fa-lg"></span>
        </a>
      @endif
      <a class="nav-link px-2" href="{{ route('user.profile') }}">
        <span class="fa fa-user fa-lg"></span>
      </a>
      <a class="nav-link px-2" href="{{ route('user.edit') }}">
        <span class="fa fa-gear fa-lg"></span>
      </a>
      <a class="nav-link px-2" href="{{ route('auth.logout') }}">
        <span class="fa fa-sign-out fa-lg"></span>
      </a>
    </div>
  </div>
</header>