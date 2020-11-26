<?php

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
    Route::post('logout', 'LogoutController')->middleware('auth:api');
    Route::post('check-token', 'CheckTokenController')->middleware('auth:api');
});

Route::group(['auth:api'], function () {
    Route::get('profile/get_profile', 'UserController@index');
    Route::patch('profile/update', 'UserController@update');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'campaign'
], function () {
    Route::get('/random/{count}', 'CampaignController@random');
    Route::post('store', 'CampaignController@store');
    Route::get('', 'CampaignController@index');
    Route::get('/{id}', 'CampaignController@detail');
    Route::get('/search/{keyword}', 'CampaignController@search');
});
Route::group([
    'middleware' => 'api',
    'prefix' => 'blog'
], function () {
    Route::get('random/{count}', 'BlogController@random');
    Route::post('store', 'BlogController@store');
});

