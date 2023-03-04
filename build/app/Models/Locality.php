<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locality extends Model
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
        'type',
        'nationality',
        'flat',
        'locality_id',
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

    public function locality()
    {
        return $this->belongsTo(Locality::class, 'locality_id');
    }

    public function localities()
    {
        return $this->hasMany(Locality::class, 'locality_id');
    }

    public function grouplocalities()
    {
        return $this->belongsToMany(GroupLocality::class,);
    }

    public function employees() {
        return $this->hasMany(Employee::class, 'locality_id');
    }

    public function contrats() {
        return $this->hasMany(Contract::class, 'locality_id');
    }
}
