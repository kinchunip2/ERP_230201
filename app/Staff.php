<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Modules\Inventory\Entities\WareHouse;
use Modules\Inventory\Entities\ShowRoom;
use Modules\Payroll\Entities\Payroll;
use Modules\Setup\Entities\Department;
use Modules\Setup\Entities\IntroPrefix;

class Staff extends Model
{
    protected $table = 'staffs';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(WareHouse::class)->withDefault();
    }

    public function showroom()
    {
        return $this->belongsTo(ShowRoom::class)->withDefault();
    }

    public function department()
    {
        return $this->belongsTo(Department::class)->withDefault();
    }

    public static function boot()
    {
        $into_prefix = IntroPrefix::find(8);

        parent::boot();
        static::created(function ($model) use($into_prefix) {
            $id = sprintf('%05d', $model->id);
            $model->employee_id =  $into_prefix ? $into_prefix->prefix.'-3'.$id : 'EMP-'.$id;
            $model->save();
        });
    }

    public function payrolls(){
        return $this->hasMany(Payroll::class, 'staff_id', 'id');
    }
}
