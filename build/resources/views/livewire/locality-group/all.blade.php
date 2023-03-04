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
                                <th>Intitulé du groupe</th>
                                <th>Nombre de pays</th>
                                <th>Statut</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groups as $group)
                                <tr>
                                    {{-- <td class="text-center">
                                        <img class="img-avatar img-avatar48" src="{{ asset($group->avatar ? "/storage/$group->flat" : 'media/avatars/avatar15.jpg') }}" alt="">
                                    </td> --}}
                                    <td>{{ "$group->wording" }}</td>
                                    <td>
                                        {{"$group->localities_count pays"}}
                                    </td>
                                    <td>
                                        @if ($group->state)
                                        <span class="badge badge-pill badge-success">Accessible</span>
                                        @else
                                        <span class="badge badge-pill badge-danger">Inaccessible</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @cannot('super-privilege')
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('group-localities.edit', $group) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Modifier ce profile utilisateur">
                                                <i class="fa fa-pencil"></i><br>
                                                Modifier
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                title="Supprimer localité" data-toggle="modal"
                                                data-target="{{ "#groupModal$group->id" }}">
                                                <i class="fa fa-times" aria-hidden="true"></i><br>
                                                Supprimer
                                            </button>
                                            <div class="modal fade" id="{{ "groupModal$group->id" }}"
                                                tabindex="-1" aria-labelledby="{{ "groupModalLabel$group->id" }}"
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
                                                            <a href="{{ route('group-localities.destroy', $group) }}"
                                                                onclick="event.preventDefault(); document.getElementById('deletedGroupLocality{{ $group->id }}').submit();"
                                                                class="btn btn-danger">Supprimer</a>
                                                            <form id="deletedGroupLocality{{ $group->id }}"
                                                                action="{{ route('group-localities.destroy', $group) }}"
                                                                method="POST" style="display: none;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcannot
                                        @can('super-privilege')
                                            ---
                                        @endcan
                                        {{-- ---- --}}
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($groups) <= 0)
                                <tr>
                                    <td class="text-center" colspan="5">Aucun donnée trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $groups->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
