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

class Edit extends Component
{
    use WithFileUploads;

    public $user;
    public $lastname;
    public $firstname;
    public $phone;
    public $structures;
    public $structureId;
    public $entities;
    public $entityId;
    public $roles;
    public $role;
    public $email;
    public $genre;
    public $avatar;

    public $daep;

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'role' => 'required',
        'genre' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'entityId' => 'nullable',
        // 'avatar' => 'nullable|image',
    ];

    public function render()
    {
        return view('livewire.user.edit');
    }

    public function mount()
    {
        $user = Auth::user();
        $userEntity = $user->entity;
        $this->entities = [];
        // $_anpeSelected = false;
        $this->daep = Entity::where('slug', Str::slug("DAEP/SMMO Ministère"))->first();
        $entitySelect = $this->user->entity;
        $structureSelect = $entitySelect ? $entitySelect->entity ?? $entitySelect : null;
        $this->structureId = $structureSelect ? $structureSelect->id : $userEntity->entity->id ?? 0;
        if($user->role == 'admin' || $userEntity->entity_id == null) {
            $_structures = Entity::with('entities')->where('entity_id', null)->where('state', true)->get();
            foreach ($_structures as $_structure) {
                if($_structure->slug == $structureSelect->slug) {
                    $this->entities = $_structure->entities ?? [];
                }
            }
        } else {
            $this->entities = Entity::where('id', $userEntity->id)->get();
            $_structures = Entity::where('id', $userEntity->entity_id)->get();
        }
        $this->structures = $_structures;
        $this->roles = $entitySelect->entity ? ($this->daep->id === (int) $entitySelect->entity->id ? ['directeur', 'agent'] : ['directeur']) : ['general', 'admin'];

        $this->firstname = $this->user->firstname;
        $this->lastname = $this->user->lastname;
        $this->email = $this->user->email;
        $this->genre = $this->user->genre;
        $this->avatar = $this->user->avatar;
        $this->role = $this->user->role;
        $this->phone = $this->user->phone;
        $this->entityId = $this->user->entity_id;
    }

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
        // if($this->serviceInfoId == $value && $this->anpeSelected) {
        //     $_roles = ['admin', 'agent'];
        // }
        $this->roles = $_roles;
    }

    public function updatedStructureId($value) {
        foreach ($this->structures as $structure) {
            if($structure->id == $value) {
                // $this->anpeSelected = $this->anpeId == $value;
                $this->roles = ['general', 'admin'];
                $this->entities = $structure->entities;
            }
        }
        $this->entityId=null;
    }

    public function updateUser() {
        $validatedData = $this->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'genre' => 'required',
            'entityId' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            // 'avatar' => 'nullable|image',
        ]);
        $validatedData['entity_id'] = $this->entityId ? $this->entityId :
                    ($this->role !== 'admin' ? $this->structureId : null);
        $userService = new UserService();
        if($this->avatar) {
            $name = Str::slug("$this->firstname $this->lastname");
            $validatedData['avatar'] = $userService->handlerFileUpload($this->avatar, $name, 'avatar');
        }

        try {
            $password = null;
            if($this->user->email !== $this->email && !$this->user->email_verified_at) {
                $password=Str::random(7);
                $validatedData['password'] = bcrypt($password);
            }
            $this->user->update($validatedData);
            // if($password) {
            //     Mail::to($this->user)->send(new AdminPassword($this->user, $password, 1));
            // }
            return redirect()->route('users.edit', $this->user)->with('success', 'Mise à jour avec succès !!!'. " Le mot de passe est  $password");
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->route('users.show', $this->user)->with('warning', "Enregistre avec succès. L'envoie du mot de passe par mail a échoué.");
        }
    }
}
