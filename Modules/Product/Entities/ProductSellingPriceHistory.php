<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Modules\Purchase\Entities\Purchase;

class ProductSellingPriceHistory extends Model
{
    protected $table = "product_selling_price_histories";
    protected $guarded = ['id'];

    public function productSku()
    {
        return $this->belongsTo(ProductSku::class)->withDefault();
    }

    public function purchase_order()
    {
        return $this->belongsTo(Purchase::class)->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by')->withDefault();
    }
}
