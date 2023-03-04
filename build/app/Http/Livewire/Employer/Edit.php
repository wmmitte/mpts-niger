<?php

namespace App\Http\Livewire\Employer;

use App\Models\Activity;
use App\Models\Locality;
use Livewire\Component;

class Edit extends Component
{
    public $employer;
    public $localities;
    public $countries;
    public $regions;
    public $branchs;

    public $countryId;
    public $regionId;

    public $secteur;
    public $raison_social;
    public $email;
    public $telephoneOne;
    public $telephoneTwo;
    public $mailbox;
    public $web_site;
    public $quarter;
    public $localityId;
    public $industry_id;

    public function render()
    {
        return view('livewire.employer.edit');
    }

    public function mount() {
        $this->localities = [];
        $this->countries = Locality::with(['localities' => function($query) {
            $query->with(['localities' => function($query) {
                $query->where('type', 'city');
            }])->where('type', 'district');
        }])->where('type', 'country')->get();

        $this->branchs = Activity::all();

        $city = $this->employer->locality;
        if($city) {
            $this->localityId = $city->id;
            $region = $city->locality;
            if($region) {
                $this->regionId = $region->id;
                if($region->locality_id) {
                    $this->countryId = $region->locality_id;
                    $this->regions = $this->findLocalities($region->locality_id, $this->countries);
                }
                if($this->regions) {
                    $this->localities = $this->findLocalities($city->locality_id, $this->regions);
                }
            }
        }

        $this->industry_id = $this->employer->industry_id;
        $this->raison_social = $this->employer->raison_social;
        $this->email = $this->employer->email;
        // dd(gettype($this->employer->phone));
        $phones = gettype($this->employer->phone) == 'string' ?
                    json_decode($this->employer->phone) :
                        $this->employer->phone;
        $this->telephoneOne = $phones[0];
        $this->telephoneTwo = $phones[1] ?? '';
        $this->mailbox = $this->employer->mailbox;
        $this->web_site = $this->employer->web_site;
        $this->quarter = $this->employer->quarter;
    }

    public function updatedCountryId($value) {
        if($value) {
            $this->regions = $this->findLocalities($value, $this->countries);
        }
        $this->regionId = null;
        $this->localityId = null;
    }

    public function updatedRegionId($value) {
        if($value) {
            $this->localities = $this->findLocalities($value, $this->regions);
        }
        $this->localityId = null;
    }

    public function findLocalities($localityId, $localities) {
        foreach ($localities as $locality) {
            if($locality->id == $localityId) {
                return $locality->localities ?? [];
            }
        }
    }


    public function saveEmployer() {
        $validatedData = $this->validate([
            'raison_social' => 'required|unique:employers,raison_social,'.$this->employer->id,
            'email' => 'required|email',
            'telephoneOne' => 'required',
            'telephoneTwo' => $this->telephoneOne ? 'nullable' : 'required',
            'mailbox' => 'nullable',
            'web_site' => 'nullable',
            'quarter' => 'nullable',
            'localityId' => 'required',
            'countryId' => 'required',
            'regionId' => 'required',
            'industry_id' => 'required',
        ]);
        $validatedData['phone'] = ["$this->telephoneOne"];
        if($this->telephoneTwo) {
            array_push($validatedData['phone'], "$this->telephoneTwo");
        }
        $validatedData['phone'] = json_encode($validatedData['phone']);
        $validatedData['locality_id'] = $this->localityId ?? null;
        $this->employer->update($validatedData);
        $employerRaisonSocial = $this->employer->raison_social;
        return redirect()->route('employers.edit', $this->employer)->with('success', "L'employeur $employerRaisonSocial a été mise à jour avec succès !!!");
    }
}
