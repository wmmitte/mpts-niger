<div>
    <div class="block-content">
        <form wire:submit.prevent="updateActivity">
            @csrf
            @include('backoffice.partials.activities-form')
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
