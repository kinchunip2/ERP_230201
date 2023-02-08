<?php

namespace Modules\Inventory\Entities;

use Modules\Product\Entities\ProductHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StockAdjustment extends Model
{
    protected $table = "stock_adjustments";
    protected $guarded = ['id'];
    public static function boot()
    {
        parent::boot();
        static::saving(function ($stock_adjustment) {
            $stock_adjustment->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($stock_adjustment) {
            $stock_adjustment->updated_by = Auth::user()->id ?? null;
        });
    }

    public function items()
    {
        return $this->morphMany(ProductItemDetail::class, 'itemable');
    }

    public function adjustable()
    {
        return $this->morphTo();
    }

    public function houses()
    {
        return $this->morphMany(ProductHistory::class, 'houseable');
    }

    public function stock_adjustments_products(){
        return $this->hasMany(StockAdjustmentProduct::class);
    }
}
