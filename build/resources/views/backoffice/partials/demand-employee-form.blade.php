<div class="row">
    <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="lastname">
                Nom <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('lastname') is-invalid @enderror" wire:model="lastname"
                    value="{{ old('lastname') }}" id="lastname" name="lastname" placeholder="Renseignez le nom">
                @error('lastname')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="firstname">
                Prenom(s) <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('firstname') is-invalid @enderror"
                    wire:model="firstname" value="{{ old('firstname') }}" id="firstname" name="firstname"
                    placeholder="Renseignez le(s) prenom(s)">
                @error('firstname')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-2">
        <div class="form-group row">
            <label class="col-12" for="genre">
                Sexe <span class="text-danger">*</span>
            </label>
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
    <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="date_of_birth">
                Date de naissance <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="date" class="form-control  @error('date_of_birth') is-invalid @enderror"
                    max="{{\Carbon\Carbon::now()->subYears(18)->toDateString()}}" wire:model="date_of_birth"
                    value="{{ old('date_of_birth') }}" id="date_of_birth" name="date_of_birth"
                    placeholder="Renseignez la date">
                @error('date_of_birth')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="marital_status">
                Situation matrimoniale <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="marital_status" class="form-control @error('marital_status') is-invalid @enderror"
                    id="marital_status" name="marital_status">
                    <option value="">Choisir la situation matrimoniale</option>
                    <option value="celibataire" @if (old('marital_status') == 'celibataire' || $marital_status == 'celibataire') selected @endif>Celibataire</option>
                    <option value="marie" @if (old('marital_status') == 'marie' || $marital_status == 'marie') selected @endif>Marié(e)</option>
                    <option value="divorce" @if (old('marital_status') == 'divorce' || $marital_status == 'divorce') selected @endif>Divorcé(e)</option>
                    <option value="veuf" @if (old('marital_status') == 'veuf' || $marital_status == 'veuf') selected @endif>Veuf/veuve</option>
                </select>
                @error('marital_status')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="nationalite">
                Nationalité <span class="text-danger">*</span>
            </label>
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
            <label class="col-12" for="email">
                Adresse mail <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('email') is-invalid @enderror" wire:model="email"
                    value="{{ old('email') }}" id="email" name="email" placeholder="Renseignez l'adresse email">
                @error('email')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="phone">
                Numero de téléphone <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('phone') is-invalid @enderror" wire:model="phone"
                    value="{{ old('phone') }}" id="phone" name="phone" placeholder="Renseignez le phone">
                @error('phone')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="residence">
                Résidence <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('residence') is-invalid @enderror"
                    wire:model="residence" value="{{ old('residence') }}" id="residence" name="residence"
                    placeholder="Renseignez la residence">
                @error('residence')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="profession">
                Profession <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('profession') is-invalid @enderror"
                    wire:model="profession" value="{{ old('profession') }}" id="profession" name="profession"
                    placeholder="Renseignez la profession">
                @error('profession')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="mailbox">
                Boite postale
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('mailbox') is-invalid @enderror"
                    wire:model="mailbox" value="{{ old('mailbox') }}" id="mailbox" name="mailbox"
                    placeholder="Renseignez le boite">
                @error('mailbox')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="countryId">
                Pays de provenance <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="countryId" class="form-control @error('countryId') is-invalid @enderror"
                    id="countryId" name="countryId">
                    <option value="">Choisir le pays de provenance</option>
                    @foreach ($countries as $country)
                        <option value={{ $country->id }} @if (old('countryId') == $country->id || $countryId == $country->id) selected @endif>
                            {{ $country->wording }}</option>
                    @endforeach
                </select>
                @error('countryId')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @if ($countryId)
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="regionId">
                    Région de provenance
                </label>
                <div class="col-12">
                    <select wire:model="regionId" class="form-control @error('regionId') is-invalid @enderror"
                        id="regionId" name="regionId">
                        <option value="">Choisir la région de provenance</option>
                        @foreach ($regions as $region)
                            <option value={{ $region->id }} @if (old('regionId') == $region->id || $regionId == $region->id) selected @endif>
                                {{ $region->wording }}</option>
                        @endforeach
                    </select>
                    @error('regionId')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
    @if ($regionId)
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="locality_id">
                    Ville de provenance
                </label>
                <div class="col-12">
                    <select wire:model="locality_id" class="form-control @error('locality_id') is-invalid @enderror"
                        id="locality_id" name="locality_id">
                        <option value="">Choisir la ville de provenance</option>
                        @foreach ($cities as $city)
                            <option value={{ $city->id }} @if (old('locality_id') == $city->id || $locality_id == $city->id) selected @endif>
                                {{ $city->wording }}</option>
                        @endforeach
                    </select>
                    @error('locality_id')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
    @if ($locality_id)
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="quartier">
                    Adresse
                </label>
                <div class="col-12">
                    <input type="text" class="form-control  @error('quartier') is-invalid @enderror"
                        wire:model="quartier" value="{{ old('quartier') }}" id="quartier" name="quartier"
                        placeholder="Renseignez l'adresse">
                    @error('quartier')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>
