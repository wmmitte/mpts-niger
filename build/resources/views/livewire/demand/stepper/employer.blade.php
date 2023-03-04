<div>
    @if ($employers)
    <div class="row">
        <div class="col-12">
            <div class="form-group row justify-content-end">
                <div class="col-4">
                    <input type="text" class="form-control" wire:model="search"
                        id="search" name="search" placeholder="recherche à partir de la raison social ...">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center"><i class="fa fa-filter" aria-hidden="true"></i></th>
                            <th>Raison sociale</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Pays</th>
                            <th>Ville</th>
                            <th>Etat</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employers as $employer)
                            <tr>
                                @php
                                    $employerSelectedId = $employerSelected ? $employerSelected->id : '';
                                    $phones = $employer->phone ? (
                                            gettype($employer->phone) == 'string' ? json_decode($employer->phone) : $employer->phone
                                        ) : null;
                                @endphp
                                <td class="text-center">
                                    <label class="css-control css-control-success css-checkbox disabled">
                                        <input type="checkbox" class="css-control-input"
                                                {{$employerSelectedId == $employer->id ? 'checked' : ''}} disabled>
                                        <span class="css-control-indicator"></span>
                                    </label>
                                </td>
                                <td>{{ $employer->raison_social }}</td>
                                <td>{{ $employer->email }}</td>
                                <td>
                                    @if($phones)
                                        @foreach ($phones ?? [] as $key => $phone)
                                            <span>{{ $phone }}{{ $key == count($phones) - 1 ? '' : ', ' }}</span>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ $employer->locality->locality->wording }}</td>
                                <td>{{ $employer->locality->wording }}</td>
                                <td>
                                    <span class="badge badge-pill badge-{{ $employer->etat == 'actif' ? 'success' : 'danger' }}">
                                        {{ $employer->etat }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="d-flex align-items-center btn btn-sm btn-info"
                                            title="Plus d'information sur cet employeur" data-placement="right"
                                            data-toggle="modal" data-target="#employerShowModalEtat{{$employer->id}}"
                                        >
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span class="ml-2">Détail</span>
                                        </button>
                                        <div class="modal fade" id="employerShowModalEtat{{$employer->id}}" tabindex="-1" aria-labelledby="employerShowModalEtatLabel{{$employer->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="block block-themed block-transparent mb-0">
                                                        <div class="block-header bg-primary-dark">
                                                            <h3 class="block-title">Plus d'information</h3>
                                                            <div class="block-options">
                                                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                    <i class="si si-close"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="block-content">
                                                            @livewire('employer.show', ['employer' => $employer])
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($employerSelectedId !== $employer->id)
                                            <button class="btn btn-sm btn-success" wire:click="handlerBtn({{$employer}})"
                                                data-toggle="tooltip" title="Selectionner cet employeur et poursuivre" data-placement="right">
                                                <span class="d-flex align-items-center ">
                                                    <span class="mr-2">Selectionner</span>
                                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                </span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @if (count($employers) <= 0)
                        <tr>
                            <td class="text-center" colspan="7">Aucun donnée trouvé</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                {{ $employers->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
