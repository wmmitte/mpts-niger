<div>
    <div class="block-content">
        <form wire:submit.prevent="onsubmitForm">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group row">
                        <label class="col-12" for="wording">Libelle groupe localité</label>
                        <div class="col-12">
                            <input type="text"class="form-control  @error('wording') is-invalid @enderror"
                                wire:model="wording" value="{{ old('wording') }}" id="wording" name="wording"
                                placeholder="Renseigner le libelle">

                            @error('wording')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6 text-right">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" wire:model="state" id="customSwitch1"
                            {{ $state ? 'checked' : '' }}>
                        <label class="custom-control-label"
                            for="customSwitch1">{{ $state ? 'Publier' : 'Brouillon' }}</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row">
                        @foreach ($countries as $country)
                            <div class="col-sm-12 col-md-3">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input class="custom-control-input" id="customControlValidation{{ $country->id }}"
                                        type="checkbox" value="{{ $country->id }}" wire:model="selectedCountries" />
                                    <label class="custom-control-label"
                                        for="customControlValidation{{ $country->id }}">{{ $country->wording }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                {{ $action == 'post' ? 'Enregister' : 'Mettre à Jour' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
