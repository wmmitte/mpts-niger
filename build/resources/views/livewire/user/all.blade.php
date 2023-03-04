<div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="content-heading">Liste des utilisateurs</h2>
        </div>
        @cannot('super-privilege')
            <div class="col-sm-12 col-md-6 text-right">
                <div class="d-flex align-items-center justify-content-end h-100">
                    <a class="btn btn-outline-info" href="{{ route('users.create') }}"><i class="fa fa-plus"
                            aria-hidden="true"></i>
                        Ajouter un utilisateur</a>
                </div>
            </div>
        @endcannot
    </div>
    <div class="block">
        <div class="block-content">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row justify-content-end">
                        <div class="col-4">
                            <input type="text" class="form-control" wire:model="search" id="search" name="search"
                                placeholder="recherche à partir du nom ou prenom ...">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-vcenter">
                            <thead>
                                <tr>
                                    <th class="text-center"><i class="si si-user"></i></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Direction/service</th>
                                    <th>Role</th>
                                    <th>Accès</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($users)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <img class="img-avatar img-avatar48"
                                                    src="{{ asset($user->avatar ? "/storage/$user->avatar" : 'media/avatars/avatar15.jpg') }}"
                                                    alt="">
                                            </td>
                                            <td>{{ "$user->firstname $user->lastname" }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->entity ? $user->entity->wording : '---' }}</td>
                                            <td>
                                                @include('backoffice.partials.role-style', [
                                                    'role' => $user->role,
                                                ])
                                            </td>
                                            <td><span
                                                    class="badge badge-pill badge-{{ $user->lock ? 'danger' : 'success' }}">
                                                    {{ $user->lock ? 'Desactivé' : 'Activé' }}
                                                </span></td>
                                            <td class="text-center">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('users.show', $user) }}"
                                                        class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                        title="Modifier ce profile utilisateur">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                        Détails
                                                    </a>
                                                    @if ($userConnectInfo->id !== $user->id && ($user->role !== 'admin' && $user->userConnectInfo !== 'admin'))
                                                        @cannot('super-privilege')
                                                            <a href="{{ route('users.edit', $user) }}"
                                                                class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                                title="Modifier ce profile utilisateur">
                                                                <i class="fa fa-pencil"></i>
                                                                Modifier
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                title={{ $user->lock ? 'Déverrouiller' : 'Verrouiller' . " l'accès de ce compte" }}
                                                                data-toggle="modal"
                                                                data-target="#exampleModal{{ $user->id }}">
                                                                @if ($user->lock)
                                                                    <i class="fa fa-unlock" aria-hidden="true"></i>
                                                                    Activer
                                                                @else
                                                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                                                    Desactiver
                                                                @endif
                                                            </button>
                                                            <div class="modal fade" id="exampleModal{{ $user->id }}"
                                                                tabindex="-1"
                                                                aria-labelledby="{{ "exampleModalLabel$user->id" }}"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="block block-themed block-transparent mb-0">
                                                                            <div class="block-header bg-primary-dark text-left">
                                                                                <h3 class="block-title">Avertissement</h3>
                                                                                <div class="block-options">
                                                                                    <button type="button"
                                                                                        class="btn-block-option"
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
                                                                            <a href="{{ route('account.access.update', $user) }}"
                                                                                class="btn btn-primary">{{ $user->lock ? 'Déverrouiller' : 'Verrouiller' }}</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endcannot
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                                @if (count($users ?? []) <= 0)
                                    <tr>
                                        <td class="text-center" colspan="7">Aucun donnée trouvé</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        @isset($users)
                            {{ $users->links() }}
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
