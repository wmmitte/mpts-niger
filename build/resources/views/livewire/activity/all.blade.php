<div>
    <div class="block-content">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group row justify-content-end">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='secteur' type="radio" name="secteur" id="tous" value="tous">
                            <label class="form-check-label" for="tous">Tous</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='secteur' type="radio" name="secteur" id="primaire" value="primaire">
                            <label class="form-check-label" for="primaire">Primaire</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='secteur' type="radio" name="secteur" id="secondaire" value="secondaire">
                            <label class="form-check-label" for="secondaire">Secondaire</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='secteur' type="radio" name="secteur" id="tertiaire" value="tertiaire">
                            <label class="form-check-label" for="tertiaire">Tertiaire</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6">
                <div class="form-group row justify-content-end">
                    <div class="col-6">
                        <input type="text" class="form-control" wire:model="search"
                        id="search" name="search" placeholder="recherche à partir du nom de l'activité ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Libelle branche</th>
                                <th>Secteur d'activité</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>{{"$activity->wording"}}</td>
                                    <td>{{$activity->secteur}}</td>
                                    <td class="text-center">
                                        @cannot('super-privilege')
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{route('activities.edit', $activity)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Modifier ce profil utilisateur">
                                                <i class="fa fa-pencil"></i><br>
                                                Modifier
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                title="Supprimer localité"
                                                data-toggle="modal" data-target="{{"#exampleModal$activity->id"}}"
                                            >
                                                <i class="fa fa-times" aria-hidden="true"></i><br>
                                                Supprimer
                                            </button>
                                            <div class="modal fade" id="{{"exampleModal$activity->id"}}" tabindex="-1" aria-labelledby="{{"exampleModalLabel$activity->id"}}" aria-hidden="true">
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
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                    <a href="{{route('activities.destroy', $activity)}}"
                                                        onclick="event.preventDefault(); document.getElementById('deleted-activity-{{$activity->id}}').submit();"
                                                        class="btn btn-danger">Supprimer</a>
                                                        <form id="deleted-activity-{{$activity->id}}" action="{{ route('activities.destroy', $activity->ref) }}" method="POST" style="display: none;">
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
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($activities) <= 0)
                                <tr><td class="text-center" colspan="4">Aucun donnée trouvé</td></tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
