<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class PermissionGroup
 *
 * Represents a group of permissions in the system.
 *
 * @property string $id The unique identifier for the permission group.
 * @property string $name The name of the permission group.
 * @property string $description A description of the permission group.
 * @property string $unique_name A unique name for the permission group.
 * @property \Illuminate\Support\Carbon|null $created_at The timestamp when the permission group was created.
 * @property \Illuminate\Support\Carbon|null $updated_at The timestamp when the permission group was last updated.
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions The permissions associated with this group.
 */
class PermissionGroup extends Model
{
    // use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'id',
    ];

    #[\Override]
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

    public function permissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Permission::class);
    }
}
