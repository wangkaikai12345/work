<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Love extends Model
{

    use SoftDeletes;

    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
