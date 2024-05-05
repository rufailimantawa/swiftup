@include('head')
<body>
  @yield('main')
  @yield('footer')

  @stack('templates')
  @stack('scripts')
</body>
