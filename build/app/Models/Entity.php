<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref',
        'slug',
        'wording',
        'restrict',
        'entity_id',
        'state'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'restrict' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class, 'entity_id');
    }

    public function entities()
    {
        return $this->hasMany(Entity::class, 'entity_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'entity_id');
    }

    public function demands()
    {
        return $this->hasMany(Demand::class, 'dealing_structure');
    }
}
