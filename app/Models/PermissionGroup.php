<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class);
    }

    public function permissions()
    {
        return $this->hasMany(\App\Models\Permission::class);
    }
}
