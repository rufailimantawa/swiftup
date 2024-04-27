<header class="navbar navbar-expand-sm bg-success text-white">
  <div class="container-fluid">
    <a href="/" class="navbar-brand p-0" style="line-height: normal">
      <img src="{{ asset('logo-32.png') }}" alt="{{ config('app.name') }}">
    </a>
    <div class="d-flex">
      <a class="nav-link px-2" href="{{ route('user.profile') }}">
        <span class="fa fa-user-circle-o fa-lg"></span>
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