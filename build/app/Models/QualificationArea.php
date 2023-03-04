<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QualificationArea extends Model
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

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'qualification_area_id');
    }
}
