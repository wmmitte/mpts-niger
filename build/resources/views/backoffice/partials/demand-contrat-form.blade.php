@php
    $minDate = $date_debut
        ? \Carbon\Carbon::parse($date_debut)
            ->addMonth()
            ->toDateString()
        : '';
    $maxDate = $date_fin
        ? \Carbon\Carbon::parse($date_fin)
            ->subMonth()
            ->toDateString()
        : '';
@endphp

<div class="row">
    <div class="col-sm-12 col-lg-2">
        <div class="form-group row">
            <label class="col-12" for="type">
                Type de contrat <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="type" class="form-control @error('type') is-invalid @enderror" id="type"
                    name="type">
                    <option value="CDD">Type de contrat</option>
                    <option value="CDD" @if (old('type') == 'CDD' || $type == 'CDD') selected @endif>CDD</option>
                    {{-- <option value="CDI" @if (old('type') == 'CDI' || $type == 'CDI') selected @endif>CDI</option> --}}
                </select>
                @error('type')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="job">
                Poste à occuper par l'employé <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="text" class="form-control  @error('job') is-invalid @enderror" wire:model="job"
                    value="{{ old('job') }}" id="job" name="job" placeholder="Renseignez le poste">
                @error('job')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="salaire">
                Salaire <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <input type="number" class="form-control  @error('salaire') is-invalid @enderror" wire:model="salaire"
                    value="{{ old('salaire') }}" id="salaire" name="salaire" placeholder="Renseignez le salaire">
                @error('salaire')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="date_debut">
                Date de début du contrat
            </label>
            <div class="col-12">
                <input type="date" class="form-control  @error('date_debut') is-invalid @enderror"
                    max="{{ $maxDate }}" wire:model="date_debut" value="{{ old('date_debut') }}" id="date_debut"
                    name="date_debut" placeholder="Renseignez la date">
                @error('date_debut')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="date_fin">
                Date de fin du contrat
            </label>
            <div class="col-12">
                <input type="date" class="form-control  @error('date_fin') is-invalid @enderror"
                    min="{{ $minDate }}" wire:model="date_fin" value="{{ old('date_fin') }}" id="date_fin"
                    name="date_fin" placeholder="Renseignez la date">
                @error('date_fin')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div> --}}
    <div class="col-sm-12 col-lg-3">
        <div class="form-group row">
            <label class="col-12" for="time">
                Durée du contrat (en nombre mois)
            </label>
            <div class="col-12">
                <input type="number" min="1" class="form-control  @error('time') is-invalid @enderror"
                    min="{{ $minDate }}" wire:model="time" value="{{ old('time') }}" id="time"
                    name="time" placeholder="Renseignez la durée">
                @error('time')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="professional_category_id">
                Catégorie professionnelle <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="professional_category_id"
                    class="form-control @error('professional_category_id') is-invalid @enderror"
                    id="professional_category_id" name="professional_category_id">
                    <option value="">Choisir la catégorie professionnelle</option>
                    @foreach ($professionalCategories as $professionalCategory)
                        <option value={{ $professionalCategory->id }}
                            @if (old('professional_category_id') == $professionalCategory->id ||
                                $professional_category_id == $professionalCategory->id) selected @endif>
                            {{ $professionalCategory->wording }}</option>
                    @endforeach
                </select>
                @error('professional_category_id')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="qualification_area_id">
                Domaine de qualification <span class="text-danger">*</span>
            </label>
            <div class="col-12">
                <select wire:model="qualification_area_id"
                    class="form-control @error('qualification_area_id') is-invalid @enderror" id="qualification_area_id"
                    name="qualification_area_id">
                    <option value="">Choisir le domaine de qualification</option>
                    @foreach ($qualificationAreas as $qualificationArea)
                        <option value={{ $qualificationArea->id }} @if (old('qualification_area_id') == $qualificationArea->id || $qualification_area_id == $qualificationArea->id) selected @endif>
                            {{ $qualificationArea->wording }}</option>
                    @endforeach
                </select>
                @error('qualification_area_id')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-12 col-lg-4">
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
    </div> --}}
    @if ($countryId)
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="regionId">Région d'affectation <span class="text-danger">*</span></label>
                <div class="col-12">
                    <select wire:model="regionId" class="form-control @error('regionId') is-invalid @enderror"
                        id="regionId" name="regionId">
                        <option value="">Choisir la région d'affectation</option>
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
                <label class="col-12" for="locality_id">Ville d'affectation</label>
                <div class="col-12">
                    <select wire:model="locality_id" class="form-control @error('locality_id') is-invalid @enderror"
                        id="locality_id" name="locality_id">
                        <option value="">Choisir la ville d'affectation</option>
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
</div>
