<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
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
        'firstname',
        'lastname',
        'email',
        'date_of_birth',
        'residence',
        'nationalite',
        'genre',
        'marital_status',
        'profession',
        'mailbox',
        'quartier',
        'phone',
        'locality_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class, 'locality_id');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'employee_id');
    }
}
