<div>
    @if ($demand->step == 6 && !$hasSummerPage)
        <div class="block">
            <div class="block-content p-4">
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <strong>Position : </strong>
                        {{ $demand->dealingStructure ? $demand->dealingStructure->wording : 'DAEP/SMMO Ministère' }} -
                        {{ $demand->updated_at? \Carbon\Carbon::parse($demand->updated_at)->locale('fr_FR')->diffForHumans(): '---' }}
                        -
                        @include('backoffice.partials.demand-statut-color', [
                            'status' => $demand->state,
                            'hasRecour' => $demand->has_recours,
                            'hasVisaCompleted' => $demand->visa?->demand_id,
                        ])
                        @if ($demand->has_recours)
                            <span class="badge badge-warning">Recours</span>
                        @endif
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="d-flex align-items-center justify-content-end h-100">
                            @if (($demand->state == 0 || $demand->state == -2) &&
                                $userEntity->id == $demand->dealing_structure &&
                                $daep->id == $demand->dealing_structure &&
                                $user->role == 'agent')
                                @can('agent-privilege')
                                    <a href="{{ route('demande.edit.general', $demand) }}"
                                        class="btn btn-success d-flex align-items-center border-0 mr-2" data-toggle="tooltip"
                                        title="Poursuivre l'enregistrement">
                                        <i class="fa fa-pencil"></i>
                                        <span class="ml-2">Modifier</span>
                                    </a>
                                @endcan
                            @endif
                            @if ($demand->state == 1 && $userEntity->id == $daep->id)
                                @if ($demand->visa)
                                    <a class="btn btn-success mr-2" href="{{ route('work-visas.show', $workVisa) }}">
                                        Consulter le visa</a>
                                    {{-- <a class="btn btn-success mr-2"
                                        href="{{ route('demande.couriel.generate', $demand) }}">
                                        Generer le couriel</a> --}}
                                @else
                                    @can('agent-privilege')
                                        <a class="btn btn-success" href="{{ route('work-visa.with.demand', $demand) }}">
                                            Completer le visa </a>
                                    @endcan
                                @endif
                            @elseif ($demand->state == -2 && $userEntity->id == $demand->dealing_structure)
                                @can('agent-privilege')
                                    @livewire('decision.couriel', ['demand' => $demand, 'fullField' => false])
                                    @livewire('decision.couriel', ['demand' => $demand, 'fullField' => true])

                                    <button type="button" class="btn btn-warning mr-2"
                                        title="Mettre la demande en recours gracieux" data-toggle="modal"
                                        data-target="#recoursModal">
                                        Recours gracieux </button>
                                    <div wire:ignore class="modal fade" id="recoursModal" tabindex="-1"
                                        aria-labelledby="recoursModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="block block-themed block-transparent mb-0">
                                                    <div class="block-header bg-primary-dark text-left">
                                                        <h3 class="block-title">Avertissament</h3>
                                                        <div class="block-options">
                                                            <button type="button" class="btn-block-option"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <i class="si si-close"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="block-content text-left">
                                                        <p class="mb-0">Etes-vous sur de bien vouloir effectuer cette
                                                            action
                                                            !?</p>
                                                        <p class="text-danger"><strong>NB </strong>: vous n'aurez plus la
                                                            possibilité de revenir en arrière. Veuillez vous rassurer avant
                                                            de poursuivre.
                                                        </p>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <label class="col-12" for="wording">
                                                                        Intitulé du document <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-12">
                                                                        <input type="text"
                                                                            class="form-control  @error('wording') is-invalid @enderror"
                                                                            wire:model="wording"
                                                                            value="{{ old('wording') }}" id="wording"
                                                                            name="wording"
                                                                            placeholder="Renseigner le libellé">
                                                                        @error('wording')
                                                                            <div class="form-text invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <label class="col-12" for="attach">
                                                                        Le fichier à charger <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-12">
                                                                        <input type="file"
                                                                            class="form-control  @error('attach') is-invalid @enderror"
                                                                            wire:model="attach" id="attach"
                                                                            name="attach"
                                                                            placeholder="Selectionner le fichier"
                                                                            accept=".pdf">
                                                                        @error('attach')
                                                                            <div class="form-text invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group row">
                                                                    <label class="col-12" for="avisTech">Avis technique
                                                                        recours gracieux</label>
                                                                    <div class="col-12">
                                                                        <textarea class="form-control  @error('avisTech') is-invalid @enderror" wire:model="avisTech" id="avisTech"
                                                                            name="avisTech" rows="3" placeholder="Renseigner l'avis du chef DAES"></textarea>
                                                                        @error('avisTech')
                                                                            <div class="form-text invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-dark"
                                                        data-dismiss="modal">Annuler</button>
                                                    <button class="btn btn-success" data-dismiss="modal" type="submit"
                                                        wire:click="recourGracieux">
                                                        Mettre la demande en recour gracieux
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                            @else
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($userEntity->id == $demand->dealing_structure &&
            $demand->state == 0 &&
            ($user->role == 'directeur' || ($user->role == 'general' && $demand->dealing_structure == $ministrere->id)))
            <div class="alert alert-danger">
                <div class="block-content p-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-12"
                                    for="raison">{{ $demand->dealing_structure == $ministrere->id ? 'Décision du ministre' : 'Avis technique' }}</label>
                                <div class="col-12"><strong>NB: Veuillez
                                        {{ $demand->dealing_structure
                                            ? ' motiver votre décision si toute fois elle est positive. Au cas ou elle est negative, veuillez cliquer sur le bouton rouge "Rejeter la demande"'
                                            : ' renseigner votre avis technique sur la demande' }}
                                    </strong></div>
                                <div class="col-12">
                                    <textarea class="form-control  @error('raison') is-invalid @enderror" wire:model="raison"
                                        id="exampleFormControlTextarea1" name="raison" rows="3" placeholder="Renseignez votre avis/décision"></textarea>
                                    @error('raison')
                                        <div class="form-text invalid-feedback d-block">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary" type="button" wire:click="avisTechnique">
                                {{ $user->role == 'general' && $demand->dealing_structure == $ministrere->id ? 'Enregistrer et accorder le visa' : 'Enregistrer et soumettre' }}
                            </button>
                            @if ($demand->state == 0 &&
                                $demand->dealing_structure == $userEntity->id &&
                                $ministrere->id == $userEntity->id &&
                                ($user->role == 'general' || $user->role == 'directeur'))
                                <button type="button" class="btn btn-danger mr-2"
                                    title="Plus d'information sur cet employeur" data-toggle="modal"
                                    data-target="#rejectedDemandModal">
                                    Rejeter la demande </button>
                                <div wire:ignore class="modal fade" id="rejectedDemandModal" tabindex="-1"
                                    aria-labelledby="rejectedDemandModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="block block-themed block-transparent mb-0">
                                                <div class="block-header bg-primary-dark text-left">
                                                    <h3 class="block-title">Avertissement</h3>
                                                    <div class="block-options">
                                                        <button type="button" class="btn-block-option"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <i class="si si-close"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="block-content text-left">
                                                    <p class="mb-0">Etes-vous sur de bien vouloir effectuer cette
                                                        action
                                                        !?</p>
                                                    <p class="text-danger"><strong>NB </strong>: vous n'aurez plus la
                                                        possibilité d'annuler. Veuillez vous rassurer avant de
                                                        poursuivre.
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group row">
                                                                <label class="col-12" for="motif">Motif du
                                                                    rejet</label>
                                                                <div class="col-12">
                                                                    <textarea class="form-control  @error('motif') is-invalid @enderror" wire:model="motif"
                                                                        id="exampleFormControlTextarea1" name="motif" rows="3" placeholder="Renseigner les motifs du rejet"></textarea>
                                                                    @error('motif')
                                                                        <div class="form-text invalid-feedback d-block">
                                                                            {{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-dark"
                                                    data-dismiss="modal">Annuler</button>
                                                <button class="btn btn-danger" data-dismiss="modal" type="submit"
                                                    wire:click="rejected">
                                                    Rejeter la demande
                                                    <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
    <div class="block">
        <div class="block-content p-4">
            <div class="row">
                <div class="col-sm-12 col-lg-8">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="p-2 border rounded">
                                <h5><strong>Informations sur la demande</strong></h5>
                                <div class="row">
                                    @php
                                        $contract = $demand->contract;
                                        $city = $contract ? $contract->locality : null;
                                        $region = $city ? $city->locality : null;
                                        $country = $region ? $region->locality : null;
                                    @endphp
                                    <div class="col-sm-12 col-lg-6">
                                        <dl class="dl">
                                            <dt>Référence :</dt>
                                            <dd>{{ $demand->id }}</dd>
                                            <dt>Type de demande :</dt>
                                            <dd><span
                                                    class="badge badge-pill badge-{{ $demand->type == 'nouvelle' ? 'info' : 'warning' }} text-uppercase">
                                                    {{ $demand->type }}
                                                </span></dd>
                                            <br>
                                            <dt>Type de contrat :</dt>
                                            <dd>{{ $contract->type ? $contract->type : '---' }}</dd>
                                            <dt>Salaire :</dt>
                                            <dd>{{ $contract->salaire ? $contract->salaire : '---' }}</dd>
                                            <dt>Date début du contrat:</dt>
                                            <dd>{{ $contract->date_debut ? \Carbon\Carbon::parse($contract->date_debut)->format('d/m/Y') : '---' }}
                                            </dd>
                                            <dt>Durée du contrat :</dt>
                                            <dd>{{ $contract->time ? "$contract->time mois" : '---' }}
                                            </dd>
                                            <dt>Date fin estimée du contrat :</dt>
                                            <dd>{{ $contract->date_fin ? \Carbon\Carbon::parse($contract->date_fin)->format('d/m/Y') : '---' }}
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">

                                        <dl class="dl">
                                            <dt>Region d'affectation : </dt>
                                            <dd>{{ $region ? $region->wording : '---' }}</dd>
                                            <dt>Ville d'affectation' :</dt>
                                            <dd>{{ $city ? $city->wording : '---' }}</dd>
                                            <dt>Crée le :</dt>
                                            <dd>{{ $demand->created_at ? \Carbon\Carbon::parse($demand->created_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            <dt>Mise à jour le :</dt>
                                            <dd>{{ $demand->updated_at ? \Carbon\Carbon::parse($demand->updated_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            {{-- <dt>Crée le :</dt>
                                             <dd>{{ $contract->created_at ? \Carbon\Carbon::parse($contract->created_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            <dt>Mise à jour le :</dt>
                                            <dd>{{ $contract->updated_at ? \Carbon\Carbon::parse($contract->updated_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd> --}}
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2 border rounded mt-4">
                                @php
                                    $contract = $demand->contract;
                                    $employee = $contract->employee;
                                    $cityEmployee = $employee ? $employee->locality : null;
                                    $regionEmployee = $city ? $city->locality : null;
                                    $countryEmployee = $regionEmployee ? $regionEmployee->locality : null;
                                @endphp
                                <h5><strong>Informations sur l'employé</strong></h5>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <dl class="dl">
                                            <dt>Nom :</dt>
                                            <dd>{{ $employee ? $employee->lastname ?? '---' : '---' }}</dd>
                                            <dt>Prenom(s) :</dt>
                                            <dd>{{ $employee ? $employee->firstname ?? '---' : '---' }}</dd>
                                            <dt>Date de naissance :</dt>
                                            <dd>{{ $employee
                                                ? ($employee->date_of_birth
                                                    ? \Carbon\Carbon::parse($employee->date_of_birth)->format('d/m/Y')
                                                    : '---')
                                                : '---' }}
                                            </dd>
                                            <dt>Sexe :</dt>
                                            <dd>
                                                @if ($employee->genre == 'male')
                                                    Masculin
                                                @else
                                                    Féminin
                                                @endif
                                            </dd>
                                            <dt>Nationalité :</dt>
                                            <dd>{{ $employee ? $employee->nationalite ?? '---' : '---' }}</dd>
                                            <dt>Situation matrimoniale :</dt>
                                            <dd>{{ $employee ? $employee->marital_status ?? '---' : '---' }}</dd>
                                            <dt>Profession :</dt>
                                            <dd>{{ $employee ? $employee->profession ?? '---' : '---' }}</dd>
                                            <dt>Crée le :</dt>
                                            <dd>{{ $employee->created_at ? \Carbon\Carbon::parse($employee->created_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            <dt>Mise à jour le :</dt>
                                            <dd>{{ $employee->updated_at ? \Carbon\Carbon::parse($employee->updated_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <dl class="dl">
                                            <dt>Pays de provenance :</dt>
                                            <dd>{{ $cityEmployee ? $cityEmployee?->locality?->locality?->wording ?? '---' : '---' }}
                                            </dd>
                                            <dt>Région de provenance :</dt>
                                            <dd>{{ $cityEmployee ? $cityEmployee?->locality?->wording ?? '---' : '---' }}
                                            <dt>ville de provenance :</dt>
                                            <dd>{{ $cityEmployee ? $cityEmployee->wording ?? '---' : '---' }}</dd>
                                            <dt>Résidence :</dt>
                                            <dd>{{ $employee ? $employee->residence ?? '---' : '---' }}</dd>
                                            <dt>Adresse :</dt>
                                            <dd>{{ $employee ? $employee->quartier ?? '---' : '---' }}</dd>
                                            <dt>N° Téléphone :</dt>
                                            <dd>{{ $employee ? $employee->phone ?? '---' : '---' }}</dd>
                                            <dt>E-mail :</dt>
                                            <dd>{{ $employee ? $employee->email ?? '---' : '---' }}</dd>
                                            <dt>Boite postale :</dt>
                                            <dd>{{ $employee ? $employee->mailbox ?? '---' : '---' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="p-2 border rounded mt-4">
                                @php
                                    $contract = $demand->contract;
                                    $employer = $contract->employer;
                                    $industry = $employer->industry;
                                    $cityEmployer = $employer ? $employer->locality : null;
                                    $regionEmployer = $cityEmployer ? $cityEmployer->locality : null;
                                    $countryEmployer = $regionEmployer ? $regionEmployer->locality : null;
                                    $phones = $employer->phone ? (gettype($employer->phone) == 'string' ? json_decode($employer->phone) : $employer->phone) : null;
                                @endphp
                                <h5><strong>Informations sur l'employeur</strong></h5>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <dl class="dl">
                                            <dt>Nom & prénom(s) :</dt>
                                            <dd> {{ $demand->applicant_fullname ?? '---' }}</dd>
                                            <dt>N° Téléphone :</dt>
                                            <dd> {{ $demand->applicant_phone ?? '---' }}</dd>
                                            <dt>E-mail :</dt>
                                            <dd> {{ $demand->applicant_email ?? '---' }}</dd>
                                            <dt>Crée le :</dt>
                                            <dd>{{ $demand->created_at ? \Carbon\Carbon::parse($demand->created_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            <dt>Mise à jour le :</dt>
                                            <dd>{{ $demand->updated_at ? \Carbon\Carbon::parse($demand->updated_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                        </dl>
                                        <br>
                                        <dl class="dl">
                                            <dt>Raison sociale :</dt>
                                            <dd>{{ $employer ? $employer->raison_social ?? '---' : '---' }}</dd>
                                            <dt>Branche d'activité :</dt>
                                            <dd> {{ $industry ? $industry->wording : '---' }}</dd>
                                            <dt>N° Téléphone :</dt>
                                            <dd>
                                                @if ($phones)
                                                    @foreach ($phones ?? [] as $key => $phone)
                                                        <span>{{ $phone }}{{ $key == count($phones) - 1 ? '' : ', ' }}</span>
                                                    @endforeach
                                                @endif
                                            </dd>
                                            <dt>E-mail :</dt>
                                            <dd>{{ $employer ? $employer->email ?? '---' : '---' }}</dd>

                                            <dt>Boite postale :</dt>
                                            <dd>{{ $employer ? $employer->mailbox ?? '---' : '---' }}</dd>

                                            <dt>Site web :</dt>
                                            <dd>{{ $employer ? $employer->web_site ?? '---' : '---' }}</dd>
                                            <dt>Crée le :</dt>
                                            <dd>{{ $employer->created_at ? \Carbon\Carbon::parse($employer->created_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                            <dt>Mise à jour le :</dt>
                                            <dd>{{ $employer->updated_at ? \Carbon\Carbon::parse($employer->updated_at)->format('d/m/Y H:i:s') : '---' }}
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <dl class="dl">
                                            <dt>Pays :</dt>
                                            <dd>{{ $countryEmployer ? $countryEmployer->wording ?? '---' : '---' }}
                                            </dd>
                                            <dt>Région :</dt>
                                            <dd>{{ $regionEmployer ? $regionEmployer->wording ?? '---' : '---' }}</dd>
                                            <dt>Ville :</dt>
                                            <dd>{{ $cityEmployer ? $cityEmployer->wording ?? '---' : '---' }}</dd>
                                            <dt>Adresse :</dt>
                                            <dd>{{ $employer ? $employer->quarter ?? '---' : '---' }}</dd>
                                            <dt>Statut actuelle :</dt>
                                            <dd>
                                                @if ($employer->etat)
                                                    <span
                                                        class="badge badge-pill badge-{{ $employer->etat == 'actif' ? 'success' : 'danger' }}">
                                                        {{ $employer->etat }}
                                                    </span>
                                                @else
                                                    ---
                                                @endif
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-4">
                    @isset($demand->reasons)
                        <div wire:ignore class="row">
                            @foreach ($demand->reasons as $reason)
                                <div class="col-12" wire:key="{{ $reason->id }}">
                                    @livewire('demand.item-reason', ['reason' => $reason])
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="p-2 border rounded mt-4">
                            @php
                                $demandFiles = $demand->demandFiles;
                            @endphp
                            <h5><strong>Pieces jointes</strong></h5>
                            <div class="row">
                                @if ($demandFiles)
                                    @if (count($demandFiles) > 0)
                                        @foreach ($demandFiles as $attachment)
                                            <div class="col-sm-12 col-md-2">
                                                @include('backoffice.partials.demand-file-item', [
                                                    'attachment',
                                                    $attachment,
                                                ])
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="col-12 text-center">Aucun document trouvée</div>
                                    @endif
                                @else
                                    <div class="col-12 text-center">Aucun document trouvée</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
