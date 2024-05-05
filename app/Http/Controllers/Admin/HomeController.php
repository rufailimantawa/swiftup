<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("permission:role:create|role:edit|role:delete");
    }

    public function index()
    {
        return view('admin.index', [
            'pageTitle' => "Admin Home | " . config('app.name'),
            'stats' => [
                'list' => [
                    [
                        'name' => 'Users',
                        'icon' => 'fa-users',
                        'count' => number_format(User::get()->count()),
                    ],
                    [
                        'icon' => 'fa-voicemail',
                        'name' => 'Airtime Sold',
                        'count' => number_format(0),
                    ],
                    [
                        'icon' => 'fa-wifi',
                        'name' => 'Data Sold',
                        'count' => number_format(0),
                    ],
                    [
                        'name' => 'Transactions',
                        'icon' => 'fa-receipt',
                        'count' => number_format(0),
                    ],
                ]
            ]
        ]);
    }
}
