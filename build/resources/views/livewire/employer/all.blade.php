<div>
    <div class="block-content">
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
                                {{-- <th class="text-center"><i class="si si-user"></i></th> --}}
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
                                    <td>{{ $employer->raison_social }}</td>
                                    <td>{{ $employer->email }}</td>
                                    <td>
                                        @php
                                            $phones = gettype($employer->phone) == 'string' ? json_decode($employer->phone) : $employer->phone;
                                        @endphp
                                        @foreach ($phones ?? [] as $key => $phone)
                                            <span>{{ $phone }}{{ $key == count($phones) - 1 ? '' : ', ' }}</span>
                                        @endforeach
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
                                            <button type="button" class="btn btn-sm btn-info"
                                                title="Plus d'information sur cet employeur"
                                                data-toggle="modal" data-target="#employerShowModalEtat{{$employer->id}}"
                                            >
                                                <i class="fa fa-eye" aria-hidden="true"></i><br/>
                                                Détail
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

                                            @cannot('super-privilege')
                                            <a href="{{ route('employers.edit', $employer) }}" class="btn btn-sm btn-dark"
                                                data-toggle="tooltip" title="Modifier ce profile utilisateur">
                                                <i class="fa fa-pencil"></i><br>
                                                Modifier
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                title={{$employer->etat}}
                                                data-toggle="modal" data-target="#employerModalEtat{{$employer->id}}"
                                            >
                                                @if ($employer->etat == 'actif')
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                @else
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                                @endif
                                                <br>{{$employer->etat == 'actif' ? 'Déactiver' : 'Activer'}}
                                            </button>
                                            <div class="modal fade" id="employerModalEtat{{$employer->id}}" tabindex="-1" aria-labelledby="employerModalEtatLabel{{$employer->id}}" aria-hidden="true">
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
                                                      <a href="{{route('employers.state.update', $employer)}}" class="btn btn-primary">{{$employer->etat == 'actif' ? "Déactiver" : "Activer"}}</a>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-sm btn-danger" title="Supprimer localité"
                                                data-toggle="modal" data-target="#exampleModal{{$employer->id}}">
                                                <i class="fa fa-times" aria-hidden="true"></i><br>
                                                Supprimer
                                            </button>
                                            <div class="modal fade" id="exampleModal{{$employer->id}}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel{{$employer->id}}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel{{$employer->id}}">
                                                                Avertissement</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Etes vous sur de bien vouloir effecturer cette action ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Annuler</button>
                                                            <a href="{{ route('employers.destroy', $employer) }}"
                                                                onclick="event.preventDefault(); document.getElementById('deleted-employer-{{$employer->id}}').submit();"
                                                                class="btn btn-danger">Supprimer</a>
                                                            <form id="deleted-employer-{{$employer->id}}"
                                                                action="{{ route('employers.destroy', $employer->ref) }}" method="POST"
                                                                style="display: none;">
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
                            @if (count($employers) <= 0)
                                <tr><td class="text-center" colspan="7">Aucun donnée trouvé</td></tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $employers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
