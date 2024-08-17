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

    public static function boot()
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
    public function roles()
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

    public function getAllPermissions()
    {
        $permissions = collect();
        foreach ($this->roles()->get() as $role) {
            $permissions = $permissions->merge($role->permissions()->with('permissionGroup')->get());
        }
        return $permissions;
    }

    public function permissions($application)
    {
        // Where Permissions Group Application ID is equal to the application ID
        return $this->getAllPermissions()->where('permissionGroup.application_id', $application->id)->pluck('unique_name');
    }

    public function hasPermission($permission)
    {
        $application = Application::where('name', 'auth')->first();
        return $this->permissions($application)->contains($permission);
    }
}
