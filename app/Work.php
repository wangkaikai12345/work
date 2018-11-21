<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function system()
    {
        return $this->belongsTo(System::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function love()
    {
        return $this->belongsTo(Love::class);
    }
}
