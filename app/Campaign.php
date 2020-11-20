<?php

namespace App;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use UuidTrait;

    protected $guarded= [];
}
