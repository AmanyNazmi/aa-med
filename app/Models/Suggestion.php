<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = 'suggestions';

    protected $primaryKey = 'sugg_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'full_name',
        'role',
        'email',
        'sugg_text',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
