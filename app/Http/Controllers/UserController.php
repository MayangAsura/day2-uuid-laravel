<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileCollection;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        
        $profile = User::paginate(5);

        return new ProfileCollection($profile);
    }

    public function update(Request $request, User $user){
        
        dd($request->photo->originalName());
        $request->validate([
            'photo' => ['mimes:jpg,png,jpeg']
        ]);

        $img_name = $request->photo->getClientOriginalName().Carbon::now();
        $request->photo->move(public_path('image'), $img_name);

        $user->update([
            'name' => request('name'),
            'photo' => $img_name
          
        ]);

        return response()->json([
            'response_code' => '00',
            'response_message' => 'Berhasil Diupdate',
            'data' => ([
                'profile' => $user
            ])
        ]);   
    }
        

}
