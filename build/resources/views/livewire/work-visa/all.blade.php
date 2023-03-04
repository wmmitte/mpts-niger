<div>
    <div class="block-content">
        <div class="row">
            <div class="col-md-12 col-lg-6">
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="form-group row justify-content-end">
                    <div class="col-6">
                        <input type="text" class="form-control" wire:model="search" id="search" name="search"
                            placeholder="recherche à partir du numéro ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Numéro</th>
                                <th>Type</th>
                                <th>Employé</th>
                                <th>sexe</th>
                                <th>Date effet</th>
                                <th>Date exp</th>
                                <th>Statut</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workVisas as $workVisa)
                                @php
                                    $contrat = $workVisa->demand ? $workVisa->demand->contract : null;
                                    $employeur = $contrat ? $contrat->employer : null;
                                    $employe = $contrat ? $contrat->employee : null;
                                @endphp
                                <tr>
                                    <td>{{ "$workVisa->id" }}</td>
                                    <td>{{ "$workVisa->numero" }}</td>
                                    <td>{{ Str::upper($workVisa->demand->type) }} <br>
                                        ({{ $employeur ? Str::lower($employeur->raison_social) : '---' }})
                                    </td>
                                    <td>{{ $employe ? "$employe->firstname $employe->lastname" : '---' }}</td>
                                    <td><strong>{{ $employe ? ($employe->genre == 'male' ? 'Homme' : 'Femme') : '---' }}</strong>
                                    </td>
                                    <td>{{ $workVisa->start_date ? \Carbon\Carbon::parse($workVisa->start_date)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td>{{ $workVisa->end_date ? \Carbon\Carbon::parse($workVisa->end_date)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td>
                                        @if ($workVisa->state == -1)
                                            <span class="badge badge-pill badge-danger">Visa expiré</span>
                                        @elseif ($workVisa->state == 0)
                                            <span class="badge badge-pill badge-success"><i class="fa fa-check"
                                                    aria-hidden="true"></i> Visa accordé</span>
                                        @elseif ($workVisa->state == 1)
                                            <span class="badge badge-pill badge-success">Visa retiré</span>
                                        @else
                                            <span class="badge badge-pill badge-dark">Visa brouillon</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            @if ($workVisa->state == -2)
                                                @can('agent-privilege')
                                                    <a href="{{ route('work-visas.edit', $workVisa) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Modifier ce profile utilisateur">
                                                        <i class="fa fa-pencil"></i>
                                                        Modifier
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        title="Supprimer localité" data-toggle="modal"
                                                        data-target="{{ "#workvisaModal$workVisa->id" }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        Supprimer
                                                    </button>
                                                @endcan
                                            @else
                                                <a href="{{ route('work-visas.show', $workVisa) }}"
                                                    class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                    title="Consulter le détail du visa">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    Détails
                                                </a>
                                                @can('agent-privilege')
                                                    <a href="{{ route('work-visas.edit', $workVisa) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Modifier ce profile utilisateur">
                                                        <i class="fa fa-pencil"></i>
                                                        Modifier
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-secondary"
                                                        title="Supprimer localité" data-toggle="modal"
                                                        data-target="{{ "#workvisaModal$workVisa->id" }}">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        Supprimer
                                                    </button>
                                                @endcan
                                            @endif
                                            <div class="modal fade" id="{{ "workvisaModal$workVisa->id" }}"
                                                tabindex="-1"
                                                aria-labelledby="{{ "workvisaModalLabel$workVisa->id" }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="block block-themed block-transparent mb-0">
                                                            <div class="block-header bg-primary-dark text-left">
                                                                <h3 class="block-title">Avertissement</h3>
                                                                <div class="block-options">
                                                                    <button type="button" class="btn-block-option"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <i class="si si-close"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="block-content text-left">
                                                                <p class="mb-0">Etes vous sur de bien vouloir
                                                                    effecturer cette action ?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <a href="{{ route('work-visas.destroy', $workVisa) }}"
                                                                onclick="event.preventDefault(); document.getElementById('deleted-work-visa-{{ $workVisa->id }}').submit();"
                                                                class="btn btn-danger">Supprimer</a>
                                                            <form id="deleted-work-visa-{{ $workVisa->id }}"
                                                                action="{{ route('work-visas.destroy', $workVisa) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($workVisas) <= 0)
                                <tr>
                                    <td class="text-center" colspan="8">Aucun donnée trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $workVisas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
