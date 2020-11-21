<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use UuidTrait;

    protected $guarded=[];
}
