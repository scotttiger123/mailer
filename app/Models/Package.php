<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
