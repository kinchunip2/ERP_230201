<?php

namespace Modules\Project\Entities;

use Illuminate\Database\Eloquent\Model;
use AjCastro\EagerLoadPivotRelations\EagerLoadPivotTrait;

class Field extends Model
{
    use EagerLoadPivotTrait;

    protected $fillable = [];

    public function options(){
        return $this->hasMany(FieldOption::class)->withTrashed();
    }

    public function tasks(){
        return $this->belongsToMany(Task::class, FieldTask::class)->withPivot(['date', 'user_id', 'option_id']);
        

    }
}
