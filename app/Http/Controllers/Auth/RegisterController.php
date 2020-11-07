<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User, App\Otp;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
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
            'name' => ['string', 'required'],
            'email' => ['email', 'required', 'unique:users,email']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        $user =  User::where('email', $request->email)->first();
        Otp::create([  
            'user_id' => $user->id,
            'otp_code' => mt_rand(100000, 999999),
            'valid_until' => now()->addMinutes(5)
        ]);

        $data['user'] = ([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        
        return response()->json([
            'response_code' => '00',
            'response_message' => 'OTP silakan cek email',
            'data' => $data
        ]);

        // return response()->json([
        //     'name' =>  $request->name,
        //     'email' =>  $request->email
        // ]);
    }

    

}
