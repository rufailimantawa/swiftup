<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('verified');
    }

    public function changePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'old_password' => 'required|current_password',
                'password' => 'required|min:8|confirmed'
            ]);

            /** @var \App\Models\User */
            $user = Auth::user();

            $user->fill([
                'password' => Hash::make($request->input('password'))
            ])->save();
            
            return back()->withSuccess("Password changed successfully");
        }

        return view('user.change-password', [
            'pageTitle' => "User — Change Password | " . config('app.name')
        ]);
    }

    public function changePin(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'pin' => 'required|digits:4|confirmed',
                'password' => 'required|current_password'
            ]);

            /** @var \App\Models\User */
            $user = Auth::user();

            $user->fill([
                'pin' => Hash::make($request->input('pin'))
            ])->save();

            return back()->withSuccess("PIN updated successfully");
        }

        return view('user.change-pin', [
            'pageTitle' => "User — Change PIN | " . config('app.name')
        ]);
    }

    public function dashboard() {
        return view('user.dashboard', [
            'pageTitle' => "Dashboard | SwiftUp",
            'system' => [
                'airtime_min' => 50,
                'airtime_max' => 50000,
            ],
        ]);
    }

    public function profile()
    {
        return view('user.profile', [
            'pageTitle' => "User — Profile | " . config('app.name')
        ]);
    }

    public function edit(Request $request)
    {
        if ($request->isMethod('POST')) {
            /** @var \App\Models\User */
            $user = Auth::user();
            $request->validate([
                'fullname' => "required|string|min:3|max:50",
                'username' => [
                    "required",
                    "string",
                    "min:3",
                    "max:50",
                    Rule::unique(
                        'users',
                        'username'
                    )->ignore($user->username, 'username')
                ],
                'mobile_number' => [
                    "required",
                    "phone:NG",
                    "min:3",
                    "max:50",
                    Rule::unique(
                        'users',
                        'mobile_number'
                    )->ignore($user->mobile_number, 'mobile_number')
                ],
                'gender' => [
                    'nullable',
                    Rule::in('male', 'female')
                ],
            ]);

            $user->fill(
                $request->only(
                    'fullname',
                    'username',
                    'mobile_number',
                    'gender'
                )
            )->save();

            return back()->withSuccess("Profile updated successfully");
        }

        return view('user.edit', [
            'pageTitle' => "User — Edit Profile | " . config('app.name')
        ]);
    }
}
