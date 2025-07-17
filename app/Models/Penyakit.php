<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Penyakit extends Model
{
    protected $guarded = [];

    function roles()
    {
        return $this->hasMany(Role::class);
    }
}
