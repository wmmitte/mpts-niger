<div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="p-2">
                @php
                    $phones = $employer->phone ? (
                            gettype($employer->phone) == 'string' ? json_decode($employer->phone) : $employer->phone
                        ) : null;
                @endphp
                <dl class="dl">
                    <dt>Raison social :</dt><dd>{{$employer->raison_social}}</dd>
                    <dt>Domaine de qualification :</dt><dd>{{$employer->industry ? $employer->industry->wording : '---'}}</dd>
                    <dt>Adresse email :</dt><dd> {{$employer->email ?? '---'}}</dd>
                    <dt>Téléphone :</dt>
                    <dd>
                        @if ($phones)
                            @foreach ($phones ?? [] as $key => $phone)
                                <span>{{ $phone }}{{ $key == count($phones) - 1 ? '' : ', ' }}</span>
                            @endforeach
                        @endif
                    </dd>
                    <dt>Site internet :</dt><dd> {{$employer->web_site ?? '---'}}</dd>
                    <dt>Statut actuel :</dt><dd>
                        @if ($employer->etat)
                            <span class="badge badge-pill badge-{{ $employer->etat == 'actif' ? 'success' : 'danger' }}">
                                {{ $employer->etat }}
                            </span>
                        @else
                        ---
                        @endif
                    </dd>
                </dl>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="p-2">
                <dl class="dl">
                    <dt>Région :</dt><dd>{{$employer->locality ? ($employer->locality->locality ? $employer->locality->locality->wording : '---') : '---'}}</dd>
                    <dt>Ville :</dt><dd>{{$employer->locality ? $employer->locality->wording : '---'}}</dd>
                    <dt>Adresse :</dt><dd> {{$employer->quarter ?? '---'}}</dd>
                    <dt>Boite postale :</dt><dd> {{$employer->mailbox ?? '---'}}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
