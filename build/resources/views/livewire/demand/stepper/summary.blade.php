<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="block">
        <div class="block-content pb-4 px-4">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    @php
                        $btnReasonColor = '';
                        $btnReasonOperationText = '';
                        if ($reasonChefDaes && $reasonDgAnpe) {
                            $btnReasonColor = 'success';
                            $btnReasonOperationText = "Modifier l'Avis Technique";
                        } else {
                            $btnReasonColor = 'danger';
                            $btnReasonOperationText = "Saisir l'Avis Technique";
                        }
                    @endphp

                    <button type="button" class="btn btn-{{ $btnReasonColor }} mr-2" title="{{ $btnReasonOperationText }}"
                        data-toggle="modal" data-target="#avisTechAnpeModal">
                        {{ $btnReasonOperationText }}
                    </button>
                    <div wire:ignore class="modal fade" id="avisTechAnpeModal" tabindex="-1"
                        aria-labelledby="avisTechAnpeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form wire:submit.prevent="onSubmitHandler">
                                    @csrf
                                    <div class="block block-themed block-transparent mb-0">
                                        <div class="block-header bg-primary-dark text-left">
                                            <h3 class="block-title">Avis technique</h3>
                                            <div class="block-options">
                                                <button type="button" class="btn-block-option" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <i class="si si-close"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="block-content text-left">
                                            <p class="mb-0">Veuillez renseigner les avis technique</p>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="reasonDgAnpe">{{$labelAvisDgAnpe}}</label>
                                                        <div class="col-12">
                                                            <textarea class="form-control  @error('reasonDgAnpe') is-invalid @enderror" wire:model="reasonDgAnpe"
                                                                id="reasonDgAnpe" name="reasonDgAnpe" rows="3" placeholder="Renseigner l'avis du DG ANPE"></textarea>
                                                            @error('reasonDgAnpe')
                                                                <div class="form-text invalid-feedback d-block">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group row">
                                                        <label class="col-12" for="reasonChefDaes">{{$labelAvisChefDaes}}</label>
                                                        <div class="col-12">
                                                            <textarea class="form-control  @error('reasonChefDaes') is-invalid @enderror" wire:model="reasonChefDaes"
                                                                id="reasonChefDaes" name="reasonChefDaes" rows="3" placeholder="Renseigner l'avis du chef DAES"></textarea>
                                                            @error('reasonChefDaes')
                                                                <div class="form-text invalid-feedback d-block">
                                                                    {{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                                        <button class="btn btn-info" @if ($closedModal)
                                            data-dismiss="modal"
                                        @endif type="submit">
                                            Enregistrer l'avis technique
                                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    @if ($demand->state === -1)
                    <button type="button" class="btn btn-primary" title="Transmettre la demande pour contrôle"
                        data-toggle="modal" data-target="#attachDocModalEtat">
                        Transmettre la demande pour contrôle
                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                    </button>
                    @endif
                    <div class="modal fade" id="attachDocModalEtat" tabindex="-1"
                        aria-labelledby="attachDocModalEtatLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="block block-themed block-transparent mb-0">
                                    <div class="block-header bg-primary-dark text-left">
                                        <h3 class="block-title">Avertissement</h3>
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
                                    <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                                    <button class="btn btn-primary" type="submit" wire:click="handlerBtn">
                                        Transmettre la demande pour controle
                                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @livewire('demand.show', ['demand' => $demand, 'hasSummerPage' => true])
</div>
