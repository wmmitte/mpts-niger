<div>
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <div class="p-2">
                <dl class="dl">
                    <dt>Situation matrimoniale :</dt><dd> {{$employee->marital_status ? $employee->marital_status : '---'}}</dd>
                    <dt>Nom :</dt><dd> {{$employee->lastname ? $employee->lastname : '---'}}</dd>
                    <dt>Prenom(s) :</dt><dd> {{$employee->firstname ? $employee->firstname : '---'}}</dd>
                    <dt>Genre :</dt><dd> {{$employee->genre ? $employee->genre : '---'}}</dd>
                    <dt>Adresse email :</dt><dd> {{$employee->email ? $employee->email : '---'}}</dd>
                    <dt>Numéro de téléphone :</dt><dd> {{$employee->phone ? $employee->phone : '---'}}</dd>
                    <dt>Date de naissance :</dt><dd> {{$employee->date_of_birth ?
                        \Carbon\Carbon::parse($employee->date_of_birth)->format('d/m/Y') : '---'
                    }}</dd>

                </dl>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6">
            <div class="p-2">
                <dl class="dl">
                    <dt>Pays :</dt><dd>{{$employee->locality ? ($employee->locality->locality ? $employee->locality->locality->wording : '---') : '---'}}</dd>
                    <dt>Ville :</dt><dd>{{$employee->locality ? $employee->locality->wording : '---'}}</dd>
                    <dt>Adresse :</dt><dd> {{$employee->quartier ? $employee->quartier : '---'}}</dd>
                    <dt>Résidence :</dt><dd> {{$employee->residence ? $employee->residence : '---'}}</dd>
                    <dt>Profession :</dt><dd> {{$employee->profession ? $employee->profession : '---'}}</dd>
                    <dt>Boite postale :</dt><dd> {{$employee->mailbox ? $employee->mailbox : '---'}}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
