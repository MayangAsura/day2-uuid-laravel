<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User, App\Otp;


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

        $data_request = $request->all();
        $user = User::create($data_request);
   
        $user =  User::where('email', $request->email)->first();
        $otp = Otp::where('user_id', $user->id)->first();
  
        // Mail::to($request->email)->send(new UserRegisterMail($otp));
        // dd($otp->get_user_data->email);
        event(new UserRegisterEvent($otp, $user));

        $data['user'] = $user;
        
        return response()->json([
            'response_code' => '00',
            'response_message' => 'OTP silakan cek email',
            'data' => $data
        ]);
    }

    

}


     //TIDAK PERLU PAKAI INI LAGI, SUDAH ADA EVENT CREATED DI MODEL USER
        // $user =  User::where('email', $request->email)->first();
        // Otp::create([  
        //     'user_id' => $user->id,
        //     'otp_code' => mt_rand(100000, 999999),
        //     'valid_until' => now()->addMinutes(5)
        // ]);
