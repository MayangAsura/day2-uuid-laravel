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
        

        // dd($request->photo->originalName());
        $request->validate([
            'name' => '',
            'photo' => 'mimes:jpg,jpeg,png'
        ]);

            
        // if($request->hasFile('image')){
            $image = $request->file('photo');
            // dd($image);
            $image_extention = $image->getClientOriginalExtension();
            $image_name = $user->id . "." . $image_extention;
            $image_folder = '/photos/profile/';
            $image_location = $image_folder.$image_name;

            try{
                $image->move(public_path($image_folder), $image_name);
                $user->update([
                    'name' => $request->name,
                    'photo' => $image_location
                ]);
                $data['user']= $user;

                return response()->json([
                    'response_code' => '00',
                    'response_message' => 'Berhasil Diupdate',
                    'data' => ([
                        'profile' => $user
                    ])
                ]);
            }catch(\Exception $e){

                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Photo Profil Gagal Upload',
                    'data' => $data
                ], 200);

            }
               
        // }
        
    }
        // $img_name = $request->photo->getClientOriginalName().Carbon::now();
        // $request->photo->move(public_path('image'), $img_name);

        // $user->update([
        //     'name' => request('name'),
        //     'photo' => $img_name
          
        // ]);
        
    
        

}
