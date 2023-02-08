<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;

class PdfFont extends Model
{
    protected $fillable = ['name','font_file','bold_file','italic_file','is_active'];
}
