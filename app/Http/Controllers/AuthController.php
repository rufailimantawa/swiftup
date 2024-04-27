<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Propaganistas\LaravelPhone\PhoneNumber;

class AuthController extends Controller
{
    use AuthorizesRequests;

    /**
     * Instantiate a new AuthController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'forgotPassword'
        ]);
    }
    /**
     * Display a registration form.
     *
     */
    public function register(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'fullname' => "required|string|min:3|max:50",
                'email' => 'required|email:filter|max:250|unique:users',
                'username' => "required|string|min:3|max:50|unique:users",
                'mobile_number' => "required|phone:NG|min:3|max:50|unique:users",
                'password' => 'required|min:8|confirmed'
            ]);
            
            $user = User::create([
                'fullname' => $request->fullname,
                'email' => $request->email,
                'username' => $request->username,
                'mobile_number' => str_replace(
                    " ",
                    "",
                    (
                        new PhoneNumber($request->mobile_number, "NG")
                    )->formatNational()
                ),
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));
            Auth::attempt(
                $request->only('email', 'password'),
                true
            );
            $request->session()->regenerate();

            return redirect()->route("verification.notice");
        }

        return view('auth.register', [
            'pageTitle' => "Create account | SwiftUp"
        ]);
    }

    /**
     * Display a login form.
     *
     */
    public function login(Request $request)
    {
        $errors = false;

        if ($request->isMethod('POST')) {

            $request->validate([
                'email' => "required|email",
                'password' => "required"
            ]);

            if (Auth::attempt($request->only(['email', 'password']), true)) {
                $request->session()->regenerate();

                return redirect()->route('user.dashboard');
            }
            
            return back()
                ->withErrors(['err' => ""])
                ->withInput($request->only(['email']));
        }

        return view('auth.login', [
            'pageTitle' => "Login | SwiftUp",
            'err' => $errors
        ]);
    }

    /**
     * Display a reset password form.
     */
    public function forgotPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate(['email' => 'required|email']);
    
            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
        }

        return view("auth.forgot-password", [
            'pageTitle' => "Forgot Password | SwiftUp"
        ]);
    }

    function resetPassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);
         
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));
    
                    $user->save();
    
                    event(new PasswordReset($user));
                }
            );
         
            return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
        }

        return view('auth.reset-password', [
            'pageTitle' => "Password Reset | " . config('app.name'),
            'email' => $request->input('email'),
            'token' => $request->input('token'),
        ]);
    }

    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect("/");
    }
}
