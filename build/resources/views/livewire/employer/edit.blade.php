<div>
    <div class="block-content">
        <form wire:submit.prevent="saveEmployer">
            @csrf
            @include('backoffice.partials.employers-form')
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                        <div class="col-12">
                            <button class="btn btn-success" type="submit">
                                <i class="fa fa-check" aria-hidden="true"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
