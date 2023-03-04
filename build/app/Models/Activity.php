<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'ref',
        'wording',
        'secteur',
        'description',
        'activity_id',
        'state'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'state' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'activity_id');
    }

    public function demandIndustry()
    {
        return $this->hasMany(Demand::class, 'industry_id');
    }

    public function employer()
    {
        return $this->hasMany(Employer::class, 'industry_id');
    }

    // public function demandActivitySector()
    // {
    //     return $this->hasMany(Demand::class, 'activity_sector_id');
    // }
}
