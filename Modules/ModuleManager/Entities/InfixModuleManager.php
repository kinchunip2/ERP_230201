<?php

namespace Modules\ModuleManager\Entities;

use Illuminate\Database\Eloquent\Model;

class InfixModuleManager extends Model
{
    protected $table = 'infix_module_managers';
    protected $fillable = ['name','email','notes','version','purchase_code','installed_domain','activated_date'];
}
