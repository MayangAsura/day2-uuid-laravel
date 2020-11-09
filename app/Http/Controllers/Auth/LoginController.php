<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
        ]);

        $token = Auth::attempt($request->only('email', 'password'));
        if(!$token){
            return response()->json(null, 401);
        }
    
        $user = User::where('email', $request->email)->first();
        // dd($user);
        if(!$user){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Email tidak terdaftar'
            ]);
        }
        return response()->json([
            'response_code' => '00',
            'response_message' => 'Berhasil Login',
            'data' => ([
                'token' => $token,
                'user' => $user
            ])
        ]);
       
        
        // return response()->json(compact('token'));
    }
}
