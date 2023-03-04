<?php

namespace App\Http\Livewire\Locality;

use App\Models\Locality;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $locality;
    public $localityId;
    public $localities;
    public $nationality;
    public $type;
    public $wording;
    public $state;

    public function render()
    {
        return view('livewire.locality.create');
    }

    public function mount()
    {
        $this->locality = new Locality();
        $this->localities = [];
    }

    public function updatedType($value) {
        $_type = $value === 'country' ? 'continent' :
                    ($value === 'district' ? 'country' :
                        ($value === 'city' ? 'district' :
                            ($value === 'locality' ? 'city' : '')
                        )
                    );
        $this->localityId = '';
        $this->localities = Locality::where('type', $_type)->get();
    }

    public function saveLocality() {
        $validatedData = $this->validate([
            //'wording' => 'required|unique:localities,wording',
            'wording' => 'required',
            'type' => 'required',
            'nationality' => $this->type == 'country' ? 'required' : 'nullable'."|max:100",
            'localityId' => $this->type !== 'continent' ? 'required':'nullable',
        ]);
        $validatedData['ref'] = Str::uuid();
        $validatedData['locality_id'] = $this->localityId ? $this->localityId : null;
        $locality = Locality::create($validatedData);
        return redirect()->route('localities.create')->with('success', "La localité $locality->wording a été enregistre avec succès !!!");
    }
}
