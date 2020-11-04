<?php

namespace App;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use UuidTrait;
    
    protected $guarded=[];

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
