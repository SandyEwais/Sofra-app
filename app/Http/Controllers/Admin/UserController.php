<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->except(1);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'password' => 'required|confirmed'
        ]);
        $request->merge(['password'=> bcrypt($request->password)]);
        $user = User::create($request->all());
        $user->assignRole($request->role_id);
        return redirect()->route('users.index')->with('message','Action Success !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role_id' => 'required',
        ]);
        $user->update($request->all());
        $user->syncRoles($request->role_id);
        return redirect()->route('users.index')->with('message','Action Success !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->delete();
       return redirect()->route('users.index')->with('message','Action Success');
    }







    ////////////////////////////////
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
