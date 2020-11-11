<?php

namespace App;
use App\Traits\UuidTrait;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UuidTrait;
    
    protected $guarded=[];

    protected $table = 'otp_codes';

    public function get_user_data(){
        return $this->belongsTo('App\User', 'user_id'); // user_id = FOREIGN KEY
    }

}
