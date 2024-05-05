@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">
        <div class="float-start">
            User Information
        </div>
        <div class="float-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
        </div>
    </div>
    <div class="card-body">
        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $user->fullname }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Username:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $user->username }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Mobile Number:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $user->mobile_number }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ $user->email }}
            </div>
        </div>

        <div class="mb-3 row">
            <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Role:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                @forelse ($user->getRoleNames() as $role)
                    <span class="badge bg-primary">{{ $role }}</span>
                @empty
                @endforelse
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Wallet Balance:</strong></label>
            <div class="col-md-6" style="line-height: 35px;">
                {{ number_format($user->wallet->balance, 2) }}
            </div>
        </div>
    </div>
</div>    
@endsection
