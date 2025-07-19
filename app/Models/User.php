<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @property int $id The unique identifier for the user.
 * @property string $name The name of the user.
 * @property string $email The email address of the user.
 * @property string $password The hashed password of the user.
 * @property \Illuminate\Support\Carbon|null $email_verified_at The timestamp when the user's email was verified.
 *                                                              * @property string|null $remember_token The token used for "remember me" functionality.
 *                                                              * @property string|null $uuid The unique identifier for the user.
 *                                                              * @property \Illuminate\Support\Carbon|null $created_at The timestamp when the user was created.
 *                                                              * @property \Illuminate\Support\Carbon|null $updated_at The timestamp when the user was last updated.
 *
 **/
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    #[\Override]
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
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Role, $this>
     */
    public function roles(): BelongsToMany
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

    public function getAllPermissions(): \Illuminate\Support\Collection
    {
        $permissions = collect();
        foreach ($this->roles()->get() as $role) {
            $permissions = $permissions->merge($role->permissions()->with('permissionGroup')->get());
        }

        return $permissions;
    }

    public function permissions(Application $application): \Illuminate\Support\Collection
    {
        // Where Permissions Group Application ID is equal to the application ID
        return $this->getAllPermissions()->where('permissionGroup.application_id', $application->id)->pluck('unique_name');
    }

    public function hasPermission(string $permission): bool
    {
        $application = Application::where('name', 'Auth')->first();

        return $this->permissions($application)->contains($permission);
    }

    public function passkeys(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Passkey::class);
    }
}
