<div>
    @php
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $service = $user ? $user->entity : null;
        $userServiceId = $service ? $service->id : null;
        $daep = App\Models\Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
    @endphp
    @if ($service->id == $daep->id && $user->role == 'directeur')
        <button type="button" class="btn btn-info mr-2" title="Completer les informations et générer le couriel"
            data-toggle="modal" data-target="#relauchConfirmModal">
            Confirmation de la relance</button>
        <div wire:ignore class="modal fade" id="relauchConfirmModal" tabindex="-1"
            aria-labelledby="relauchConfirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('work-visa.confirm.relauch', $workVisa) }}" method="post">
                        @csrf
                        <div class="block block-themed block-transparent mb-0">
                            <div class="block-header bg-primary-dark text-left">
                                <h3 class="block-title">Confirmation de la relance</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-dismiss="modal"
                                        aria-label="Close">
                                        <i class="si si-close"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="block-content text-left">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-12" for="email_comment"> Référence du courrier de relance
                                                de l’employeur <span class="text-danger">*</span></label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('email_comment') is-invalid @enderror" wire:model="email_comment"
                                                    id="exampleFormControlTextarea1" name="email_comment" rows="3"
                                                    placeholder="Renseigner les référence du couriel de relance"></textarea>
                                                @error('email_comment')
                                                    <div class="form-text invalid-feedback d-block">{{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                            <button class="btn btn-success" type="submit">Clôturer l'alerte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
