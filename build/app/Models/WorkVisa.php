<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkVisa extends Model
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
        'numero',
        'demand_id',
        'duration',
        'start_date',
        'end_date',
        'observation',
        'withdraw_at',
        'email_comment',
        'file_url',
        'state',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'withdraw_at' => 'datetime'
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function demand()
    {
        return $this->belongsTo(Demand::class, 'demand_id');
    }
}
