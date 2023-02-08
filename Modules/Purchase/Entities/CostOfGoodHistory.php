<?php
namespace Modules\Purchase\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\ProductSku;
use Auth;

class CostOfGoodHistory extends Model
{
    protected $table = 'cost_of_goods_histories';
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        static::created(function ($model) {
            $model->created_by = Auth::id();
            $model->save();
        });
        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id ?? null;
        });
    }

    public function costable()
    {
        return $this->morphTo();
    }

    public function storeable()
    {
        return $this->morphTo();
    }

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class);
    }
}
