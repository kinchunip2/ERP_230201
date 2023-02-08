<?php

namespace Modules\Account\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Account\Entities\AccountCategory;
use Auth;
use Modules\Purchase\Entities\ProductItemDetail;

class ChartAccount extends Model
{
    protected $fillable = ["name", 'code', 'level', "type", "description", 'is_group', "status", "parent_id", "created_by", "updated_by"];

    //category manage
    public function categories()
    {
        return $this->hasMany(ChartAccount::class, "parent_id", "id");
    }

    public function childrenCategories()
    {
        return $this->hasMany(ChartAccount::class, "parent_id", "id")->with('categories');
    }

    public function contactable()
    {
        return $this->morphTo();
    }


    public function chart_accounts()
    {
        return $this->hasMany(ChartAccount::class, "parent_id", "id");
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, "account_id");
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function parents()
    {
        return $this->hasMany(ChartAccount::class, "id", "parent_id");
    }

    public function parent()
    {
        return $this->hasOne(AccountCategory::class, 'id', 'parent_id')->withDefault();
    }

    public function children()
    {
        return $this->hasMany(ChartAccount::class, "id", "parent_id");
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

    public function scopeApproved($query)
    {
        return $query->where('is_approve', 1);
    }

    public function scopePaymentAccounts($query)
    {
        return $query->whereIn('configuration_group_id', [1, 2]);
    }

    public function scopeCashPaymentAccounts($query)
    {
        return $query->whereIn('configuration_group_id', [1]);
    }

    public function scopeBankPaymentAccounts($query)
    {
        return $query->whereIn('configuration_group_id', [2]);
    }

    public function scopePayableAccounts($query)
    {
        return $query->where('configuration_group_id', 4);
    }

    public function scopeEquityAccounts($query)
    {
        return $query->where('configuration_group_id', 5);
    }

    public function scopeRecieveAccounts($query)
    {
        return $query->where('configuration_group_id', 3);
    }

    public function scopeExpenceAccounts($query)
    {
        return $query->whereIn('configuration_group_id', [1, 2]);
    }

    public function scopeExpenceAssetAccounts($query)
    {
        return $query->where('type', 1);
    }

    public function scopeIncomeAccounts($query)
    {
        return $query->where('configuration_group_id', 4);
    }

    public function scopeLiabilityAccount($query)
    {
        return $query->where('type', '2');
    }

    public function scopeAssetAccount($query)
    {
        return $query->where('type', '1');
    }

    public function getBalanceAmountAttribute()
    {
        if ($this->type == 1 || $this->type == 3) {
            return $this->transactions->where('type', 'Dr')->sum('amount') - $this->transactions->where('type', 'Cr')->sum('amount');
        } else {
            return $this->transactions->where('type', 'Cr')->sum('amount') - $this->transactions->where('type', 'Dr')->sum('amount');
        }
    }

     public function getDebitAttribute()
    {
        if ($this->type == 1 || $this->type == 3) {
            return $this->transactions->where('type', 'Cr')->sum('amount');
        } else {
            return $this->transactions->where('type', 'Dr')->sum('amount');
        }
    }

     public function getCreditAttribute()
    {
        if ($this->type == 1 || $this->type == 3) {
            return $this->transactions->where('type', 'Dr')->sum('amount');
        } else {
            return $this->transactions->where('type', 'Cr')->sum('amount');
        }
    }

    public function getBalanceAmountByDate($type)
    {
        if (($this->type == 1 || $this->type == 3)) {
            return $this->transactions()->BalanceAmount($type)->where('type', 'Dr')->sum('amount') - $this->transactions()->BalanceAmount($type)->where('type', 'Cr')->sum('amount');
        } else {
            return $this->transactions()->BalanceAmount($type)->where('type', 'Cr')->sum('amount') - $this->transactions()->BalanceAmount($type)->where('type', 'Dr')->sum('amount');
        }
    }

}
