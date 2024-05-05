<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Instantiate a new UserController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user:create|user:edit|user:delete', ['only' => ['index','show']]);
        $this->middleware('permission:user:create', ['only' => ['create','store']]);
        $this->middleware('permission:user:edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user:delete', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.users.index', [
            'pageTitle' => "Manage Users | " . config('app.name'),
            'users' => User::latest('id')->paginate(21)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create', [
            'pageTitle' => "Create User | " . config('app.name'),
            'roles' => Role::orderBy('id', 'DESC')->get()->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        /** @var User */
        $user = User::create($input);
        $user->markEmailAsVerified();
        $user->assignRole((int)$request->role);

        return redirect()->route('admin.users.index')
            ->withSuccess('New user is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', [
            'pageTitle' => "User Details | " . config('app.name'),
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Super Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }

        return view('admin.users.edit', [
            'pageTitle' => "Edit User | " . config('app.name'),
            'user' => $user,
            'roles' => Role::orderBy('id', 'DESC')->get()->all(),
            'userRole' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $input = $request->all();
 
        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }
        
        $user->update($input);

        $user->syncRoles((int) $request->role);

        return redirect()->route('admin.users.show', ['user' => $user->id])
            ->withSuccess('User is updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Super Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('admin.users.index')
            ->withSuccess('User is deleted successfully.');
    }
}
