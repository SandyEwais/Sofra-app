<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(){
        $settings = Settings::first();
        return view('admin.settings.index',compact('settings'));
    }

    public function update(Request $request, Settings $setting){
        $request->validate([
            'about_text' => 'required',
            'accounts' => 'required',
            'commission' => 'required'
        ]);
        $setting->update($request->all());
        return redirect()->route('settings.index')->with('message','Action Success !');
    }
}
