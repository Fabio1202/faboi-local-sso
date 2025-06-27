<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permission extends Model
{
    // use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'id',
        'permission_group_id',
        'permission_group',
    ];

    protected $appends = [
        'permission_group_unique_name',
    ];

    public function getPermissionGroupUniqueNameAttribute(): string
    {
        // Check if permission group is already loaded
        $unload = ! $this->relationLoaded('permissionGroup');
        $uniqueName = $this->permissionGroup->unique_name;
        if ($unload) {
            $this->unsetRelation('permissionGroup');
        }

        return $uniqueName;
    }

    /**
     * Get the permission group that owns the permission.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<\App\Models\PermissionGroup, $this>
     */
    public function permissionGroup(): BelongsTo
    {
        return $this->belongsTo(PermissionGroup::class);
    }
}
