<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Coupon extends Model
{
    protected $guarded = ['id'];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($brand) {
            $brand->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($brand) {
            $brand->updated_by = Auth::user()->id ?? null;
        });
    }
}
