<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $successStatus = 200;
    
    public function login()
    { 
        if(Auth::attempt(['usuario' => request('usuario'), 'password' => request('password')])){ 

            $user = Auth::user(); 
            $success['token'] =  $user->createToken('Gestor')-> accessToken; 

            return response()->json(['success' => $success], $this-> successStatus); 

        } else { 
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }
    
    public function getUser(Request $request) 
    {   
        
        $user = Auth::user();
        $usuario = Usuario::find($user->id);

        return response()->json(['success' => $usuario], $this->successStatus); 
    }
}
