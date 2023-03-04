<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
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
        'secteur',
        'reason',
        'has_recours',
        'reason_recours',
        'applicant_fullname',
        'applicant_genre',
        'applicant_nationalite',
        'applicant_phone',
        'applicant_email',
        'nom_ministre',
        'activity_sector_id',
        'industry_id',
        'contract_id',
        'dealing_structure', //id structure traitant la demande
        'user_id',
        'date_decision',
        'ref_couriel',
        'numero_couriel',
        'objet_couriel',
        'paragraphe_one_couriel',
        'paragraphe_two_couriel',
        'paragraphe_three_couriel',
        'paragraphe_four_couriel',
        'paragraphe_five_couriel',
        'am_one_couriel',
        'am_two_couriel',
        'am_three_couriel',
        'step',
        'state'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_decision' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'ref';
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function industry()
    {
        return $this->belongsTo(Activity::class, 'industry_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activitySector()
    {
        return $this->belongsTo(Activity::class, 'activity_sector_id');
    }

    public function demandFiles()
    {
        return $this->hasMany(DemandFile::class, 'demand_id');
    }

    public function visa()
    {
        return $this->hasOne(WorkVisa::class, 'demand_id');
    }

    public function reasons()
    {
        return $this->hasMany(Reason::class, 'demand_id')->orderBy('id','desc');;
    }

    public function dealingStructure()
    {
        return $this->belongsTo(Entity::class, 'dealing_structure');
    }

    public function structures()
    {
        return $this->hasMany(DemandHandler::class, 'demand_id');
    }
}
