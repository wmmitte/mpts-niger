<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
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
        'type',
        'time',
        'salaire',
        'date_debut',
        'date_fin',
        'employer_id',
        'employee_id',
        'locality_id',
        'professional_category_id',
        'qualification_area_id',
        'job',
        'pending'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'pending' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function locality()
    {
        return $this->belongsTo(Locality::class, 'locality_id');
    }
    public function employer() {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function demands() {
        return $this->hasOne(Demand::class, 'contract_id');
    }

    public function professionalCategory()
    {
        return $this->belongsTo(ProfessionalCategory::class, 'professional_category_id');
    }

    public function qualificationArea()
    {
        return $this->belongsTo(QualificationArea::class, 'qualification_area_id');
    }
}
