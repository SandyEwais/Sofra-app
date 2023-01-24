<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(){
        return view('admin.login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
    public function forgotPassword(){
        return view('admin.forgot-password');
    }
    public function requestPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $user = User::where('email',$request->email)->first();
        $code = rand(1111111,9999999);
        //dd($code);
        $user->update(['pin_code' => $code]);
        //email
        Mail::to($user->email)->send(new ResetPassword($code));
        return redirect()->route('reset_password_view');
    }
    public function resetPasswordView(){
        return view('admin.reset-password');
    }
    public function resetPassword(Request $request){
        $request->validate([
            'pin_code' => 'required|NotIn:0',
            'password' => 'required|confirmed'
        ]);
        $user = User::where('pin_code',$request->pin_code)->first();
        $user->pin_code = null;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('login');

    }


    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
