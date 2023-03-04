<div>
    <div class="block-content">
        <div class="row">
            <div class="col-md-12 col-lg-6">
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="form-group row justify-content-end">
                    <div class="col-6">
                        <input type="text" class="form-control" wire:model="search" id="search" name="search"
                            placeholder="recherche à partir du nom ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                {{-- <th class="text-center"><i class="si si-user"></i></th> --}}
                                <th>Domaine de qualification</th>
                                <th>Statut</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($qualificationAreas as $qualificationArea)
                                <tr>
                                    <td>{{ "$qualificationArea->wording" }}</td>
                                    <td>
                                        @if ($qualificationArea->state)
                                        <span class="badge badge-pill badge-success">Accessible</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">Inaccessible</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            {{-- <a href="{{route('qualification-areas.show', $qualificationArea)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Modifier ce profile utilisateur">
                                                <i class="fa fa-eye" aria-hidden="true"></i><br>
                                                Détailer
                                            </a> --}}
                                            @can('super-privilege')
                                                ---
                                            @endcan
                                            @cannot('super-privilege')
                                            <a href="{{ route('qualification-areas.edit', $qualificationArea) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Modifier ce profile utilisateur">
                                                <i class="fa fa-pencil"></i><br>
                                                Modifier
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                title="Supprimer localité" data-toggle="modal"
                                                data-target="{{ "#qualiArea$qualificationArea->id" }}">
                                                <i class="fa fa-times" aria-hidden="true"></i><br>
                                                Supprimer
                                            </button>
                                            <div class="modal fade" id="{{ "qualiArea$qualificationArea->id" }}"
                                                tabindex="-1" aria-labelledby="{{ "qualiAreaLabel$qualificationArea->id" }}"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="block block-themed block-transparent mb-0">
                                                            <div class="block-header bg-primary-dark text-left">
                                                                <h3 class="block-title">Avertissement</h3>
                                                                <div class="block-options">
                                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                                        <i class="si si-close"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="block-content text-left">
                                                                <p class="mb-0">Etes vous sur de bien vouloir effecturer cette action ?</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <a href="{{ route('qualification-areas.destroy', $qualificationArea) }}"
                                                                onclick="event.preventDefault(); document.getElementById('deleted-qualiArea-{{ $qualificationArea->id }}').submit();"
                                                                class="btn btn-danger">Supprimer</a>
                                                            <form id="deleted-qualiArea-{{ $qualificationArea->id }}"
                                                                action="{{ route('qualification-areas.destroy', $qualificationArea) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcannot
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($qualificationAreas) <= 0)
                                <tr>
                                    <td class="text-center" colspan="5">Aucun donnée trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $qualificationAreas->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
