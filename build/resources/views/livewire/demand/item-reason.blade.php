@php
    $color = 'info';
    if ($reason->name == 'Decision du Ministre') {
        $color = 'success';
    }
    if ($reason->name == 'Motif de rejet') {
        $color = 'danger';
    }
@endphp
<div class="border rounded alert-{{ $color }} mb-1 py-2 px-3">
    <span class="pl-2"><strong>{{ $reason->name }}</strong></span><br>
    <cite><small>{{ \Carbon\Carbon::parse($reason->created_at)->format('d/m/Y à H:i') }}</small></cite>
    <p class="blockquote-footer mb-0 {{ !$readMore ? 'text-truncate' : '' }}">
        <cite> <strong>{{ $reason->message }}</strong></cite><br />
        <cite><small>_ Par {{ $reason->author->firstname }} {{ $reason->author->lastname }} _</small></cite>
    </p>
    {{-- <p class="blockquote-footer mb-0 {{ !$readMore ? 'text-truncate' : '' }}">
        <cite>{{ $reason->message }}</cite><br />
        <cite><strong>Par {{ $reason->author->firstname }} {{ $reason->author->lastname }}</strong></cite>
    </p> --}}
    <a
        wire:click="handlerReadMore"><strong><small>{{ !$readMore ? 'Lire la suite' : 'Reduire' }}</small></strong></a><br />
</div>
