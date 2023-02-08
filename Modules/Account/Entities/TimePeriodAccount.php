<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TimePeriodAccount extends Model
{
    protected $table = 'time_period_accounts';
    protected $guarded = ['id'];

    public function openning_balance_histories()
    {
        return $this->hasMany(OpeningBalanceHistory::class);
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
