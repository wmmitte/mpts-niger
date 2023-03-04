<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="type">Type de localité</label>
            <div class="col-12">
                <select wire:model="type" class="form-control @error('type') is-invalid @enderror" id="type"
                    name="type">
                    <option value="">Choisir le type</option>
                    <option value="continent" @if (old('type') == 'continent' || $type == 'continent') selected @endif>Continent</option>
                    <option value="country" @if (old('type') == 'country' || $type == 'country') selected @endif>Pays</option>
                    <option value="district" @if (old('type') == 'district' || $type == 'district') selected @endif>Région</option>
                    <option value="city" @if (old('type') == 'city' || $type == 'city') selected @endif>Ville</option>
                    {{-- <option value="locality" @if (old('type') == 'locality' || $type == 'locality') selected @endif>Localité</option> --}}
                </select>
                @error('type')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @if ($type)
        @if ($type !== 'continent')
            <div class="col-sm-12 col-lg-4">
                <div class="form-group row">
                    <label class="col-12" for="localityId">
                        @include('backoffice.partials.locality-type', [
                            'type' =>
                                $type === 'country'
                                    ? 'continent'
                                    : ($type === 'district'
                                        ? 'country'
                                        : ($type === 'city'
                                            ? 'district'
                                            : ($type === 'locality'
                                                ? 'city'
                                                : ''))),
                        ]) rattaché(e)
                    </label>
                    <div class="col-12">
                        <select wire:model="localityId" class="form-control @error('localityId') is-invalid @enderror"
                            id="localityId" name="localityId">
                            <option value="">Choisir
                                @include('backoffice.partials.locality-type', [
                                    'type' =>
                                        $type === 'country'
                                            ? 'continent'
                                            : ($type === 'district'
                                                ? 'country'
                                                : ($type === 'city'
                                                    ? 'district'
                                                    : ($type === 'locality'
                                                        ? 'city'
                                                        : ''))),
                                ])
                            </option>
                            @foreach ($localities as $locality)
                                <option value={{ $locality->id }} @if (old('locality') == $locality->id || $localityId == $locality->id) selected @endif>
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
        @if ($type == 'country')
            <div class="col-sm-12 col-lg-4">
                <div class="form-group row">
                    <label class="col-12" for="nationality">La nationalité du pays</label>
                    <div class="col-12">
                        <input type="text"class="form-control  @error('nationality') is-invalid @enderror"
                            wire:model="nationality" value="{{ old('nationality') }}" id="nationality"
                            name="nationality" placeholder="Renseignez la nationalite">

                        @error('nationality')
                            <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="wording">
                    Libellé
                    <span class="text-lowercase">
                        @include('backoffice.partials.locality-type', [
                            'type' =>
                                $type === 'continent'
                                    ? 'continent'
                                    : ($type === 'district'
                                        ? 'district'
                                        : ($type === 'city'
                                            ? 'city'
                                            : ($type === 'locality'
                                                ? 'locality'
                                                : 'country'))),
                        ])
                    </span>
                </label>
                <div class="col-12">
                    <input type="text"class="form-control  @error('wording') is-invalid @enderror"
                        wire:model="wording" value="{{ old('wording') }}" id="wording" name="wording"
                        placeholder="Renseignez @include('backoffice.partials.locality-type', [
                            'type' =>
                                $type === 'continent'
                                    ? 'continent'
                                    : ($type === 'district'
                                        ? 'district'
                                        : ($type === 'city'
                                            ? 'city'
                                            : ($type === 'locality'
                                                ? 'locality'
                                                : 'country'))),
                        ])">
                    @error('wording')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    @endif
</div>
