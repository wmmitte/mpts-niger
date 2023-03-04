<?php

namespace App\Http\Livewire\Employer;

use App\Models\Activity;
use App\Models\Employer;
use App\Models\Locality;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $localities;
    public $regions;
    public $countries;
    public $branchs;

    public $countryId;
    public $regionId;

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
        return view('livewire.employer.create');
    }

    public function mount() {
        $this->localities = [];
        $this->countries = Locality::with(['localities' => function($query) {
            $query->with(['localities' => function($query) {
                $query->where('type', 'city');
            }])->where('type', 'district');
        }])->where('type', 'country')->get();

        $this->branchs = Activity::all();
    }

    public function updatedCountryId($value) {
        if($value) {
            foreach ($this->countries as $country) {
                if($country->id == $value) {
                    $this->regions = $country->localities ?? [];
                }
            }
        }
        $this->regionId = null;
        $this->localityId = null;
    }

    public function updatedRegionId($value) {
        if($value) {
            foreach ($this->regions as $region) {
                if($region->id == $value) {
                    $this->localities = $region->localities ?? [];
                }
            }
        }
        $this->localityId = null;
    }

    public function saveEmployer() {
        $validatedData = $this->validate([
            'raison_social' => 'required|unique:employers,raison_social',
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
        $validatedData['ref'] = Str::uuid();
        $validatedData['phone'] = ["$this->telephoneOne"];
        $validatedData['is_verifed'] = Auth::user() ? Auth::user()->id : null;
        if($this->telephoneTwo) {
            array_push($validatedData['phone'], "$this->telephoneTwo");
        }
        $validatedData['phone'] = json_encode($validatedData['phone']);
        $validatedData['locality_id'] = $this->localityId ?? null;
        $employer = Employer::create($validatedData);
        return redirect()->route('employers.create')->with('success', "L'employeur $employer->raison_social a été enregistré avec succès !!!");
    }
}
