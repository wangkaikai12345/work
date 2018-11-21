<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Love extends Model
{

    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
