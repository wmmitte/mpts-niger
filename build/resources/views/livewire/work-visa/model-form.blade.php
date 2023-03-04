<div>
    <div class="block-content">
        <form wire:submit.prevent="onsubmitForm">
            @csrf
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group row">
                        <label class="col-12" for="demand_id">
                            Demande de visa <span class="text-danger">*</span>
                        </label>
                        <div class="col-12">
                            <select {{ $demand ? ($demand->id ? 'disabled' : '') : '' }} wire:model="demand_id"
                                class="form-control @error('demand_id') is-invalid @enderror" id="demand_id"
                                name="demand_id">
                                <option value="">Choisir la demande à accorder</option>
                                @foreach ($demands as $demand)
                                    <option value={{ $demand->id }} @if (old('demand_id') == $demand->id || $demand_id == $demand->id) selected @endif>
                                        {{ "$demand->applicant_fullname ($demand->type)" }}</option>
                                @endforeach
                            </select>
                            @error('demand_id')
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
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group row">
                        <label class="col-12" for="numero">Numéro du visa</label>
                        <div class="col-12">
                            <input type="text"class="form-control  @error('numero') is-invalid @enderror"
                                wire:model="numero" value="{{ old('numero') }}" id="numero" name="numero"
                                placeholder="Renseigner le numéro">
                            @error('numero')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div class="form-group row">
                        <label class="col-12" for="duration">Durée de validité du visa (en mois)</label>
                        <div class="col-12">
                            <input type="number"class="form-control  @error('duration') is-invalid @enderror"
                                wire:model="duration" value="{{ old('duration') }}" id="duration" name="duration"
                                placeholder="Renseigner la durée de validité">
                            @error('duration')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                    <div class="form-group row">
                        <label class="col-12" for="start_date">Date de prise effet du visa</label>
                        <div class="col-12">
                            <input type="date"class="form-control  @error('start_date') is-invalid @enderror"
                                wire:model="start_date" value="{{ old('start_date') }}" id="start_date"
                                name="start_date" placeholder="Renseigner la date  effet">
                            @error('start_date')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group row">
                        <label class="col-12" for="nom_ministre">Nom du Signataire</label>
                        <div class="col-12">
                            <input type="text"class="form-control  @error('nom_ministre') is-invalid @enderror"
                                wire:model="nom_ministre" value="{{ old('nom_ministre') }}" id="nom_ministre"
                                name="nom_ministre" placeholder="Renseignez le nom du signataire">
                            @error('nom_ministre')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-group row">
                        <label class="col-12" for="date_decision">Date de la décision</label>
                        <div class="col-12">
                            <input type="date"class="form-control  @error('date_decision') is-invalid @enderror"
                                wire:model="date_decision" value="{{ old('date_decision') }}" id="date_decision"
                                name="date_decision" placeholder="Renseigner la date">
                            @error('date_decision')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group row">
                        <label class="col-12" for="observation">Observations</label>
                        <div class="col-12">
                            <textarea class="form-control @error('observation') is-invalid @enderror" wire:model="observation" name="observation"
                                id="exampleFormControlTextarea1" rows="3"></textarea>
                            @error('observation')
                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
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
