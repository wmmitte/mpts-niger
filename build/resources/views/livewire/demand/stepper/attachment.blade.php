<div class="pb-4">
    <div class="card border mb-2 p-2">
        <div class="row">
            <div class="col-12">
                <form wire:submit.prevent="saveFile">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label class="col-12" for="wording">
                                    Intitulé du document <span class="text-danger">*</span>
                                </label>
                                <div class="col-12">
                                    <input type="text" class="form-control  @error('wording') is-invalid @enderror"
                                        wire:model="wording" value="{{ old('wording') }}" id="wording" name="wording"
                                        placeholder="Renseigner le libellé">
                                    @error('wording')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group row">
                                <label class="col-12" for="type">
                                    Type du document à joindre<span class="text-danger">*</span>
                                </label>
                                <div class="col-12">
                                    <select wire:model="type" class="form-control @error('type') is-invalid @enderror"
                                        id="type" name="type">
                                        <option value="">Choisir le type</option>
                                        <option value="piece administrative"
                                            @if (old('type') == 'piece administrative' || $type == 'piece administrative') selected @endif>Pièce administrative
                                        </option>
                                        <option value="demande" @if (old('type') == 'demande' || $type == 'demande') selected @endif>
                                            Demande</option>
                                    </select>
                                    @error('type')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-12" for="attach">
                                    Le fichier à charger <span class="text-danger">*</span>
                                </label>
                                <div class="col-12">
                                    <input type="file" class="form-control  @error('attach') is-invalid @enderror"
                                        wire:model="attach" id="attach" name="attach"
                                        placeholder="Selectionner le fichier" accept=".pdf">
                                    @error('attach')
                                        <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit">
                                        Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header mt-4">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h5 class="card-title">Pièces déjà jointes</h5>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    @if ($attachments)
                        @if (count($attachments) > 0)
                            {{-- <button type="button" class="btn btn-sm btn-success"
                                title="Plus d'information sur cet employeur" data-toggle="modal"
                                data-target="#attachDocModalEtat">
                                Enregistrer la demande pour controle
                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            </button>
                            <div class="modal fade" id="attachDocModalEtat" tabindex="-1"
                                aria-labelledby="attachDocModalEtatLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="block block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark text-left">
                                                <h3 class="block-title">Avertissament</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="si si-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content text-left">
                                                <p class="mb-0">Etes-vous sur de bien vouloir effectuer cette action
                                                    !?</p>
                                                <p class="text-danger"><strong>NB </strong>: vous n'aurez plus la
                                                    possibilité de modifier. Veuillez vous rassurer avant de poursuivre.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark"
                                                data-dismiss="modal">Annuler</button>
                                            <button class="btn btn-success" type="submit" wire:click="handlerBtn">
                                                Enregistrer la demande pour controle
                                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <button class="btn btn-primary" type="button" wire:click="handlerBtn">
                                Poursuivre
                                <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if ($attachments)
                    @if (count($attachments) > 0)
                        <div class="row">
                            @foreach ($attachments as $attachment)
                                <div class="col-sm-12 col-md-2">
                                    @include('backoffice.partials.demand-file-item', [
                                        'attachment',
                                        $attachment,
                                    ])
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center">Aucune pièce jointe à cette demande</div>
                    @endif
                @else
                    <div class="text-center">Aucune pièce jointe à cette demande</div>
                @endif
            </div>
        </div>
    </div>
</div>
