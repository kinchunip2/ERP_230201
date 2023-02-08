<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelType extends Model
{
    protected $table = "models";
    protected $fillable = ["name", "description", "status", "created_by", "updated_by"];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            $model->created_by = Auth::user()->id ?? null;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id ?? null;
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'model_id', 'id');
    }
}
