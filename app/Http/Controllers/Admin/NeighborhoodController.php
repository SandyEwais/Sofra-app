<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Neighborhood;
use Illuminate\Http\Request;

class NeighborhoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $neighborhoods = Neighborhood::latest()->filter(request(['search']))->paginate(6);
        return view('admin.neighborhoods.index',compact('neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.neighborhoods.create');
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
            'name' => 'required|unique:neighborhoods,name',
            'city_id' => 'required'
        ]);
        Neighborhood::create($request->all());
        return redirect()->route('neighborhoods.index')->with('message','Action Success !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Neighborhood $neighborhood)
    {
        return view('admin.neighborhoods.edit',[
            'neighborhood' => $neighborhood
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Neighborhood $neighborhood)
    {
        $request->validate([
            'name' => 'required|unique:neighborhoods,name,'.$neighborhood->id
        ]);
        $neighborhood->update($request->all());
        return redirect()->route('neighborhoods.index')->with('message','Action Success !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Neighborhood $neighborhood)
    {
        $neighborhood->delete();
        return redirect()->route('neighborhoods.index')->with('message','Action Success !');
        
    }
}
