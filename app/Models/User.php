<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            if (Schema::hasColumn('users', 'uuid')) {
                $model->uuid = Str::uuid();
            }
        });
    }

    /**
     * Get the roles for the user.
     */
    public function roles() : \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Role::class)->withTimestamps();
    }

    /**
     * Check if the user has a role.
     *
     * @return bool
     */
    public function hasRole(string $role)
    {
        return $this->roles()->where('name', $role)->exists();
    }

    public function getAllPermissions() : \Illuminate\Support\Collection
    {
        $permissions = collect();
        foreach ($this->roles()->get() as $role) {
            $permissions = $permissions->merge($role->permissions()->with('permissionGroup')->get());
        }
        return $permissions;
    }

    public function permissions(Application $application) : \Illuminate\Support\Collection
    {
        // Where Permissions Group Application ID is equal to the application ID
        return $this->getAllPermissions()->where('permissionGroup.application_id', $application->id)->pluck('unique_name');
    }

    public function hasPermission(Permission $permission): bool
    {
        $application = Application::where('name', 'auth')->first();
        return $this->permissions($application)->contains($permission);
    }

    public function passkeys(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Passkey::class);
    }
}
