<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $timestamps = false;

    public function states(){
        return $this->hasMany(State::class);
    }
}

