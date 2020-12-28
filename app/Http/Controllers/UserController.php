<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Exception;

class UserController extends Controller
{
    function login(Request $req){
        
        try{   
            $user = User::where(['email'=>$req->email])->first();
            if(!$user || !Hash::check($req->password,$user->password)){
                return "Username or password is not matched";
            } else{
                $req->session()->put('user',$user);
                return redirect('/product');
            }
        } catch(Exception $ex){
            return $ex->getMessage();
        }
    }
}
