<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref',
        'firstname',
        'lastname',
        'genre',
        'email',
        'password',
        'avatar',
        'role',
        'lock',
        'is_update_password',
        'phone',
        'entity_id'
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
        'is_update_password' => 'boolean',
        'lock' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    /**
     * Scope a query to only include
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeHasRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function demands()
    {
        return $this->hasMany(Demand::class, 'user_id');
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class, 'user_id');
    }

    public function handlers()
    {
        return $this->hasMany(DemandHandler::class, 'user_id');
    }
}
