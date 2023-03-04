{{-- @extends('errors::layout')
 --}}
@extends('layouts.blank.errors')
@section('title', __('Page introuvale'))
@section('code', '404')
@section('message',
    __("la page que vous avez demandée ne peut pas être traitée en raison d'une erreur dans. Veuillez
    vérifier que la page existe vraiment"))
