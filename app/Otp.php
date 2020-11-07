<?php

namespace App;
use App\Traits\UuidTrait;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use UuidTrait;
    
    protected $guarded=[];

    protected $table = 'otp_codes';

}
