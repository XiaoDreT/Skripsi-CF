<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    function gejala()
    {
        return $this->belongsTo(Gejala::class);
    }
}
