<div>
    <div class="block-content">
        <div class="row">
            <div class="col-12">
                <div class="form-group row justify-content-end">
                    <div class="col-6">
                        <input type="text" class="form-control" wire:model="search"
                        id="search" name="search" placeholder="recherche à partir du nom, prenom, email et telephone  ...">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center"><i class="fa fa-filter" aria-hidden="true"></i></th>
                                <th>Nom</th>
                                <th>Prenom(s)</th>
                                <th>Telephone</th>
                                <th>email</th>
                                <th>Pays</th>
                                <th>Ville</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    @php
                                        $employeeSelectedId = $employeeSelected ? $employeeSelected->id : '';
                                    @endphp
                                    <td class="text-center">
                                        <label class="css-control css-control-success css-checkbox disabled">
                                            <input type="checkbox" class="css-control-input"
                                                    {{$employeeSelectedId == $employee->id ? 'checked' : ''}} disabled>
                                            <span class="css-control-indicator"></span>
                                        </label>
                                    </td>
                                    <td>{{ $employee->lastname }}</td>
                                    <td>{{ $employee->firstname }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->locality ? (
                                            $employee->locality->locality ? $employee->locality->locality->wording : '---'
                                        ) : '---' }}</td>
                                    <td>{{ $employee->locality ? $employee->locality->wording : '---' }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm">
                                            <button type="button" class="btn btn-sm btn-info"
                                                title="Plus d'information sur cet employé"
                                                data-toggle="modal" data-target="#employeeShowModalEtat{{$employee->id}}"
                                            >
                                                <span class="d-flex align-items-center">
                                                    <i class="fa fa-eye" aria-hidden="true"></i><br/>
                                                    <span>Détail</span>
                                                </span>
                                            </button>
                                            <div class="modal fade" id="employeeShowModalEtat{{$employee->id}}" tabindex="-1" aria-labelledby="employeeShowModalEtatLabel{{$employee->id}}" aria-hidden="true">
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
                                                                @livewire('employee.show', ['employee' => $employee])
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($employeeSelectedId !== $employee->id)
                                                <button class="btn btn-sm btn-success" wire:click="handlerBtn({{$employee}})"
                                                    data-toggle="tooltip" title="Selectionner cet employé et poursuivre" data-placement="right">
                                                    <span class="d-flex align-items-center">
                                                        <span class="mr-2">Selectionner</span>
                                                        <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if (count($employees) <= 0)
                                <tr><td class="text-center" colspan="7">Aucun donnée trouvé</td></tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $employees->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
