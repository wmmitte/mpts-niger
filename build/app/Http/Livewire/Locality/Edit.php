<?php

namespace App\Http\Livewire\Locality;

use App\Models\Locality;
use Livewire\Component;

class Edit extends Component
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
        return view('livewire.locality.edit');
    }

    public function mount() {
        $this->localities = [];
        if($this->locality->type !== 'continent') {
            $this->localityByType($this->locality->type);
        }
        $this->type = $this->locality->type;
        $this->wording = $this->locality->wording;
        $this->nationality = $this->locality->nationality;
        $this->localityId = $this->locality->locality_id ?? '';
    }

    public function updatedType($value) {
        $this->localityByType($value);
    }
    public function localityByType($type) {
        $_type = $type === 'country' ? 'continent'
                : ($type === 'district' ? 'country'
                    : ($type === 'city' ? 'district' :
                        ($type === 'locality' ? 'city' : '')
                    )
                );
        $this->localityId = '';
        $this->localities = Locality::where('type', $_type)->get();
    }

    public function updateLocality() {
        $validatedData = $this->validate([
            //'wording' => 'required|unique:localities,wording,'.$this->locality->id,
            'wording' => 'required',
            'type' => 'required',
            'nationality' => $this->type == 'country' ? 'required' : 'nullable'."|max:100",
            'localityId' => $this->type !== 'continent' ? 'required':'nullable',
        ]);

        $validatedData['locality_id'] = $this->localityId ? $this->localityId : null;
        $this->locality->update($validatedData);
        $localityWording = $this->locality->wording;
        return redirect()->route('localities.edit', $this->locality)->with('success', "La localité $localityWording a été mise à jour avec succès !!!");
    }
}
