<div>
    <div class="row">
        <div class="col-sm-12 col-lg-4">
            <div class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="">
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light">
                    <div class="font-w600 mb-5">{{ $user->lastname . ' ' . $user->firstname }}</div>
                    <div class="font-size-sm text-muted">
                        @include('backoffice.partials.role-name', ['role' => $user->role]), {{ $user->entity ? $user->entity->wording : '' }}
                    </div>
                </div>
                <div class="block-content">
                    <div class="row items-push text-center">
                        <div class="col-6">
                            <div class="mb-5"><i class="si si-briefcase fa-2x"></i></div>
                            <div class="font-size-sm text-muted">{{ $user->demands ? $user->demands->count() : '0' }}
                                Demandes</div>
                        </div>
                        <div class="col-6">
                            <div class="mb-5"><i class="si si-clock fa-2x text-corporate"></i></div>
                            <div class="font-size-sm text-muted">
                                {{ $user->last_connection ? $user->last_connection : 'Jamais' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-borderless mt-20">
                <tbody>
                    <tr>
                        <td class="font-w600">Sexe</td>
                        <td>
                            @if ($user->genre == 'male')
                                Masculin
                            @else
                                Féminin
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="font-w600">E-mail</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td class="font-w600">N° Téléphone</td>
                        <td>{{ $user->phone ? $user->phone : '' }}</td>
                    </tr>
                    <tr>
                        <td class="font-w600">Status du compte</td>
                        <td>
                            @if ($user->lock)
                                <span class="badge badge-pill badge-danger">compte desactivé</span>
                            @else
                                <span class="badge badge-pill badge-success">compte actif</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-lg-8">
            <div class="block">
                <div class="block-content">
                    @livewire('user.demands', ['userId' => $user->id])
                </div>
            </div>
        </div>
    </div>
</div>
