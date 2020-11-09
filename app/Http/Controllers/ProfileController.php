<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller{

    public function __construct(){
        $this->middleware('auth:api');
    }
    
    public function index(){

        //ADA DI USERCONTROLLER
            
            // $profile = User::paginate(5);

            // return new ProfileCollection($profile);
    }




}
