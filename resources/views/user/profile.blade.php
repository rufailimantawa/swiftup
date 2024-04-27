@extends('user.master')
@section('user.main')
<div class="user-profile">
  <div class="bg-white rounded-3 mb-3">
    <div class="profile-actions d-flex flex-wrap justify-content-end p-3 pb-2">
      <a href="{{ route('user.edit') }}" class="btn bg-secondary text-white mb-2 me-2"><strong class="small">Edit Profile</strong></a>
      <a href="{{ route('user.change-pin') }}" class="btn bg-secondary text-white mb-2 me-2">
        <strong class="small">@if (empty(Auth::user()->pin)) Set PIN @else Change PIN @endif</strong>
      </a>
      <a href="{{ route('user.change-password') }}" class="btn bg-secondary text-white mb-2"><strong class="small">Change Password</strong></a>
    </div>
  </div>
  <div class="bg-white rounded-3 px-3">
    <div class="field d-flex flex-wrap justify-content-between py-3 border-bottom">
      <span class="field-name">Full Name</span>
      <span class="value">{{ Str::upper(Auth::user()->fullname) }}</span>
    </div>
    <div class="field d-flex flex-wrap justify-content-between py-3 border-bottom">
      <span class="name">Mobile Number</span>
      <span class="value">{{ Auth::user()->mobile_number }}</span>
    </div>
    <div class="field d-flex flex-wrap justify-content-between py-3 border-bottom">
      <span class="name">Email</span>
      <span class="value">{{ Auth::user()->email }}</span>
    </div>
    <div class="field d-flex flex-wrap justify-content-between py-3 border-bottom">
      <span class="name">Username</span>
      <span class="value">{{ Auth::user()->username }}</span>
    </div>
    <div class="field d-flex flex-wrap justify-content-between py-3">
      <span class="name">Joined on</span>
      <span class="value">{{ Auth::user()->created_at->format('dS F, Y') }}</span>
    </div>
  </div>
</div>
@endsection