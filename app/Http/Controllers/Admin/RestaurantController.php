<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::latest()->filter(request(['search']))->paginate(6);
        return view('admin.restaurants.index',compact('restaurants'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        return view('admin.restaurants.show',[
            'restaurant' => $restaurant
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('restaurants.index')->with('message','Action Success !');
        
    }

    public function activate(Restaurant $restaurant){
        if($restaurant->activation == 0){
            $restaurant->update([
                'activation' => 1
            ]);
            return redirect()->route('restaurants.index')->with('message','Action Success !');
        }
        
    }
    public function deactivate(Restaurant $restaurant){
        if($restaurant->activation == 1){
            $restaurant->update([
                'activation' => 0
            ]);
            return redirect()->route('restaurants.index')->with('message','Action Success !');
        }
    }
}
