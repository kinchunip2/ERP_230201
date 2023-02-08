<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\ChartAccount;
use Auth;

class OpeningBalanceHistory extends Model
{
    protected $table = 'opening_balance_histories';
    protected $guarded = ['id'];

    public function time_period_account()
    {
        return $this->belongsTo(TimePeriodAccount::class, 'time_period_account_id')->withDefault();
    }

    public function account()
    {
        return $this->belongsTo(ChartAccount::class, 'account_id','id')->withDefault();
    }

    public static function boot()
    {
        parent::boot();
        static::saving(function ($modal) {
            $modal->created_by = Auth::user()->id ?? null;
        });

        static::created(function ($modal) {
            $modal->code = Auth::user()->id ?? null;
        });

        static::updating(function ($modal) {
            $modal->updated_by = Auth::user()->id ?? null;
        });
    }
}
