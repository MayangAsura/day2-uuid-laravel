<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;



class User extends Authenticatable
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
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 
        'password', 'remember_token', 'email_verified_at', 'roles_id', 
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
