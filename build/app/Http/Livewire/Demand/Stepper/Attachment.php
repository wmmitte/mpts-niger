<?php

namespace App\Http\Livewire\Demand\Stepper;

use App\Models\DemandFile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Attachment extends Component
{
    use WithFileUploads;


    public $demand;
    public $attachments;

    public $wording;
    public $type;
    public $attach;

    public function render()
    {
        return view('livewire.demand.stepper.attachment');
    }
    public function mount()
    {
        if(!$this->demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        $attachments = $this->demand->demandFiles;
        if(count($attachments) > 0) {
            $this->attachments = $attachments;
        }
    }

    public function saveFile()
    {
        $validatedData = $this->validate([
            'type' => 'required',
            'wording' => 'required',
            'attach' => 'required|file|mimes:pdf',
        ]);
        $validatedData['ref'] = Str::uuid();
        $validatedData['demand_id'] = $this->demand->id;
        $validatedData['url_file'] = $this->attach->store('demande_files');
        DemandFile::create($validatedData);

        if($this->demand->step !== 5) {
            $this->demand->step = 5;
            // $this->demand->state = 0;
            $this->demand->save();
        }
        return redirect()->route('demande.edit.piece', $this->demand)->with('success', 'Enregistrer avec succès.');
    }

    public function handlerBtn()
    {
        $this->demand->step = 5;
        // $this->demand->state = 0; // si summer exist commenter cette ligne sinon afficher
        $this->demand->save();
        // revoir le return et le redirer vers summer
        // return redirect()->route('demands.show', $this->demand)
        //                 ->with('success', 'Enregister avec succès !!!');

        return redirect()->route('demande.edit.summer', $this->demand)
                        ->with('success', 'Pièce prise en compte avec succès !!!');
    }
}
