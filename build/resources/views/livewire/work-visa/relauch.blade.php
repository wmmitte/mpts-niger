<div>
    @php
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $service = $user ? $user->entity : null;
        $userServiceId = $service ? $service->id : null;
        $daep = App\Models\Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $dge = App\Models\Entity::where('slug', Str::slug("Direction general de l'emploie"))->first();
    @endphp
    @if ($nombre > 0)
        @if ($service->id == $daep->id ||
            ($service->id == $dge->id && $user->role == 'directeur') ||
            in_array($user->role, ['admin', 'super']))
            <div class="alert alert-danger p-3 mb-2 bg-danger text-white" role="alert">
                <div class="d-flex justify-content-between">
                    <span>Vous avez {{ $nombre }} visa{{ $nombre > 1 ? 's' : '' }} dont la
                        date d'expiration est
                        proche ou passée.</span>
                    <button type="button" class="btn btn-sm btn-secondary" title="Visa bientot expiré" data-toggle="modal"
                        data-target="{{ '#workvisaModalExpiredSoon' }}">
                        <i class="fa fa-times" aria-hidden="true"></i>
                        Voir la liste
                    </button>
                </div>
            </div>
        @endif

        <div class="modal fade" id="{{ 'workvisaModalExpiredSoon' }}" tabindex="-1"
            aria-labelledby="{{ 'workvisaModalLabelExpiredSoon' }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark text-left">
                            <h3 class="block-title">Visas bientôt expirés</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content text-left">
                            <div class="row">
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
                                                        <td>{{ $employe ? "$employe->firstname $employe->lastname" : '---' }}
                                                        </td>
                                                        <td><strong>{{ $employe ? ($employe->genre == 'male' ? 'Homme' : 'Femme') : '---' }}</strong>
                                                        </td>
                                                        <td>{{ $workVisa->start_date ? \Carbon\Carbon::parse($workVisa->start_date)->format('d/m/Y') : '---' }}
                                                        </td>
                                                        <td>{{ $workVisa->end_date ? \Carbon\Carbon::parse($workVisa->end_date)->format('d/m/Y') : '---' }}
                                                        </td>
                                                        <td>
                                                            @if ($workVisa->state == -1)
                                                                <span class="badge badge-pill badge-danger">Visa
                                                                    expiré</span>
                                                            @elseif ($workVisa->state == 0)
                                                                <span class="badge badge-pill badge-success"><i
                                                                        class="fa fa-check" aria-hidden="true"></i>
                                                                    Visa
                                                                    accordé</span>
                                                            @elseif ($workVisa->state == 1)
                                                                <span class="badge badge-pill badge-success">Visa
                                                                    retiré</span>
                                                            @else
                                                                <span class="badge badge-pill badge-dark">Visa
                                                                    brouillon</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="btn-group btn-group-sm">
                                                                <a href="{{ route('work-visas.show', $workVisa) }}"
                                                                    class="btn btn-sm btn-secondary"
                                                                    data-toggle="tooltip"
                                                                    title="Consulter le détail du visa">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    Détails
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if (count($workVisas) <= 0)
                                                    <tr>
                                                        <td class="text-center" colspan="8">Aucun donnée trouvé
                                                        </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            {{ $workVisas->links() }}
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Quitter</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
