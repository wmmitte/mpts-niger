@if ($message = Session::get('success'))
<div class="alert alert-success alert-block mb-0">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><span>{!! $message !!}</span></strong>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block mb-0">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><span>{!! $message !!}</span></strong>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block mb-0">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><span>{!! $message !!}</span></strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block mb-0">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><span>{!! $message !!}</span></strong>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger mb-0">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <div>
        <span>Vérifiez les erreurs suivantes:</span>
        <p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li> <strong><span>{!! $error !!}</span></strong></li>
                @endforeach
            </ul>
        </p>
    </div>
</div>
@endif
