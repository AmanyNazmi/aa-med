<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $table = 'medicines';

    protected $primaryKey = 'med_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'med_name',
        'med_use',
        'side_eff',
        'med_warning',
        'preg_warning',
        'alter_med',
        'pres_required',
    ];

    protected $casts = [
        'pres_required' => 'boolean',
        'created_at'    => 'datetime',
        'updated_at'    => 'datetime',
    ];
}
