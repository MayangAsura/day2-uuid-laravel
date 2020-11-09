<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, UuidTrait;

    protected function get_guest_id(){
        $role = Role::where('name', 'user')->first();
        return $role->id;
    }

    public static function boot(){
        parent::boot();
        static::creating(function($model){
            $model->roles_id = $model->get_guest_id();
        });

        //DIPANGGIL KETIKA TABEL USER SUDAH DI CREATE
        static::created(function($model){
            $model->generate_otp_code();
        });
    }

    public function generate_otp_code(){
        
        do{
            $random = mt_rand(100000, 999999);
            $check = Otp::where('otp', $random)->first();
        }while($check);
        {
            $otp_code = Otp::updateOrCreate(
                ['user_id' => $this->id],
                ['otp' => '$random', 'valid_until' => Carbon::now()->addMinutes(5)]
            );
        }
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'photo', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 
        'password', 'remember_token', 'roles_id', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
