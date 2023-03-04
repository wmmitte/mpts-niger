@extends('layouts.back.admin')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <h2 class="content-heading">Modification mot de passe compte</h2>
        </div>
    </div>
    <div class="block">
        <div class="block-content">
            <form action="{{route('account.password.update')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                            <label class="col-12" for="oldPassword">Ancien mot de passe</label>
                            <div class="col-12">
                                <input type="password" class="form-control  @error('oldPassword') is-invalid @enderror" value="{{old('oldPassword')}}" id="oldPassword" name="oldPassword" placeholder="Renseigner l'ancien mot de passe'">
                                @error('oldPassword')
                                <div class="form-text invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                            <label class="col-12" for="newPassword">Nouveau mot de passe</label>
                            <div class="col-12">
                                <input type="password" class="form-control @error('newPassword') is-invalid @enderror" value="{{old('newPassword')}}" id="newPassword" name="newPassword" placeholder="Renseigner le nouveau mot de passe">
                                @error('newPassword')
                                    <div class="form-text invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group row">
                            <label class="col-12" for="cNewPassword">Confirmer nouveau mot de passe</label>
                            <div class="col-12">
                                <input type="password" class="form-control @error('cNewPassword') is-invalid @enderror" value="{{old('cNewPassword')}}" id="cNewPassword" name="cNewPassword" placeholder="Confirmer le nouveau mot de passe">
                                @error('cNewPassword')
                                    <div class="form-text invalid-feedback d-block">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <div class="col-12">
                                <button class="btn btn-secondary" type="submit">
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

@endsection
