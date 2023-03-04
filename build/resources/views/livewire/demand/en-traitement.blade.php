<div>
    <div class="block-content">
        <div class="row">
            <div class="col-12">
                <div class="form-group row justify-content-end">
                    <div class="col-sm-12 col-lg-6">
                        <input type="text" class="form-control" wire:model="search" id="search" name="search"
                            placeholder="recherche à partir du nom, prenom et email employé et raison social employeur ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                {{-- <th class="text-center"><i class="si si-user"></i></th> --}}
                                <th class="text-center">#</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Nom & prénom(s) demandeur</th>
                                <th>Sexe</th>
                                <th>Email demandeur</th>
                                <th>Position</th>
                                <th>Statut</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demands as $demand)
                                @php
                                    $contrat = $demand->contract ? $demand->contract : null;
                                    $employeur = $contrat ? $contrat->employer : null;
                                    $employe = $contrat ? $contrat->employee : null;
                                @endphp
                                <tr>
                                    <td>{{ $demand->id }}</td>
                                    <td>
                                        {{ $demand->created_at ? \Carbon\Carbon::parse($demand->created_at)->format('d/m/Y H:i:s') : '---' }}
                                    </td>
                                    <td>{{ Str::upper($demand->type) }}
                                        <br>
                                        ({{ $employeur ? Str::lower($employeur->raison_social) : '---' }})
                                    </td>
                                    <td>{{ $employe ? "$employe->firstname $employe->lastname" : '---' }}
                                        <br>({{ $employe ? $employe->profession ?? '---' : '---' }})
                                    </td>
                                    <td>{{ $employe ? ($employe->genre == 'male' ? 'Homme' : 'Femme') : '---' }}</td>
                                    <td>{{ $employe ? $employe->email : '---' }}</td>
                                    <td class="text-center">
                                        @if ($demand->dealingStructure)
                                            {{ $demand->dealingStructure?->wording }} <br>
                                            {{ $demand->updated_at? \Carbon\Carbon::parse($demand->updated_at)->locale('fr_FR')->diffForHumans(): '---' }}
                                        @else
                                            DAEP/SMMO Ministère
                                            <br>
                                            {{ $demand->updated_at? \Carbon\Carbon::parse($demand->updated_at)->locale('fr_FR')->diffForHumans(): '---' }}
                                        @endif
                                    </td>
                                    <td>
                                        {{-- {{ $demand->dealingStructure?->wording }} <br> --}}
                                        @include('backoffice.partials.demand-statut-color', [
                                            'status' => $demand->state,
                                            'hasRecour' => $demand->has_recours,
                                            'hasVisaCompleted' => $demand->visa?->demand_id,
                                        ])
                                        @if ($demand->has_recours)
                                            <span class="badge badge-warning">Recours</span>
                                        @endif


                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('demands.show', $demand) }}"
                                                class="btn btn-sm btn-info d-flex align-items-center border-0"
                                                data-toggle="tooltip" title="Détail sur le dossier">
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                <span class="ml-2">Détail</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($demands) <= 0)
                                <tr>
                                    <td class="text-center" colspan="9">Aucun donnée trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $demands->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
