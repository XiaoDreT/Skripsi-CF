<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    protected $guarded = [];

    function gejala(){
        return $this->belongsTo(Gejala::class);
    }
}
