    @extends('layouts.blank.errors')

    @section('title', __('Erreur'))
    @section('code', '500')
    @section('message',
        __("Une erreur est survenue durant l'opération. Veuillez revoir les iformations saisies ou
        contacter l'admiistrateur de la plateforme"))
