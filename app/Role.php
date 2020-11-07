<?php

namespace App;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use UuidTrait;
    
    protected $guarded=[];

    
}
