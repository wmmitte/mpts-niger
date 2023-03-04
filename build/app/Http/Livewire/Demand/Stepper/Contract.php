<?php

namespace App\Http\Livewire\Demand\Stepper;

use App\Models\Locality;
use App\Models\Contract as ContractModel;
use App\Models\ProfessionalCategory;
use App\Models\QualificationArea;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class Contract extends Component
{
    public $demand;
    public $contract;

    public $countries;
    public $countryId;
    public $regions;
    public $regionId;
    public $cities;
    public $qualificationAreas;
    public $professionalCategories;

    public $job;
    public $type;
    public $time;
    public $salaire;
    public $pending;
    public $date_fin;
    public $date_debut;
    public $locality_id;
    public $employer_id;
    public $employee_id;
    public $qualification_area_id;
    public $professional_category_id;

    public $cityId;
    public $btnName;
    public $localityId;

    public function render()
    {
        return view('livewire.demand.stepper.contract');
    }

    public function mount()
    {
        $this->btnName = 'Enregistrer et poursuivre';
        if(!$this->demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        $this->cities = [];
        $this->countries = Locality::with(['localities' => function($query) {
            $query->with(['localities' => function($query) {
                $query->where('type', 'city');
            }])->where('type', 'district');
        }])->where('type', 'country');
        $niger = $this->countries->where('id', 33)->first();
        $this->countryId = $niger ? $niger->id : '';
        if($niger) {
            $this->regions = $niger->localities ?? [];
        }
        $this->countries = $this->countries->get();


        $this->qualificationAreas = QualificationArea::where('state', true)->get();
        $this->professionalCategories = ProfessionalCategory::where('state', true)->get();

        $contract = $this->demand->contract;
        if($contract) {
            $this->btnName = 'Modifier et poursuivre';
            $this->contract = $contract;
            $this->type = $contract->type;
            $this->job = $contract->job;
            $this->locality_id = $contract->locality_id;
            $this->time = $contract->time;
            $this->date_fin = $contract->date_fin ?
                                Carbon::parse($contract->date_fin)->toDateString() : '';
            $this->date_debut = $contract->date_debut ?
                                Carbon::parse($contract->date_debut)->toDateString() : '';
            $this->salaire = $contract->salaire;
            $this->qualification_area_id = $contract->qualification_area_id;
            $this->professional_category_id = $contract->professional_category_id;

            $locality = $contract->locality;
            if($locality) {
                if($locality->type == 'city') {
                    $city = $locality;
                    $this->localityId = $city->id;
                    $region = $city->locality;
                } else {
                    $region = $locality;
                }
                if($region) {
                    $this->regionId = $region->id;
                    if($region->locality_id && !$niger) {
                        $this->regions = $this->findLocalities($region->locality_id, $this->countries) ?? [];
                    }
                    if($this->regions) {
                        $this->cities = $this->findLocalities($region->id, $this->regions) ?? [];
                    }
                }
            }
        }
    }

    public function updatedCountryId($value) {
        if($value) {
            $this->regions = $this->findLocalities($value, $this->countries);
        }
        $this->regionId = null;
        $this->cityId = null;
    }

    public function updatedRegionId($value) {
        if($value) {
            $this->cities = $this->findLocalities($value, $this->regions);
        }
        $this->cityId = null;
    }

    public function findLocalities($countryIdSelect, $countries) {
        foreach ($countries as $country) {
            if($country->id == $countryIdSelect) {
                return $country->localities ?? [];
            }
        }
    }

    public function handlerBtn()
    {
        $validatedData = $this->validate([
            'type' => 'required',
            'salaire' => 'required|integer',
            'date_debut' => 'required|date',
            'time' => 'required|integer',
            'date_fin' => 'nullable|date',
            // 'locality_id' => 'required',
            // 'countryId' => 'required',
            'regionId' => 'required',
            'job' => 'required',
            'qualification_area_id' => 'required',
            'professional_category_id' => 'required',
        ]);
        $contract = $this->contract ?? null;
        $dateDebut = Carbon::parse($this->date_debut);
        // $dateFin = Carbon::parse($this->date_fin);
        // $validatedData['time'] = $dateDebut->diffInMonths($dateFin);
        $validatedData['date_fin'] = $dateDebut->addMonth($this->time);
        $validatedData['locality_id'] = $this->locality_id ? $this->locality_id : $this->regionId;

        if(!$contract) {
            $validatedData['ref'] = Str::uuid();
            $contract = ContractModel::create($validatedData);

            $this->demand->step = 2;
            $this->demand->contract_id = $contract->id;
            $this->demand->save();
        } else {
            $contract->update($validatedData);
        }

        return redirect()->route('demande.edit.employee', $this->demand)
                        ->with('success', !$this->contract ? 'Enregister' : 'Mise à jour'.' avec succès !!!');
    }
}
