@extends('layouts.back.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h2 class="content-heading">Modification profil compte</h2>
            </div>
        </div>
        <div class="block">
            <div class="block-content">
                <form action="{{ route('account.info.update') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="form-group row">
                                <label class="col-12" for="lastname">Nom</label>
                                <div class="col-12">
                                    <input type="text" class="form-control  @error('lastname') is-invalid @enderror"
                                        value="{{ old('lastname') ?? $userForm->lastname }}" id="lastname" name="lastname"
                                        placeholder="Renseigner le nom">
                                    @error('lastname')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-5">
                            <div class="form-group row">
                                <label class="col-12" for="firstname">Prenom(s)</label>
                                <div class="col-12">
                                    <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                        value="{{ old('firstname') ?? $userForm->firstname }}" id="firstname"
                                        name="firstname" placeholder="Renseigner le(s) prénom(s)">
                                    @error('firstname')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group row">
                                <label class="col-12" for="genre">Le genre</label>
                                <div class="col-12">
                                    <select class="form-control @error('genre') is-invalid @enderror" id="genre"
                                        name="genre">
                                        <option value="">Choisir le genre</option>
                                        <option value="male" @if (old('genre') == 'male' || $userForm->genre == 'male') selected @endif>Masculin
                                        </option>
                                        <option value="female" @if (old('genre') == 'female' || $userForm->genre == 'female') selected @endif>Fénimin
                                        </option>
                                        <option value="none" @if (old('genre') == 'none' || $userForm->genre == 'none') selected @endif>Non definir
                                        </option>
                                    </select>
                                    @error('genre')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-4">
                            <div class="form-group row">
                                <label class="col-12" for="email">Adresse mail</label>
                                <div class="col-12">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                                        value="{{ $userForm->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                            <div class="form-group row">
                                <label class="col-12" for="role">Role</label>
                                <div class="col-12">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                                        value="@include('backoffice.partials.role-name', [
                                            'role' => $userForm->role,
                                        ])">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-sm-12 col-lg-4">
                        <div class="form-group row">
                            <label class="col-12" for="structureId">Structure</label>
                            <div class="col-12">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                        <div class="form-group row">
                            <label class="col-12" for="entityId">Service / direction</label>
                            <div class="col-12">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
                            </div>
                        </div>
                    </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <button class="btn btn-secondary" type="submit">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                        Mettre à jour
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
