<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Modules\Inventory\Entities\ShowRoom;


class Income extends Model
{
    protected $guarded = ['id'];

    public function showroom()
    {
        return $this->belongsTo(ShowRoom::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function account()
    {
        return $this->belongsTo(ChartAccount::class);
    }


    public static function boot()
    {
        parent::boot();
        static::saving(function ($expense) {
            $expense->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($category) {
            $expense->updated_by = Auth::user()->id ?? null;
        });
    }
}
