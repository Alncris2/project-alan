<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's address.
     */
    public function address()
    {
        return $this->hasMany(UserAddress::class);
    }

    /**
     * Get the user's main address.
     */
    public function mainAddress()
    {
        return $this->hasOne(UserAddress::class)->where('main', true);
    }

    /**
     * Get the user's main address.
     */
    public function scopeMainAddress($query)
    {
        return $query->whereHas('address', function ($query) {
            $query->where('main', true);
        });
    }

    /**
     * Get the user's main address.
     */
    public function scopeNotMainAddress($query)
    {
        return $query->whereDoesntHave('address', function ($query) {
            $query->where('main', true);
        });
    }

    /**
     * Get the user's main address.
     */
    public function scopeByAddress($query, $addressId)
    {
        return $query->whereHas('address', function ($query) use ($addressId) {
            $query->where('id', $addressId);
        });
    }

    /**
     * Get the user's main address.
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('id', $userId);
    }
}
