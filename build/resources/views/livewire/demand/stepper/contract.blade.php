<div>
    <form wire:submit.prevent="handlerBtn">
        @csrf
        @include('backoffice.partials.demand-contrat-form')
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group row">
                    <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit">
                            {{$btnName}}
                            <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
