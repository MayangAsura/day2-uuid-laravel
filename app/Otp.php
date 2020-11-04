<?php

namespace App;
use App\Traits\UuidTrait;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UuidTrait;
    
    protected $guarded=[];

    protected $table = 'otp_codes';

    protected static function boot(){
        parent::boot();
        UuidTrait::bootUuidTrait();
    }

    public function getIncrementing(){
        return false;
    }

    public function getKeyType(){
        return 'string';
    }
}
