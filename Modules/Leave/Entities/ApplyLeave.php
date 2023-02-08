<?php

namespace Modules\Leave\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Leave\Entities\LeaveType;
use App\User;
use Illuminate\Support\Facades\Auth;

class ApplyLeave extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function updator()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function approveUser()
    {
        return $this->belongsTo(User::class,'approved_by');
    }

    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class);
    }

    public function scopeCarryForward($query)
    {
        return $query->where(function ($query){
            $query->whereYear('start_date',Carbon::now()->subYears(1))->orWhereYear('end_date',Carbon::now()->subYears(1));
        });
    }
}
