<?php

namespace App\Http\Controllers;

use App\Models\Slaughterhouse;
use Illuminate\Http\Request;

class SlaughterhouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Slaughterhouse::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slaughterHouseObjectSave= new Slaughterhouse($request->all());
        $slaughterHouseObjectSave->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slaughterhouse=Slaughterhouse::find($id);
        return $slaughterhouse;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $slaughterhouse=Slaughterhouse::find($id);
        $slaughterhouse->name=$request->name;
        $slaughterhouse->prepaidAmount=$request->prepaidAmount;
        $slaughterhouse->location=$request->location;
        $slaughterhouse->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Slaughterhouse::destroy($id);
    }
}
