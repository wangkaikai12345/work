<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    //
    public function works()
    {
        return $this->hasMany(Work::class);
    }
}
