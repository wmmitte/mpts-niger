<?php

namespace App\Http\Livewire\User;

use App\Mail\AdminPassword;
use App\Models\Entity;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $lastname;
    public $firstname;
    public $structures;
    public $structureId;
    public $entities;
    public $entityId;
    public $roles;
    public $role;
    public $phone;
    public $email;
    public $genre;
    public $anpeSelected;
    public $serviceInfoId;
    public $avatar;
    public $anpeId;

    public $daep;

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'role' => 'required',
        'genre' => 'required',
        'email' => 'required|email|unique:users,email',
       // 'phone' => 'required',
        'entityId' => 'nullable',
        // 'avatar' => 'nullable|image',
    ];
    public function render()
    {
        return view('livewire.user.create');
    }

    public function mount() {
        $this->entities = [];
        $_structures = [];
        $user = Auth::user();
        $userEntity = $user->entity;
        $this->daep = Entity::where('slug', Str::slug("DAEP/SMMO Ministère"))->first();
        if($user->role == 'admin' || $userEntity->entity_id == null) {
            $_structures = Entity::with('entities')->where('state', true)->where('entity_id', null)->get();
            foreach ($_structures as $_structure) {
                if($_structure->slug == 'ministere') {
                    $this->serviceInfoId = $_structure->id;
                    $this->structureId = $_structure->id;
                    $this->entities = $_structure->entities ?? [];
                    $this->roles = ['general', 'admin'];
                }
            }
        } else {
            $this->serviceInfoId = $userEntity->entity_id;
            $this->structureId = $userEntity->entity_id;
            $this->entityId = $userEntity->id;
            $this->roles = ['directeur', 'agent'];
            $this->entities = Entity::where('id', $userEntity->id)->get();
            $_structures = Entity::where('id', $userEntity->entity_id)->get();
        }
        $this->structures = $_structures;
    }

    // public function updatedRole($value) {
    //     dd($this->structures);
    // }
    public function updatedEntityId($value) {
        $this->role = '';
        $_roles = ['directeur'];
        if($this->daep->id === (int) $value) {
            array_push($_roles, 'agent');
        }
        $this->rules['entityId'] = 'required';
        if(!$value) {
            $_roles = ['general', 'admin'];
            $this->rules['entityId'] = 'nullable';
        }
        $this->roles = $_roles;
    }

    public function updatedStructureId($value) {
        foreach ($this->structures as $structure) {
            if($structure->id == $value) {
                $this->anpeSelected = $this->anpeId == $value;
                $this->roles = ['general'];
                $this->entities = $structure->entities;
            }
        }
        $this->entityId=null;
    }

    public function saveUser() {
        $validatedData = $this->validate();
        $validatedData['entity_id'] = $this->entityId ? $this->entityId :
                    ($this->role !== 'admin' ? $this->structureId : null);
        $userService = new UserService();
        // dd($validatedData);

        if($this->avatar) {
            $name = Str::slug("$this->firstname $this->lastname");
            $validatedData['avatar'] = $userService->handlerFileUpload($this->avatar, $name, 'avatar');
        }
        $password=Str::random(7);
        $validatedData['password'] = bcrypt($password);
        $validatedData['ref'] = Str::uuid();
        // dd($validatedData);
        try {
            //code...
            $user=User::create($validatedData);
            // Mail::to($user)->send(new AdminPassword($user, $password, 0));
            return redirect()->route('users.create')->with('success', 'Le profil a été créé avec succès !!!'. " Le mot de passe est  $password");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('users.show', $user)->with('warning', "Enregistre avec succès. L'envoie du mot de passe par mail a échoué.");
        }
    }


}
