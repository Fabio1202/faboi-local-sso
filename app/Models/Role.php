<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Role extends Model
{
    use Searchable;
    // use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsToMany<User, $this>
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class)->withTimestamps();
    }

    /**
     * @return BelongsToMany<\App\Models\Permission, $this>
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Permission::class)->withTimestamps();
    }
}
