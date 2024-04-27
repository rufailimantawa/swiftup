@extends('master')
@section('main')
  <header class="fixed-top">
    <nav class="navbar header-nav navbar-expand-sm bg-success navbar-dark" style="background-color: #4CAF50">
      <div class="container">
        <a href="/" class="navbar-brand">{{config('app.name')}}</a>
    
        <button href="/" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar" aria-control="navbar" aria-expanded="false" aria-label="Toggle navigation" style="border: none; box-shadow: none">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li><a class="nav-link" href="/">Home</a></li>
            <li><a class="nav-link" href="#about">About Us</a></li>
            <li><a class="nav-link" href="#services">Services</a></li>

            @auth
              <li><a class="nav-link-btn btn btn-light m-15px-l md-m-0px-l" href="{{route('dashboard')}}">Dashboard</a></li>
            @else
              <li><a class="nav-link" href="/register">Register</a></li>
              <li><a class="nav-link-btn btn btn-light m-15px-l md-m-0px-l" href="/login">Log In</a></li>
            @endauth
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <main class="landing-page">
    <section id="about"></section>
    <section id="hero-banner">
      <div class="container">
        <div class="row justify-content-center align-items-center fullscreen">
          <div class="col-lg-4 order-2 oder-lg-1 ">
            <div class="banner-text">
              <h2>Welcome to {{ config('app.name') }}</h2>
              <p>{{ config('app.name') }} helps you with instant recharge of Airtime & Cheap Data Plans. 
                We make it cheap and simplify how airtime top-up, data subscription payment is done.</p>
              <div class="sign-btn d-flex flex-column flex-md-row mt-3">
                <a href="/register" class="btn bg-primary text-white flex-md-grow-1">Register</a>
                <a href="/login" class="btn bg-success text-white flex-md-grow-1">Login</a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 order-1 order-lg-2 d-flex justify-content-center">
            <img src="/hero-girl.png" alt="">
          </div>
        </div>
      </div>
    </section>
    <section id="services">
    </section>
  </main>
@endsection