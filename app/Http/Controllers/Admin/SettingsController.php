<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $settings = Settings::first();
        return view('admin.settings.index',compact('settings'));
    }

    public function edit(Settings $settings){
        return view('admin.settings.edit',[
            'settings' => $settings
        ]);
    }
    public function update(Settings $settings){
        
    }
}
