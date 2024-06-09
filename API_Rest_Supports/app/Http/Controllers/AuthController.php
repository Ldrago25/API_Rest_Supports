<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class AuthController extends Controller
{
    /**
     * Method login for user
     *  @return userModel
    */
    public function login(Request $request){
        error_log( is_null($request->email));
        error_log(empty($request->password));

        if((is_null($request->email) || empty($request->email))  ||   (is_null($request->password) || empty($request->password)) ){
            return response()->json([
                'resp'=>false,

                'msg'=>'Missing data'
            ],400);
        }

        $result=User::where('email',$request->email)->first();

        if(is_null($result)){
            return response()->json([
                'resp'=>false,
                'msg'=>'User no found'
            ]);
        }

        if($request->password != $result->password){

                return response()->json([
                    'resp'=>false,
                    'msg'=>'Password is no equals'
                ],400);

        }

        return $result;
    }
}
