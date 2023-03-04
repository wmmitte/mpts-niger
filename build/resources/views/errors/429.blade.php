    @extends('layouts.blank.errors')

    @section('title', __('Trop de requêttes'))
    @section('code', '429')
    @section('message', __('Il y a trop de requêtes vers cette page. Veuillez patienter avant de ressayer ou
        reconnecter-vous.'))
