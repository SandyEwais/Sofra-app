<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    
    public function changePassword(){
        return view('admin.users.change-password');
    }

    public function setPassword(Request $request){
        $request->validate([
            'password_old' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::find(Auth::user()->id);
        if(Hash::check($request->password_old,$user->password)){
            $hashedPassword = Hash::make($request->password);
            $user->update([
                'password' => $hashedPassword
            ]);
            return redirect()->route('admin.home');
        }
        
        return back()->with('error','Action Failure');

    }
}
