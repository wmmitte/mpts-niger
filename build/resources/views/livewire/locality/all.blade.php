<div>
    <div class="block-content">
        <div class="row">
            <div class="col-md-12 col-lg-6">
                <div class="form-group row justify-content-end">
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='typeLocality' type="radio" name="typeLocality" id="continent" value="continent" checked>
                            <label class="form-check-label" for="continent">Continents</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='typeLocality' type="radio" name="typeLocality" id="country" value="country" checked>
                            <label class="form-check-label" for="country">Pays</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='typeLocality' type="radio" name="typeLocality" id="district" value="district">
                            <label class="form-check-label" for="district">Régions</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input" wire:model='typeLocality' type="radio" name="typeLocality" id="city" value="city">
                            <label class="form-check-label" for="city">Villes</label>
                        </div>
                    </div>
                </div>
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
                                <th>Nom de la localité</th>
                                @if ($typeLocality !== 'city')
                                    <th>Nombre</th>
                                @endif
                                @if ($typeLocality !== 'continent')
                                    <th>
                                        @if ($typeLocality == 'country')
                                            Continent
                                        @else
                                            {{$typeLocality == 'city' ? 'Regions' : 'Pays'}}
                                        @endif
                                    </th>

                                @endif
                                <th>Nationnalité</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($localities as $locality)
                                <tr>
                                    {{-- <td class="text-center">
                                        <img class="img-avatar img-avatar48" src="{{ asset($locality->avatar ? "/storage/$locality->flat" : 'media/avatars/avatar15.jpg') }}" alt="">
                                    </td> --}}
                                    <td>{{ "$locality->wording" }}</td>

                                    @if ($typeLocality !== 'city')
                                        {{-- <td>@include('backoffice.partials.locality-type', [
                                            'type' => $locality->type,
                                        ])</td> --}}
                                        <td>
                                            {{$locality->localities->count()}}{{' '}}
                                            {{$typeLocality == 'continent' ? 'pays' :
                                                ($typeLocality == 'country' ? 'région(s)' :
                                                    ($typeLocality == 'district' ? 'ville(s)' : ''))}}
                                        </td>
                                    @endif
                                    @if ($typeLocality !== 'continent')
                                        <td>
                                            @if ($locality->locality)
                                                {{$locality->locality->wording}}
                                                {{$locality->type == 'city' ?
                                                    ($locality->locality->locality ?
                                                        '('.$locality->locality->locality->wording.')' : '') : ''}}
                                            @endif
                                        </td>
                                    @endif
                                    <td>{{
                                            $locality->nationality ? $locality->nationality :
                                                ($locality->locality
                                                    ? ($locality->locality->locality ?
                                                        $locality->locality->locality->nationality : '---')
                                                : '---')
                                        }}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            {{-- <a href="{{route('localities.show', $locality)}}" class="btn btn-sm btn-secondary" data-toggle="tooltip" title="Modifier ce profile utilisateur">
                                                <i class="fa fa-eye" aria-hidden="true"></i><br>
                                                Détailer
                                            </a> --}}
                                            @can('super-privilege')
                                                ---
                                            @endcan
                                            @cannot('super-privilege')
                                            <a href="{{ route('localities.edit', $locality) }}"
                                                class="btn btn-sm btn-secondary" data-toggle="tooltip"
                                                title="Modifier ce profile utilisateur">
                                                <i class="fa fa-pencil"></i><br>
                                                Modifier
                                            </a>
                                            <button type="button" class="btn btn-sm btn-secondary"
                                                title="Supprimer localité" data-toggle="modal"
                                                data-target="{{ "#exampleModal$locality->id" }}">
                                                <i class="fa fa-times" aria-hidden="true"></i><br>
                                                Supprimer
                                            </button>
                                            <div class="modal fade" id="{{ "exampleModal$locality->id" }}"
                                                tabindex="-1" aria-labelledby="{{ "exampleModalLabel$locality->id" }}"
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
                                                            <a href="{{ route('localities.destroy', $locality) }}"
                                                                onclick="event.preventDefault(); document.getElementById('deleted-locality-{{ $locality->id }}').submit();"
                                                                class="btn btn-danger">Supprimer</a>
                                                            <form id="deleted-locality-{{ $locality->id }}"
                                                                action="{{ route('localities.destroy', $locality) }}"
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
                            @if (count($localities) <= 0)
                                <tr>
                                    <td class="text-center" colspan="5">Aucun donnée trouvé</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $localities->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
