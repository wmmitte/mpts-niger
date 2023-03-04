<div>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="content-heading">Modification des informations utilisateur</h2>
        </div>
        <div class="col-sm-12 col-md-6 text-right">
            <div class="d-flex align-items-center justify-content-end h-100">
                <a class="btn btn-dark" href="{{ route('users.index') }}">Retour à la liste</a>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="block-content">
            <form wire:submit.prevent="updateUser">
                @csrf
                @include('backoffice.partials.users-form', ['userForm' => $user])
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
</div>
