<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Method login for user
     *  @return StockModel
    */
    public function getStock(){
        $results=Stock::all();
        if(is_null($results)){
            return response()->json(['resp' => false, 'msg' => 'Stock no found'], 400);
        }
        return $results[0];
    }
}
