<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="raison_social">
                Raison sociale <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text"class="form-control  @error('raison_social') is-invalid @enderror"
                    wire:model="raison_social" value="{{ old('raison_social') }}" id="raison_social" name="raison_social"
                    placeholder="Renseignez la raison sociale">
                @error('raison_social')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="industry_id">
                Branche d'activité <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="industry_id" class="form-control @error('industry_id') is-invalid @enderror"
                    id="industry_id" name="industry_id">
                    <option value="">Choisir la branche d'activité</option>
                    @foreach ($branchs as $branch)
                        <option value={{ $branch->id }} @if (old('industry_id') == $branch->id || $industry_id == $branch->id) selected @endif>
                            {{ $branch->wording }}</option>
                    @endforeach
                </select>
                @error('industry_id')
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
                <input type="email"class="form-control  @error('email') is-invalid @enderror" wire:model="email"
                    value="{{ old('email') }}" id="email" name="email" placeholder="Renseignez l'adresse mail">
                @error('email')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="telephoneOne">
                Téléphone 1 <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text"class="form-control  @error('telephoneOne') is-invalid @enderror"
                    wire:model="telephoneOne" value="{{ old('telephoneOne') }}" id="telephoneOne" name="telephoneOne"
                    placeholder="Renseignez le numéro téléphone">
                @error('telephoneOne')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="telephoneTwo">
                Téléphone 2 @if (!$telephoneOne)
                    <span class="text-danger">*</span>
                @endif
            </label>
            <div class="col-12">
                <input type="texte"class="form-control  @error('telephoneTwo') is-invalid @enderror"
                    wire:model="telephoneTwo" value="{{ old('telephoneTwo') }}" id="telephoneTwo" name="telephoneTwo"
                    placeholder="Renseignez le numéro téléphone">
                @error('telephoneTwo')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="mailbox">
                Boite postale {{-- <span class="text-danger">*</span> --}}
            </label>
            <div class="col-12">
                <input type="text"class="form-control  @error('mailbox') is-invalid @enderror" wire:model="mailbox"
                    value="{{ old('mailbox') }}" id="mailbox" name="mailbox"
                    placeholder="Renseignez la boite postale">
                @error('mailbox')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="web_site">
                URL Site web
            </label>
            <div class="col-12">
                <input type="text"class="form-control  @error('web_site') is-invalid @enderror" wire:model="web_site"
                    value="{{ old('web_site') }}" id="web_site" name="web_site"
                    placeholder="Renseignez l'adresse du site">
                @error('web_site')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="countryId">
                Pays <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="countryId" class="form-control @error('countryId') is-invalid @enderror"
                    id="countryId" name="countryId">
                    <option value="">Choisir le pays</option>
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
                    Région <span class="text-danger">*</span>
                </label>
                <div class="col-12">
                    <select wire:model="regionId" class="form-control @error('regionId') is-invalid @enderror"
                        id="regionId" name="regionId">
                        <option value="">Choisir la région</option>
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
                <label class="col-12" for="localityId">
                    Ville <span class="text-danger">*</span>
                </label>
                <div class="col-12">
                    <select wire:model="localityId" class="form-control @error('localityId') is-invalid @enderror"
                        id="localityId" name="localityId">
                        <option value="">Choisir la ville</option>
                        @foreach ($localities as $locality)
                            <option value={{ $locality->id }} @if (old('localityId') == $locality->id || $localityId == $locality->id) selected @endif>
                                {{ $locality->wording }}</option>
                        @endforeach
                    </select>
                    @error('localityId')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
    @if ($localityId)
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="quarter">Adresse</label>
                <div class="col-12">
                    <input type="text"class="form-control  @error('quarter') is-invalid @enderror"
                        wire:model="quarter" value="{{ old('quarter') }}" id="quarter" name="quarter"
                        placeholder="Renseignez l'adresse">
                    @error('quarter')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>
