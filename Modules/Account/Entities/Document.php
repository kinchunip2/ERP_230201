<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Voucher;

class Document extends Model
{
    protected $guarded = ['id'];
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
