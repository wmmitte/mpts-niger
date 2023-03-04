<div>
    <div class="block-content">
        <form wire:submit.prevent="updateLocality">
            @csrf
            @include('backoffice.partials.localities-form', ['localityForm' => $locality])
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                Enregister
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
