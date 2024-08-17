<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Role extends Model
{
    use Searchable;
    //use HasFactory;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class)->withTimestamps();
    }

    public function permissions()
    {
        return $this->belongsToMany(\App\Models\Permission::class)->withTimestamps();
    }
}
