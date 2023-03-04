<div>
    <div class="row">
        <div class="col-12">
            <div class="form-group row justify-content-end">
                <div class="col-sm-12">
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
                            <th>Type</th>
                            <th>Nom & prénom(s)</th>
                            <th>N° Téléphone</th>
                            <th>E-mail</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demands as $demand)
                            <tr>
                                <td class="text-uppercase">{{ $demand->type }}</td>
                                <td>{{ $demand->applicant_fullname }}</td>
                                <td>{{ $demand->applicant_phone }}</td>
                                <td>{{ $demand->applicant_email }}</td>
                                <td class="text-center">
                                    @if ($demand->state < 1)
                                        <a href="{{ route('demande.edit.general', $demand) }}"
                                            class="btn btn-sm btn-warning d-flex align-items-center border-0"
                                            data-toggle="tooltip" title="Poursuivre l'enregistrement">
                                            <i class="fa fa-pencil"></i>
                                            <span class="ml-2">Modifier</span>
                                        </a>
                                    @else
                                        <a href="{{ route('demands.show', $demand) }}"
                                            class="btn btn-sm btn-info d-flex align-items-center border-0"
                                            data-toggle="tooltip" title="Détail sur le dossier">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                            <span class="ml-2">Détails</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if (count($demands) <= 0)
                            <tr>
                                <td class="text-center" colspan="7">Aucune donnée trouvée</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $demands->links() }}
            </div>
        </div>
    </div>
</div>
