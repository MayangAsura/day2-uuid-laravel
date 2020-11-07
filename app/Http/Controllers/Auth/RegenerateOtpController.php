<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Otp;

class RegenerateOtpController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request){
        
        $request->validate([
            'email' => ['email', 'required']
        ]);

        $user =  User::where('email', $request->email)->first();
        Otp::where('user_id', $user->id)
        ->update([  
            'otp_code' => mt_rand(100000, 999999),
            'valid_until' => now()->addMinutes(5)
        ]);

        return response()->json([
            'response_code' => 00,
            'response_message' => 'Silahkan cek email untuk melihat kode OTP',
            'data' => $user
        ]);
    }
}
