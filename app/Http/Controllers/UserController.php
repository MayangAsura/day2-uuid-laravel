<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileCollection;
use App\Http\Resources\ProfileResource;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        
        if($request->hasFile('photo')){
            dd($request->photo->getClientOriginalName());
        }

        $path = "";
        
        $user->update([
            'name' => request('name'),
            'photo' => $path
          
        ]);

        return new ProfileResource($user);     
    }
        

}
