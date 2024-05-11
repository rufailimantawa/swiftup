@extends('admin.master')

@section('admin:content')
    <div class="p-1">
        <div class="bg-white p-2 pb-0 rounded">
            <h5 class="mb-2">Actions</h5>
            <a href="{{ route('admin.providers.index') }}" class="btn bg-secondary text-white mb-2 me-2">Manage Providers</a>
            <a href="{{ route('admin.roles.index') }}" class="btn bg-secondary text-white mb-2 me-2">Manage Roles</a>
            <a href="{{ route('admin.users.index') }}" class="btn bg-secondary text-white mb-2 me-2">Manage Users</a>
        </div>
    </div>
    <div id="dashboard-analytics">
        <div class="row m-0">
            @foreach ($stats['list'] as $stat)
                <div class="col-sm-6 col-md-4 p-1">
                    <div class="card text-center" style="text-decoration: none; color: inherit;">
                        <div class="card-content">
                            <div class="card-body">
                                <span class="fa fa-2xl {{ $stat['icon'] }}"></span>
                                <h2 class="py-2">{{ $stat['count'] }}</h2>
                                <p>{{ $stat['name'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection