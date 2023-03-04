<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'ref',
        'name',
        'message',
        'user_id',
        'demand_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function demand()
    {
        return $this->belongsTo(Demand::class, 'demand_id');
    }
}
