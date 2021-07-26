<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Validator;

class AdminController extends Controller
{
    public function login(Request $request){
        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            config(['auth.guards.api.provider' => 'admin']);
            $user = Auth::guard('admin')->user();
            $resArr['token'] = $user->createToken('admin-application',['admin'])->accessToken;
            $resArr['name']= $user->name;
            return response()->json($resArr,200);
        }else{
            return response()->json(['error' => 'Unauthorized Access'], 203);
        }
    }
    public function dashboard(){
        return 'Hello world';
    }
}
