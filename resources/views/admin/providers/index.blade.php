@extends('admin.master')

@section('admin:content')
<div class="card">
    <div class="card-header">Manage Services Providers</div>
    <div class="card-body">
        @can('providers:create')
            <a href="{{ route('admin.providers.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Provider</a>
        @endcan
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th scope="col" style="min-width: 70px;">ID#</th>
                    <th scope="col" style="min-width: 70px;">Name</th>
                    <th scope="col" style="min-width: 70px;">URL</th>
                    <th scope="col" style="min-width: 70px;">API URL</th>
                    <th scope="col" style="min-width: 70px;">Status</th>
                    <th scope="col" style="min-width: 70px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($serviceProviders as $service)
                    <tr>
                        <th scope="row">{{ $service->id }}</th>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->url }}</td>
                        <td>{{ $service->api_url }}</td>
                        <td><span class="badge @if ($service->status) bg-success @else bg-danger @endif">@if ($service->status) ON @else OFF @endif</span></td>
                        <td>
                            <form action="{{ route('admin.providers.destroy', $service->id) }}" method="post">
                                @csrf
                                @method('DELETE')
    
                                <a href="{{ route('admin.providers.show', $service->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
    
                                @if (Auth::user()->hasRole('Super Admin'))
                                    @can('providers:edit')
                                        <a href="{{ route('admin.providers.edit', $service->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                    @endcan
    
                                    @can('providers:delete')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this provider?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endcan
                                @endif
    
                            </form>
                        </td>
                    </tr>
                    @empty
                        <td class="text-danger text-center" colspan="6">
                            <strong>No Role Found!</strong>
                        </td>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $serviceProviders->links() }}
    </div>
</div>
@endsection