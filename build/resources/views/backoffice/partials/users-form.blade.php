<div>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="lastname">Nom</label>
                <div class="col-12">
                    <input type="text" class="form-control  @error('lastname') is-invalid @enderror"
                        wire:model="lastname" value="{{ old('lastname') }}" id="lastname" name="lastname"
                        placeholder="Renseignez le nom">
                    @error('lastname')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-8">
            <div class="form-group row">
                <label class="col-12" for="firstname">Prenom(s)</label>
                <div class="col-12">
                    <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                        wire:model="firstname" value="{{ old('firstname') }}" id="firstname" name="firstname"
                        placeholder="Renseignez le(s) prénom(s)">
                    @error('firstname')
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
                    <input type="email" class="form-control @error('email') is-invalid @enderror" wire:model="email"
                        value="{{ old('email') }}" id="email" name="email"
                        placeholder="Renseignez l'adresse mail'">
                    @error('email')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="phone">N° téléphone</label>
                <div class="col-12">
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" wire:model="phone"
                        value="{{ old('phone') }}" id="phone" name="phone"
                        placeholder="Renseignez le numéro de téléphone">
                    @error('phone')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="genre">Le sexe</label>
                <div class="col-12">
                    <select wire:model="genre" class="form-control @error('genre') is-invalid @enderror" id="genre"
                        name="genre">
                        <option value="">Choisir le sexe</option>
                        <option value="male" @if (old('genre') == 'homme' || $genre == 'homme') selected @endif>Masculin</option>
                        <option value="female" @if (old('genre') == 'femme' || $genre == 'femme') selected @endif>Fénimin</option>
                        <option value="none" @if (old('genre') == 'none' || $genre == 'none') selected @endif>Non defini</option>
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
                <label class="col-12" for="structureId">Structure</label>
                <div class="col-12">
                    <select wire:model="structureId" class="form-control @error('structureId') is-invalid @enderror"
                        id="structureId" name="structureId">
                        <option value="">Choisir la structure</option>
                        @foreach ($structures as $structure)
                            <option value={{ $structure->id }} @if (old('structure') == $structure->id || $structureId == $structure->id) selected @endif>
                                {{ $structure->wording }}</option>
                        @endforeach
                    </select>
                    @error('structureId')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="entityId">Service / direction</label>
                <div class="col-12">
                    <select wire:model="entityId" class="form-control @error('entityId') is-invalid @enderror"
                        id="entityId" name="entityId">
                        <option value="">Choisir service / direction</option>
                        @if (!empty($entities))
                            @foreach ($entities as $entity)
                                <option value={{ $entity->id }} @if (old('entityId') == $entity->id || $entityId == $entity->id) selected @endif>
                                    {{ $entity->wording }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('entityId')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <label class="col-12" for="">
                    NB : <span><span class="text-danger">Ne rien choisir</span> si Ministre</span>
                </label>
            </div>
        </div>
        <div class="col-sm-12 col-lg-4">
            <div class="form-group row">
                <label class="col-12" for="role">Role</label>
                <div class="col-12">
                    <select wire:model="role" class="form-control @error('role') is-invalid @enderror" id="role"
                        name="role">
                        <option>Choisir le role</option>
                        @if (!empty($roles))
                            @foreach ($roles as $roleItem)
                                <option value={{ $roleItem }} @if (old('role') == $roleItem || $role == $roleItem) selected @endif>
                                    @include('backoffice.partials.role-name', ['role' => $roleItem])
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('role')
                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <label class="col-12" for="">
                    NB : <span>Choisir <span class="text-danger">premier responsable</span> si Ministre</span>
                </label>
            </div>
        </div>
    </div>
</div>
