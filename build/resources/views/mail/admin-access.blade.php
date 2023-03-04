<div>
    <h1>Bonjour M / Mme {{$user->lastname}}</h1>
    @if ($reset === 1)
    <p>L'administrateur a réinitialisé votre mot de passe.</p>
    <p>Votre noauveau mot de passe est: </p>
    @else
    <p>Un compte a été créé avec votre adresse mail.</p>
    <p>Le mot de passe est: </p>
    @endif
    <h4><strong>{{$password}}</strong></h4>
    <p>Cordialement</p>
</div>
