<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
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
        'raison_social',
        'email',
        'phone',
        'mailbox',
        'web_site',
        'quarter',
        'etat',
        'is_verifed',
        'user_id',
        'locality_id',
        'industry_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'state' => 'boolean',
        'phone' => 'array',
        'is_verifed' => 'boolean',
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
        return $this->hasOne(Contract::class, 'employer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function industry()
    {
        return $this->belongsTo(Activity::class, 'industry_id');
    }
}
