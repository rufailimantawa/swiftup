<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\ServicesProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceProvidersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware(
            'permission:provider:create|provider:edit|provider:delete',
            ['only' => ['index','show']]
        );
        $this->middleware("permission:provider:create", ['only' => ['create', 'store']]);
        $this->middleware("permission:provider:edit", ['only' => ['edit', 'update']]);
        $this->middleware("permission:provider:delete", ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.providers.index', [
            'pageTitle' => "Manage Services Providers | " . config('app.name'),
            'serviceProviders' => ServicesProvider::latest()->paginate(21)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.providers.create', [
            'pageTitle' => 'Create new Provider | ' . config('app.name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderRequest $request)
    {
        $input = $request->only(['name', 'url', 'api_url', 'status']);

        ServicesProvider::create($input);

        return redirect()->route('admin.providers.index')
            ->withSuccess('New services provider is added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicesProvider $provider)
    {
        return view('admin.providers.show', [
            'pageTitle' => "{$provider->name} - Provider | " . config('app.name'),
            'provider' => $provider
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServicesProvider $provider)
    {
        return view('admin.providers.edit', [
            'pageTitle' => "Edit {$provider->name} - Provider | " . config('app.name'),
            'provider' => $provider
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderRequest $request, ServicesProvider $provider)
    {
        $provider->update($request->only(['name', 'url', 'api_url', 'status']));

        return redirect()->route('admin.providers.show', ['provider' => $provider->id])
            ->withSuccess("Provider is updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicesProvider $provider)
    {
        /** @var \App\Models\User */
        $user = Auth::user();

        if (!$user->hasRole('Super Admin')) {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
        }

        $provider->delete();
        return redirect()->route('admin.providers.index')
            ->withSuccess('Provider is deleted successfully.');
    }
}
