<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Auth')->group(function(){
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::post('verification', 'VerificationController');
    Route::post('regenerate_otp', 'RegenerateOtpController');
    Route::post('create_update_password', 'CreateUpdatePassword');

});

Route::group(['auth:api'], function () {
    Route::get('profile/get_profile', 'UserController@index');
    Route::patch('profile/update', 'UserController@update');
});

// Route::get('user', 'UserController');

