<?php

namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CNF extends Model
{
    protected $table = 'c_n_fs';
    protected $guarded = ['id'];
    
    public static function boot()
    {
        parent::boot();
        static::saving(function ($cnf) {
            $cnf->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($cnf) {
            $cnf->updated_by = Auth::user()->id ?? null;
        });
    }
}
