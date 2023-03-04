    @extends('layouts.blank.errors')


    @section('title', __('Accès non autrisé'))
    @section('code', '401')
    @section('message',
        __("Vous n'avez pas peut être pas les droits nécessaire pour cette oopéraation ou pour consulter
        cette page."))
