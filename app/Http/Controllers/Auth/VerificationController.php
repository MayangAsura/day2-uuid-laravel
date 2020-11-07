<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Otp;
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
        // dd($otp->otp_code);
        if(!$otp->otp_code){
            $data['response'] = ([
                'code' => '01',
                'message' => 'OTP tidak ditemukan'
            ]);
            $data['code'] = 200;
        }else if(Carbon::now() > $otp->valid_until){
            $data['response']= ([
                'code' => '11',
                'message' => 'OTP melewati tenggat waktu'
            ]);
            $data['code'] = 200;
        }else{
            $data['response']= ([
                'code' => '00',
                'message' => 'OTP terverifikasi'
            ]);   
            $data['code'] = 200; 
        }
       
        return response()->json($data);
    }
}
