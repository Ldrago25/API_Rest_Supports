<?php

namespace App\Http\Controllers;

use App\Models\Skin;
use App\Models\Slaughterhouse;
use Illuminate\Http\Request;

class SkinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Skin::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $skinObject = new Skin($request->all());

        $skinObject->save();

        if (is_null($skinObject->id) && empty($skinObject->id)) {
            return response()->json(['resp' => false, 'msg' => 'Fatal save skin'], 400);
        }
        $slaughter = Slaughterhouse::find($skinObject->idSlaughterHouse);
        $newAmount =$slaughter->prepaidAmount -   $skinObject->collectionAmount;
        if ($newAmount < 0) {
            Skin::destroy($skinObject->id);
            return response()->json(['resp' => false, 'msg' => 'There are fewer hides in this slaughterhouse than the number of skins entering'], 400);
        }
        $slaughter->prepaidAmount = $newAmount;
        $slaughter->save();

        return response()->json(['resp' => true, 'msg' => 'Object save successfull'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = Skin::find($id);
        return $result;
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
        $skinObject = new Skin($request->all());

        $skinUpdate = Skin::find($id);


        $skinUpdate->collectionAmount += $skinObject->collectionAmount;
        $skinUpdate->save();

        $slaughter=Slaughterhouse::find($skinUpdate->idSlaughterHouse);
        $newAmount = $slaughter->prepaidAmount - $skinObject->collectionAmount;
        if ($newAmount < 0) {
            return response()->json(['resp' => false, 'msg' => 'There are fewer hides in this slaughterhouse than the number of skins entering'], 400);
        }
        $slaughter->prepaidAmount = $newAmount;
        $slaughter->save();

        return response()->json(['resp' => true, 'msg' => 'Object update successfull'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Skin::destroy($id);
        return response()->json([
            'resp' => true,
            'msg' => 'The object was delete correctly'
        ]);
    }
}
