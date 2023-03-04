<div class="row">
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="secteur">Secteur d'activité</label>
            <div class="col-12">
                <select wire:model="secteur" class="form-control @error('secteur') is-invalid @enderror" id="secteur"
                    name="secteur">
                    <option value="">Choisir le secteur</option>
                    <option value="primaire" @if (old('secteur') == 'primaire' || $secteur == 'primaire') selected @endif>Primaire</option>
                    <option value="secondaire" @if (old('secteur') == 'secondaire' || $secteur == 'secondaire') selected @endif>Secondaire</option>
                    <option value="tertiaire" @if (old('secteur') == 'tertiaire' || $secteur == 'tertiaire') selected @endif>Tertiaire</option>
                </select>
                @error('secteur')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group row">
            <label class="col-12" for="wording">Libelle branche</label>
            <div class="col-12">
                <input type="text"class="form-control  @error('wording') is-invalid @enderror" wire:model="wording"
                    value="{{ old('wording') }}" id="wording" name="wording" placeholder="Renseignez le libelle">
                @error('wording')
                    <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    @if ($secteur)
        @if ($secteur == 'industry')
            <div class="col-sm-12 col-lg-4">
                <div class="form-group row">
                    <label class="col-12" for="activityId">Le secteur auquel est rattaché</label>
                    <div class="col-12">
                        <select wire:model="activityId" class="form-control @error('activityId') is-invalid @enderror"
                            id="activityId" name="activityId">
                            <option value="">Choisir le secteur</option>
                            @foreach ($activities as $activity)
                                <option value={{ $activity->id }} @if (old('activity') == $activity->id || $activityId == $activity->id) selected @endif>
                                    {{ $activity->wording }}</option>
                            @endforeach
                        </select>
                        @error('activityId')
                            <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
