<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::latest()->filter(request(['search']))->paginate(6);
        return view('admin.clients.index',compact('clients'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('message','Action Success !');
        
    }

    public function activate(Client $client){
        if($client->activation == 0){
            $client->update([
                'activation' => 1
            ]);
            return redirect()->route('clients.index')->with('message','Action Success !');
        }
        
    }
    public function deactivate(Client $client){
        if($client->activation == 1){
            $client->update([
                'activation' => 0
            ]);
            return redirect()->route('clients.index')->with('message','Action Success !');
        }
    }
}
