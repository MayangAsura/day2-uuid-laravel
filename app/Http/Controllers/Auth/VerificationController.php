<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Otp, App\User;
use Illuminate\Support\Carbon;

class VerificationController extends Controller
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
            'otp_code' => ['alpha_num', 'required'],
        ]);

        $otp = Otp::where('otp_code', $request->otp_code)->first();
        
        if(!$otp){

            return response()->json([
                'response_code' => '01',
                'response_message' => 'OTP tidak ditemukan'
            ], 200);
            // $data['response'] = ([
            //     'code' => '01',
            //     'message' => 'OTP tidak ditemukan'
            // ]);
            // $data['code'] = 200;

        }else if(Carbon::now() > $otp->valid_until){
             
            return response()->json([
                'response_code' => '11',
                'response_message' => 'OTP tidak berlaku, silahkan generate ulang'
            ], 200);

        }else{

            // $user = User::where('id', $otp->user_id)
            // ->update([
            //     'email_verified_at' => Carbon::now()
            // ]);
            $user = User::find($otp->user_id);
            $user->email_verified_at = Carbon::now();
            $user->save();
            //DELETE AGAR TIDAK PENUHIN DATABASE
            $otp->delete();

            return response()->json([
                'code' => '00',
                'message' => 'OTP terverifikasi',
                'data' => $user
            ], 200);

        }
       
        
    }
}
