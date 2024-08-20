<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermissionGroup extends Model
{
    //use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // If id is from type string, then it is a uuid
            if (is_string($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }

    public function application(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Application::class);
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Permission::class);
    }
}
