<?php

namespace Modules\Inventory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\Voucher;
use Illuminate\Support\Facades\Auth;

class Expense extends Model
{
    protected $table = 'expenses';
    protected $guarded = ['id'];

    public function showroom()
    {
        return $this->belongsTo(ShowRoom::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($expense) {
            $expense->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($expense) {
            $expense->updated_by = Auth::user()->id ?? null;
        });
    }
}
