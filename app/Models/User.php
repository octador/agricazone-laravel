<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'lastname',
        'address',
        'postalcode',
        'city',
        'phone',
        'role_id',
        'email',
        'password',
        'remember_token'
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


    public const ROLE_OPTIONS = [
        1 => 'admin',
        2 => 'agriculteur',
        3 => 'customer',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role_id == 1 && $this->hasVerifiedEmail();
    }
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
