<div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="content-heading">Nouveau utilisateur</h2>
        </div>
        <div class="col-sm-12 col-md-6 text-right">
            <div class="d-flex align-items-center justify-content-end h-100">
                <a class="btn btn-dark" href="{{ route('users.index') }}">Retour à la liste</a>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-content">
            <form wire:submit.prevent="saveUser">
                @csrf
                @include('backoffice.partials.users-form')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                    Enregistrer
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
