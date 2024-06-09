<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sale::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $saleSave=new Sale($request->all());
        $results=Stock::all();
        if(count($results)==0){
            return response()->json(['resp' => false, 'msg' => 'Stock no found'], 400);
        }

        if($saleSave->collectionAmount> $results[0]->collectionAmount ){
            return response()->json(['resp' => false, 'msg' => 'The stock has less quantity than the quantity to be sold'], 400);
        }

        $saleSave->save();
        $results[0]->collectionAmount=$results[0]->collectionAmount- $saleSave->collectionAmount;

        $results[0]->save();

        return response()->json([
            'resp'=>true,
            "msg"=>"The object was saved correctly"
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sale::find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
