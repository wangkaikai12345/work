<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
