<div>
    @can('agent-privilege')
        <button type="button" class="btn btn-{{ $fullField ? 'warning' : 'dark' }} mr-2"
            title="Completer les informations et générer le couriel" data-toggle="modal"
            data-target="#courielGenerate{{ $fullField ? 'FullField' : '' }}Modal">
            {{ $fullField ? 'Modifier le contenu et générer le couriel' : 'Generer le couriel' }} </button>
    @endcan
    <div wire:ignore class="modal fade" id="courielGenerate{{ $fullField ? 'FullField' : '' }}Modal" tabindex="-1"
        aria-labelledby="courielGenerate{{ $fullField ? 'FullField' : '' }}ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('demande.couriel.generate', $demand) }}" method="post">
                    @csrf
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark text-left">
                            <h3 class="block-title">Informations sur le couriel</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content text-left">
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="objetCouriel"> Objet du couriel <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('objetCouriel') is-invalid @enderror"
                                                wire:model="objetCouriel" value="{{ old('objetCouriel') }}"
                                                id="objetCouriel" name="objetCouriel" placeholder="Renseigner l'objet'">
                                            @error('objetCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="numeroCouriel"> Numéro du couriel</label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('numeroCouriel') is-invalid @enderror"
                                                wire:model="numeroCouriel" value="{{ old('numeroCouriel') }}"
                                                id="numeroCouriel" name="numeroCouriel"
                                                placeholder="Renseigner le numéro">
                                            @error('numeroCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="dateDecision"> Date de la décision <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <input type="date"
                                                class="form-control  @error('dateDecision') is-invalid @enderror"
                                                wire:model="dateDecision" value="{{ old('dateDecision') }}"
                                                id="dateDecision" name="dateDecision" placeholder="Renseigner la date">
                                            @error('dateDecision')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group row">
                                        <label class="col-12" for="refCouriel"> Référence du couriel</label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('refCouriel') is-invalid @enderror"
                                                wire:model="refCouriel" value="{{ old('refCouriel') }}" id="refCouriel"
                                                name="refCouriel" placeholder="Renseigner la référence">
                                            @error('refCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group row">
                                        <label class="col-12" for="ministreName"> Nom complet du Signataire <span
                                                class="text-danger">*</span></label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('ministreName') is-invalid @enderror"
                                                wire:model="ministreName" value="{{ old('ministreName') }}"
                                                id="ministreName" name="ministreName" placeholder="Renseigner le nom">
                                            @error('ministreName')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="amOneCouriel"> Ampliations première ligne</label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('amOneCouriel') is-invalid @enderror"
                                                wire:model="amOneCouriel" value="{{ old('amOneCouriel') }}"
                                                id="amOneCouriel" name="amOneCouriel"
                                                placeholder="Renseigner le libellé">
                                            @error('amOneCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="amTwoCouriel"> Ampliation deuxième ligne</label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('amTwoCouriel') is-invalid @enderror"
                                                wire:model="amTwoCouriel" value="{{ old('amTwoCouriel') }}"
                                                id="amTwoCouriel" name="amTwoCouriel"
                                                placeholder="Renseigner le libellé">
                                            @error('amTwoCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <div class="form-group row">
                                        <label class="col-12" for="amThreeCouriel"> Ampliation troisième ligne</label>
                                        <div class="col-12">
                                            <input type="text"
                                                class="form-control  @error('amThreeCouriel') is-invalid @enderror"
                                                wire:model="amThreeCouriel" value="{{ old('amThreeCouriel') }}"
                                                id="amThreeCouriel" name="amThreeCouriel"
                                                placeholder="Renseigner le libellé">
                                            @error('amThreeCouriel')
                                                <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($fullField)
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-12" for="paragrapheOneCouriel">Premier
                                                paragraphe</label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('paragrapheOneCouriel') is-invalid @enderror" wire:model="paragrapheOneCouriel"
                                                    id="exampleFormControlTextarea1" name="paragrapheOneCouriel" rows="3"
                                                    placeholder="Renseigner le premier parageraphe"></textarea>
                                                @error('paragrapheOneCouriel')
                                                    <div class="form-text invalid-feedback d-block">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-12" for="paragrapheTwoCouriel">Deuxième
                                                paragraphe</label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('paragrapheTwoCouriel') is-invalid @enderror" wire:model="paragrapheTwoCouriel"
                                                    id="exampleFormControlTextarea1" name="paragrapheTwoCouriel" rows="3"
                                                    placeholder="Renseigner le paragraphe"></textarea>
                                                @error('paragrapheTwoCouriel')
                                                    <div class="form-text invalid-feedback d-block">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-12" for="paragrapheThreeCouriel">Troisième
                                                paragraphe</label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('paragrapheThreeCouriel') is-invalid @enderror"
                                                    wire:model="paragrapheThreeCouriel" id="exampleFormControlTextarea1" name="paragrapheThreeCouriel"
                                                    rows="3" placeholder="Renseigner le paragraphe"></textarea>
                                                @error('paragrapheThreeCouriel')
                                                    <div class="form-text invalid-feedback d-block">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group row">
                                            <label class="col-12" for="paragrapheFourCouriel">Quatrième
                                                paragraphe</label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('paragrapheFourCouriel') is-invalid @enderror"
                                                    wire:model="paragrapheFourCouriel" id="exampleFormControlTextarea1" name="paragrapheFourCouriel" rows="3"
                                                    placeholder="Renseigner le paragraphe"></textarea>
                                                @error('paragrapheFourCouriel')
                                                    <div class="form-text invalid-feedback d-block">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-12" for="paragrapheFiveCouriel">Cinquième
                                                paragraphe</label>
                                            <div class="col-12">
                                                <textarea class="form-control  @error('paragrapheFiveCouriel') is-invalid @enderror"
                                                    wire:model="paragrapheFiveCouriel" id="exampleFormControlTextarea1" name="paragrapheFiveCouriel" rows="3"
                                                    placeholder="Renseigner le paragraphe"></textarea>
                                                @error('paragrapheFiveCouriel')
                                                    <div class="form-text invalid-feedback d-block">
                                                        {{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                        <button class="btn btn-success" type="submit">
                            Générer le couriel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
