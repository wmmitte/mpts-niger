<?php

namespace App\Http\Livewire\Demand\Stepper;

use Livewire\Component;
use App\Models\Locality;
use App\Models\Employee as EmployeeModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $demand;
    public $contract;
    public $employee;

    public $countries;
    public $countryId;
    public $regions;
    public $regionId;
    public $cities;

    public $locality_id;
    public $firstname;
    public $lastname;
    public $email;
    public $nationalite;
    public $date_of_birth;
    public $residence;
    public $genre;
    public $marital_status;
    public $profession;
    public $mailbox;
    public $quartier;
    public $phone;

    public $forRenewal;


    public function render()
    {
        return view('livewire.demand.stepper.employee');
    }

    public function mount()
    {
        $this->btnName = 'Enregistrer et poursuivre';
        if(!$this->demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        $this->forRenewal = $this->demand->type === 'renouvellement';

        $this->contract = $this->demand->contract;
        if(!$this->contract) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }

        $this->cities = [];
        $this->countries = Locality::with(['localities' => function($query) {
            $query->with(['localities' => function($query) {
                $query->where('type', 'city');
            }])->where('type', 'district');
        }])->where('type', 'country')->get();

        $employee = $this->contract->employee;
        if($employee) {
            $this->btnName = 'Modifier et poursuivre';
            $this->employee = $employee;
            $this->firstname = $employee->firstname;
            $this->lastname = $employee->lastname;
            $this->email = $employee->email;
            $this->date_of_birth = $employee->date_of_birth ?
                                    Carbon::parse($employee->date_of_birth)->toDateString() : '';
            $this->residence = $employee->residence;
            $this->genre = $employee->genre;
            $this->marital_status = $employee->marital_status;
            $this->profession = $employee->profession;
            $this->mailbox = $employee->mailbox;
            $this->quartier = $employee->quartier;
            $this->phone = $employee->phone;
            $this->nationalite = $employee->nationalite;

            $locality = $employee->locality;
            if($locality) {
                $region = null;
                if($locality->type == 'city') {
                    $city = $locality;
                    $this->locality_id = $city->id;
                    $region = $city->locality;
                } else if($locality->type == 'district') {
                    $region = $locality;
                } else {
                    $this->countryId = $locality->id;
                    $this->regions = $locality->localities;
                }
                if($region) {
                    $this->regionId = $region->id;
                    if($region->locality_id) {
                        $this->countryId = $region->locality_id;
                        $this->regions = $this->findLocalities($this->countryId, $this->countries);
                    }
                    if($this->regions) {
                        $this->cities = $this->findLocalities($this->regionId, $this->regions);
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
        $this->locality_id = '';
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
        $maxDate = Carbon::now()->subYears(18)->toDateString();
        $validatedData = $this->validate([
            'regionId' => 'nullable',
            'countryId' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'date_of_birth' => 'required|date|before_or_equal:'.$maxDate,
           'residence' => 'required',
            'genre' => 'required',
            'marital_status' => 'required',
           'profession' => 'required',
            'mailbox' => 'nullable',
            'quartier' => 'nullable',
           'phone' => 'required',
            // 'locality_id' => 'required',
            'nationalite' => 'required',
        ]);

        $employee = $this->employee ?? null;

        $validatedData['locality_id'] = $this->locality_id ? $this->locality_id :
                        ($this->regionId ? $this->regionId : $this->countryId);

        if(!$employee) {
            $validatedData['ref'] = Str::uuid();
            $employee = EmployeeModel::create($validatedData);

            $this->demand->step = 3;
            $this->demand->save();

            $this->contract->employee_id = $employee->id;
            $this->contract->save();
        } else {
            $employee->update($validatedData);
        }

        return redirect()->route('demande.edit.employer', $this->demand)
                        ->with('success', !$this->employee ? 'Enregister' : 'Mise à jour'.' avec succès !!!');
    }
}
