<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="type">
                Type de demande <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="type" class="form-control @error('type') is-invalid @enderror" id="type"
                    name="type">
                    <option value="">Choisir le type</option>
                    <option value="nouvelle" @if (old('type') == 'nouvelle' || $type == 'nouvelle') selected @endif>Nouvelle</option>
                    <option value="renouvellement" @if (old('type') == 'renouvellement' || $type == 'renouvellement') selected @endif>Renouvellement
                    </option>
                </select>
                @error('type')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="activity_sector_id">
                Secteur d'activité du demandeur
            </label>
            <div class="col-12">
                <select wire:model="secteur" class="form-control @error('secteur') is-invalid @enderror" id="secteur"
                    name="secteur">
                    <option value="">Choisir le secteur du demandeur</option>
                    <option value="primaire" @if (old('secteur') == 'primaire' || $secteur == 'primaire') selected @endif>Primaire</option>
                    <option value="secondaire" @if (old('secteur') == 'secondaire' || $secteur == 'secondaire') selected @endif>Secondaire</option>
                    <option value="tertiaire" @if (old('secteur') == 'tertiaire' || $secteur == 'tertiaire') selected @endif>Tertiaire</option>
                </select>
                @error('secteur')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

        </div>
    </div> --}}
    {{--  @if ($secteur) --}}
    {{-- <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="industry_id">
                Branche d'activité du demandeur<span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="industry_id" class="form-control @error('industry_id') is-invalid @enderror"
                    id="industry_id" name="industry_id">
                    <option value="">Choisir la branche du demandeur</option>
                    @foreach ($branchs as $branch)
                        <option value={{ $branch->id }} @if (old('activity') == $branch->id || $industry_id == $branch->id) selected @endif>
                            {{ $branch->wording }}</option>
                    @endforeach
                </select>
                @error('industry_id')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div> --}}
    {{-- @endif --}}
</div>
<hr />
<div class="row">
    <div class="col-12">
        <h5 class="font-w400">
            <strong>Information sur l'employeur</strong> - <span class="text-danger font-size-xs">*</span>
            <span class="font-size-xs">Champs requis</span>
        </h5>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="applicant_fullname">
                Nom & prénom(s) <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('applicant_fullname') is-invalid @enderror"
                    wire:model="applicant_fullname" value="{{ old('applicant_fullname') }}" id="applicant_fullname"
                    name="applicant_fullname" placeholder="Renseignez le nom et prenom ">
                @error('applicant_fullname')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="genre">Sexe </label>
            <div class="col-12">
                <select wire:model="genre" class="form-control @error('genre') is-invalid @enderror" id="genre"
                    name="genre">
                    <option value="">Choisir le sexe</option>
                    <option value="male" @if (old('genre') == 'male' || $genre == 'male') selected @endif>Masculin</option>
                    <option value="female" @if (old('genre') == 'female' || $genre == 'female') selected @endif>Feminin</option>
                </select>
                @error('genre')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="nationalite">Nationalité</label>
            <div class="col-12">
                <select wire:model="nationalite" class="form-control @error('nationalite') is-invalid @enderror"
                    id="nationalite" name="nationalite">
                    <option value="">Choisir le nationalité</option>
                    @foreach ($countries as $country)
                        <option value={{ $country->nationality }} @if (old('nationalite') == $country->nationality || $nationalite == $country->nationality) selected @endif>
                            {{ $country->nationality }}</option>
                    @endforeach
                </select>
                @error('nationalite')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="applicant_phone">
                Téléphone <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('applicant_phone') is-invalid @enderror"
                    wire:model="applicant_phone" value="{{ old('applicant_phone') }}" id="applicant_phone"
                    name="applicant_phone" placeholder="Renseignez le téléphone">
                @error('applicant_phone')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="applicant_email">
                E-mail <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="email" class="form-control  @error('applicant_email') is-invalid @enderror"
                    wire:model="applicant_email" value="{{ old('applicant_email') }}" id="applicant_email"
                    name="applicant_email" placeholder="Renseignez l'adresse mail">
                @error('applicant_email')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
