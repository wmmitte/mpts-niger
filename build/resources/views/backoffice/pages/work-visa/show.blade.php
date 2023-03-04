@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->

    @php
        $demand = $workVisa->demand;
        $dateCompare = \Carbon\Carbon::now()->addMonth();
        $endDateVisa = \Carbon\Carbon::parse($workVisa->end_date);
        $duration = $endDateVisa->lte($dateCompare);
    @endphp
    <div class="content">
        <div class="content">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h2 class="content-heading">Détail visa</h2>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <div class="d-flex align-items-center justify-content-end h-100">
                        @if (!$workVisa->email_comment && $duration)
                            @livewire('work-visa.relauch-confirm', ['workVisa' => $workVisa])
                        @endif
                        @livewire('decision.couriel', ['demand' => $demand, 'fullField' => false])
                        @livewire('decision.couriel', ['demand' => $demand, 'fullField' => true])
                        <a class="btn btn-dark mr-2" href="{{ route('work-visas.index') }}"><i class="fa fa-arrow-left"
                                aria-hidden="true"></i> Liste visas</a>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    <div class="block-content pb-4">
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
                                                        <dt>Date début :</dt>
                                                        <dd>{{ $contract->date_debut ? \Carbon\Carbon::parse($contract->date_debut)->format('d/m/Y') : '---' }}
                                                        </dd>
                                                        <dt>Date fin :</dt>
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
                                                        <dd>{{ $employee ? $employee->marital_status ?? '---' : '---' }}
                                                        </dd>
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
                                                        <dd>{{ $cityEmployee ? $cityEmployee->wording ?? '---' : '---' }}
                                                        </dd>
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
                                                        <dd>{{ $employer ? $employer->raison_social ?? '---' : '---' }}
                                                        </dd>
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
                                                        <dd>{{ $regionEmployer ? $regionEmployer->wording ?? '---' : '---' }}
                                                        </dd>
                                                        <dt>Ville :</dt>
                                                        <dd>{{ $cityEmployer ? $cityEmployer->wording ?? '---' : '---' }}
                                                        </dd>
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
                                <div class="p-2 border rounded mb-4 border-primary">
                                    <h5><strong>Information sur le visa</strong></h5>
                                    <dl class="dl">
                                        <dt>N° visa :</dt>
                                        <dd><span
                                                class="badge badge-pill badge-primary font-size-h3">{{ $workVisa->numero }}</span>
                                        </dd>
                                        <dt>Durée :</dt>
                                        <dd> <span class="badge badge-pill badge-primary font-size-h3">
                                                @if ($workVisa->duration)
                                                    {{ $workVisa->duration }} mois
                                                @else
                                                    --
                                                @endif

                                            </span>
                                        </dd>
                                        <dt>Date début :</dt>
                                        <dd> {{ $workVisa->start_date ? \Carbon\Carbon::parse($workVisa->start_date)->format('d/m/Y') : '---' }}
                                        </dd>
                                        <dt>Date fin :</dt>
                                        <dd> {{ $workVisa->end_date ? \Carbon\Carbon::parse($workVisa->end_date)->format('d/m/Y') : '---' }}
                                        </dd>
                                        <dt>Observation :</dt>
                                        <dd> {{ $workVisa->observation ? $demand->observation : '---' }} <br></dd>
                                    </dl>
                                </div>
                                <div class="show-demand-message-box">
                                    @isset($demand->reasons)
                                        <div class="row">
                                            @foreach ($demand->reasons as $reason)
                                                @livewire('demand.item-reason', ['reason' => $reason])
                                            @endforeach
                                        </div>
                                        @endif
                                    </div>
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
                                                            @include('backoffice.partials.demand-file-item',
                                                                ['attachment', $attachment])
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
            </div>
        </div>
        <!-- END Page Content -->
    @endsection

    @section('js_after')
        @livewireScripts
    @endsection
