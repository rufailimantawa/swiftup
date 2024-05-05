@extends('admin.master')
@section('admin:content')

<div class="card">
    <div class="card-header">Manage Users</div>
    <div class="card-body">
        @can('user:create')
            <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm my-2"><i class="fa fa-plus-circle"></i> Add New User</a>
        @endcan
        <div class="table-responsive">
          <table class="table table-striped table-bordered">
              <thead>
                  <tr>
                  <th scope="col">ID#</th>
                  <th scope="col">UserName</th>
                  <th scope="col">Full Name</th>
                  <th scope="col">Role</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Action</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($users as $user)
                  <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td>{{ $user->username }}</td>
                      <td>{{ $user->fullname }}</td>
                      <td>
                          @forelse ($user->getRoleNames() as $role)
                              <span class="badge bg-primary">{{ $role }}</span>
                          @empty
                          @endforelse
                      </td>
                      <td>{{ $user->created_at->format('jS M, Y') }}</td>
                      <td>
                          <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                              @csrf
                              @method('DELETE')
  
                              <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-warning btn-sm mb-1"><i class="fa fa-eye"></i> Show</a>
  
                              @if (in_array('Super Admin', $user->getRoleNames()->toArray() ?? []) )
                                  @if (Auth::user()->hasRole('Super Admin'))
                                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm mb-1"><i class="fa fa-pencil-square"></i> Edit</a>
                                  @endif
                              @else
                                  @can('user:edit')
                                      <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm mb-1"><i class="fa fa-pencil-square"></i> Edit</a>   
                                  @endcan
  
                                  @can('user:delete')
                                      @if (Auth::user()->id!=$user->id)
                                          <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Do you want to delete this user?');"><i class="fa fa-trash"></i> Delete</button>
                                      @endif
                                  @endcan
                              @endif
  
                          </form>
                      </td>
                  </tr>
                  @empty
                      <td colspan="5">
                          <span class="text-danger">
                              <strong>No User Found!</strong>
                          </span>
                      </td>
                  @endforelse
              </tbody>
          </table>
        </div>
        {{ $users->links() }}
    </div>
</div>
    
@endsection