<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Traits\HasSpatial;


class UserAddress extends Authenticatable
{
    use HasFactory;
    use HasSpatial;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'country',
        'zip_code',
        'location',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'location' => Point::class,
        ];
    }

    /**
     * Get the user that owns the address.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the address.
     */
    public function scopeMain($query)
    {
        return $query->where('main', true);
    }

    /**
     * Get the user that owns the address.
     */
    public function scopeNotMain($query)
    {
        return $query->where('main', false);
    }

    /**
     * Get the user that owns the address.
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the user that owns the address.
     */
    public function scopeByLocation($query, $latitude, $longitude)
    {
        return $query->where('location', 'ST_GeomFromText(\'POINT(' . $latitude . ' ' . $longitude . ')\')');
    }
}
