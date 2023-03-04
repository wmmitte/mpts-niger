<?php

namespace App\Http\Livewire\Demand\Stepper;

use App\Models\DemandHandler;
use App\Models\Entity;
use App\Models\Reason;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class Summary extends Component
{
    public $demand;
    public $reasonDgAnpe;
    public $labelAvisDgAnpe;
    public $workVisa;
    public $reasonChefDaes;
    public $labelAvisChefDaes;
    public $closedModal;

    public function render()
    {
        return view('livewire.demand.stepper.summary');
    }

    public function mount()
    {
        $this->workVisa = $this->demand->visa;
        $this->labelAvisDgAnpe = 'Avis technique du DG de l\'ANPE';
        $this->labelAvisChefDaes = 'Avis technique du chef DAES';

        ($this->demand->reasons ?? collect([]))->each(function ($item) {
            if($item->name === $this->labelAvisDgAnpe) {
                $this->reasonDgAnpe = $item->message ?? '';
            }
            if($item->name === $this->labelAvisChefDaes) {
                $this->reasonChefDaes = $item->message ?? '';
            }
        });
    }

    public function onSubmitHandler()
    {
        $this->validate([
            'reasonDgAnpe' => 'required',
            'reasonChefDaes' => 'required',
        ]);

        $this->closedModal = true;
        $reasons = array('reasonDgAnpe' => $this->reasonDgAnpe, 'reasonChefDaes' => $this->reasonChefDaes);
        foreach ($reasons as $key => $_reason) {
            $_name = $key === 'reasonDgAnpe' ? $this->labelAvisDgAnpe : $this->labelAvisChefDaes;
            $this->avisTechnique($_name, $_reason);
        }
        return redirect()->route('demande.edit.summer', $this->demand)->with('success', 'L\'avis technique du DG de l\'ANPE a été enregistré avec succès');
    }

    public function avisTechnique($name, $reason)
    {
        $user = Auth::user();
        if(count($this->demand->reasons) == 0) {
            Reason::create([
                'ref' => Str::uuid(),
                'name' => $name,
                'message' => $reason,
                'user_id' => $user->id,
                'demand_id' => $this->demand->id,
            ]);
        } else {
            foreach ($this->demand->reasons as $_reason) {
                if($_reason->name === $name) {
                    $_reason->message = $reason;
                    $_reason->save();
                    return;
                }
            }
        }
    }

    public function handlerBtn()
    {
        $reasons = $this->demand->reasons;
        if($reasons->count() < 1) {
            return redirect()->route('demande.edit.summer', $this->demand)->with('error', 'Veuillez renseigner l\'avis technique du DG de l\'ANPE');
        }
        $messageRes = "Enregister avec succès !!!";
        if($this->demand->state !== -2) {
            $this->demand->state = 0;
            $messageRes = "Mise à jour des information de la demande avec succès !!!";
        }
        $this->demand->step = 6;
        $this->demand->save();
        return redirect()->route('demands.show', $this->demand)
                        ->with('success', $messageRes);
    }
}
