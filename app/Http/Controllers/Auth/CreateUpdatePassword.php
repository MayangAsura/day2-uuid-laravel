<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class CreateUpdatePassword extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
            'password_confirm' => ['required', 'min:6']
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return response()->json([
                'response_code' => '11',
                'response_message' => 'Email tidak terdaftar',
               
            ]);
        }  
        if($request->password !== $request->password_confirm){
            return response()->json([
                'response_code' => '01',
                'response_message' => 'Password tidak sama',
            ]);     
        }
        // dd($user->id);
        User::where('id', $user->id)
        ->update([
            'password' => Hash::make($request->password) 
        ]);

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Data Tersimpan',
            'data' => $user
        ]);   

    }
}
