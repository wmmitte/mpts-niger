<nav id="sidebar">
    @php
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $service = $user ? $user->entity : null;
        $userServiceId = $service ? $service->id : null;
        $daep = App\Models\Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $dge = App\Models\Entity::where('slug', Str::slug("Direction general de l\'emploie"))->first();
        $sg = App\Models\Entity::where('slug', Str::slug('SG Ministère'))->first();
        $ministrere = App\Models\Entity::where('slug', Str::slug('Ministère'))->first();
        $nbrDemandPourDecision = App\Models\Demand::where('state', 0)
            ->where('dealing_structure', $userServiceId)
            ->where('dealing_structure', $ministrere->id)
            ->count();
        $nbrDemandPourAvis = App\Models\Demand::where('state', 0)
            ->where('dealing_structure', $userServiceId)
            ->where('dealing_structure', '!=', $ministrere->id)
            ->count();

        $visaDemands = App\Models\Demand::where(function ($query) use ($userServiceId, $userId) {
            $query->where('dealing_structure', $userServiceId)->orWhere(function ($query) use ($userServiceId, $userId) {
                $query->whereHas('structures', function ($query) use ($userId, $userServiceId) {
                    $query->where('user_id', $userId)->orWhere(function ($query) use ($userServiceId) {
                        $query->whereHas('chargeOf', function ($query) use ($userServiceId) {
                            $query->where('entity_id', $userServiceId);
                        });
                    });
                });
            });
        });
        $_demandes = clone $visaDemands;
        $_demandes_a_completer = clone $visaDemands; //pour chercher après les demandes par rappor au visas
        $nbrAllDemandCompletes = $visaDemands->count();
        $nbrAllDemandPourAvis = $visaDemands->where('state', 0)->count();
        $visaDemands = clone $_demandes;
        $nbrAllDemandRejetees = $visaDemands->where('state', -2)->count();
        $visaDemands = clone $_demandes;
        $nbrAllDemandGracieux = $visaDemands
            ->where('has_recours', true)
            ->where('state', 0)
            ->count();
        $visaDemands = clone $_demandes;

        $visas = App\Models\WorkVisa::whereHas('demand', function ($query) use ($userServiceId, $userId) {
            $query->where(function ($query) use ($userServiceId, $userId) {
                $query->where('dealing_structure', $userServiceId)->orWhere(function ($query) use ($userServiceId, $userId) {
                    $query->whereHas('structures', function ($query) use ($userId, $userServiceId) {
                        $query->where('user_id', $userId)->orWhere(function ($query) use ($userServiceId) {
                            $query->whereHas('chargeOf', function ($query) use ($userServiceId) {
                                $query->where('entity_id', $userServiceId);
                            });
                        });
                    });
                });
            });
        });
        $_visas_completees = clone $visas; //pour chercher après les id_ de demandes existant dans visa
        $nbrAllVisas = $visas->where('demand_id', '>', 0)->count();

        $_visas_completees = $_visas_completees
            ->select('demand_id')
            ->where('demand_id', '>', 0)
            ->pluck('demand_id')
            ->toArray();
        $_visas_a_completer = $_demandes_a_completer
            ->where('state', 1)
            ->whereNotIn('id', $_visas_completees)
            ->count();

    @endphp
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="/dashboard">
                        {{-- <i class="si si-fire text-primary"></i> --}}
                        <span class="font-size-xl text-brand-secondary">METPS</span>
                        {{-- <span class="ml-1 font-size-xl text-brand-primary"></span> --}}
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                <img class="img-avatar img-avatar32"
                    src="{{ asset($avatar ? "/storage/$avatar" : 'media/avatars/avatar15.jpg') }}" alt="">
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="javascript:void(0)">
                    <img class="img-avatar"
                        src="{{ asset($avatar ? "/storage/$avatar" : 'media/avatars/avatar15.jpg') }}" alt="">
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase"
                            href="javascript:void(0)">{{ $name }}</a>
                    </li>
                    <li class="list-inline-item">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout"
                            data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" href="{{ url('/logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="si si-logout"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">Tableau de bord</span>
                    </a>
                </li>
                @if ($user->role !== 'admin' && $user->role !== 'super')
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">DEMANDES</span><span class="sidebar-mini-hidden">Gestion des
                            demandes</span>
                    </li>
                    @if ($user->role == 'agent')
                        <li>
                            <a class="{{ request()->is('demands/create') || request()->is('demands/create/*') ? ' active' : '' }}"
                                href="{{ route('demands.create') }}">
                                <i class="si si-plus"></i><span class="sidebar-mini-hide">Nouvelle demande</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="{{ request()->is('demands') ? ' active' : '' }}" href="{{ route('demands.index') }}">
                            <i class="si si-doc"></i><span class="sidebar-mini-hide">Demandes enregistrées
                                @if ($nbrAllDemandCompletes > 0)
                                    ({{ $nbrAllDemandCompletes }})
                                @endif
                                @if ($user->role == 'agent')
                                    @if ($_visas_a_completer > 0)
                                        <span class="badge badge-pill badge-primary">{{ $_visas_a_completer }}
                                        </span>
                                    @endif
                                @endif
                            </span>

                        </a>
                    </li>
                    @if (($service->id == $daep->id || $service->id == $dge->id || $service->id == $sg->id) &&
                        $user->role == 'directeur')
                        <li>
                            <a class="{{ request()->is('demands/pour/avis') ? ' active' : '' }}"
                                href="{{ route('demands.pour.avis') }}">
                                <i class="si si-doc"></i><span class="sidebar-mini-hide">En attentes pour avis</span>
                                @if ($nbrDemandPourAvis)
                                    <span class="badge badge-pill badge-danger cesw-pastille">{{ $nbrDemandPourAvis }}
                                    </span>
                                @endif
                            </a>
                        </li>
                        {{-- @else --}}
                    @endif

                    <li>
                        <a class="{{ request()->is('demands/en/traitement') ? ' active' : '' }}"
                            href="{{ route('demands.en.traitement') }}">
                            <i class="si si-doc"></i><span class="sidebar-mini-hide">Demandes en traitement
                                @if ($nbrAllDemandPourAvis > 0)
                                    ({{ $nbrAllDemandPourAvis }})
                                @endif
                            </span>
                        </a>
                    </li>
                    {{-- @endif --}}

                    @if ($service->id == $ministrere->id &&
                        ($user->role == 'general' || $user->role == 'directeur') &&
                        $nbrDemandPourDecision > 0)

                        <li>
                            <a class="{{ request()->is('demands/pour/decision') ? ' active' : '' }}"
                                href="{{ route('demands.pour.decision') }}">
                                <i class="si si-doc"></i>
                                <span class="sidebar-mini-hide">En attentes de décision</span>
                                @if ($nbrDemandPourDecision)
                                    <span
                                        class="badge badge-pill badge-danger cesw-pastille">{{ $nbrDemandPourDecision }}</span>
                                @endif
                            </a>
                        </li>
                    @endif
                    {{--  @if ($user->role == 'directeur' || $user->role == 'agent') --}}
                    @if ($nbrAllDemandRejetees > 0)
                        <li>
                            <a class="{{ request()->is('demands/states/rejected') ? ' active' : '' }}"
                                href="{{ route('demande.states.rejected') }}">
                                <i class="si si-close"></i><span class="sidebar-mini-hide">Demandes rejetées
                                    @if ($nbrAllDemandRejetees > 0)
                                        ({{ $nbrAllDemandRejetees }})
                                    @endif
                                </span>
                            </a>
                        </li>
                    @endif
                    @if ($nbrAllDemandGracieux > 0)
                        <li>
                            <a class="{{ request()->is('demands/states/recours') ? ' active' : '' }}"
                                href="{{ route('demande.states.recours') }}">
                                <i class="si si-doc"></i><span class="sidebar-mini-hide">En recours gracieux
                                    @if ($nbrAllDemandGracieux > 0)
                                        ({{ $nbrAllDemandGracieux }})
                                    @endif
                            </a>
                        </li>
                    @endif
                    {{--  @endif --}}
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">VISA</span><span class="sidebar-mini-hidden">Gestion
                            Visas</span>
                    </li>
                    <li>
                        <a class="{{ request()->is('work-visas') ? ' active' : '' }}"
                            href="{{ route('work-visas.index') }}">
                            <i class="si si-briefcase"></i><span class="sidebar-mini-hide">Visas enregistrés
                                @if ($nbrAllVisas >= 0)
                                    ({{ $nbrAllVisas }})
                                @endif
                        </a>
                    </li>
                    @if (!(in_array($user->role, ['directeur', 'secretaire', 'agent']) && $service->id == $sg->id))
                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible">STATS</span><span
                                class="sidebar-mini-hidden">Statistiques</span>
                        </li>
                        <li>
                            <a class="{{ request()->is('statistics/demands/branche/sexe') ? ' active' : '' }}"
                                href="{{ route('statistics.demands.branche.sexe') }}">
                                <i class="si si-users"></i><span class="sidebar-mini-hide">Demandes par branche et
                                    sexe</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('statistics/demands/domaine/sexe') ? ' active' : '' }}"
                                href="{{ route('statistics.demands.domaine.sexe') }}">
                                <i class="si si-users"></i><span class="sidebar-mini-hide">Demandes par domaine et
                                    sexe</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('statistics/visa/branche/sexe') ? ' active' : '' }}"
                                href="{{ route('statistics.visa.branche.sexe') }}">
                                <i class="si si-users"></i><span class="sidebar-mini-hide">Visas par branche et
                                    sexe</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('statistics/visa/branche/categorie/sexe') ? ' active' : '' }}"
                                href="{{ route('statistics.visa.branche.categorie.sexe') }}">
                                <i class="si si-users"></i><span class="sidebar-mini-hide">Visas par branche, catégorie et
                                    sexe</span>
                            </a>
                        </li>
                        @if (in_array($user->role, ['directeur']) && ($service->id == $daep->id || $service->id == $dge->id))
                            <li>
                                <a class="{{ request()->is('statistics/visa/suivi') ? ' active' : '' }}"
                                    href="{{ route('statistics.visa.suivi') }}">
                                    <i class="si si-users"></i><span class="sidebar-mini-hide">Tableau de suivi des
                                        visas</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endif
                @if (!in_array($user->role, ['observateur', 'general', 'directeur', 'secretaire', 'agent']) ||
                    ($daep->id === $userServiceId && $user->role === 'agent'))
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">CONFS</span><span
                            class="sidebar-mini-hidden">Configurations</span>
                    </li>
                    @if (!($daep->id === $userServiceId && $user->role === 'agent'))
                        @if (in_array($user->role, ['admin', 'super']))
                            <li>
                                <a class="{{ request()->is('users') || request()->is('users/*') ? ' active' : '' }}"
                                    href="{{ route('users.index') }}">
                                    <i class="si si-users"></i><span class="sidebar-mini-hide">Utilisateurs</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="{{ request()->is('localities') || request()->is('localities/*') ? ' active' : '' }}"
                                href="{{ route('localities.index') }}">
                                <i class="si si-globe"></i><span class="sidebar-mini-hide">Localités</span>
                            </a>
                        </li>
                        @if (in_array($user->role, ['admin', 'super']))
                            <li>
                                <a class="{{ request()->is('group-localities') || request()->is('group-localities/*') ? ' active' : '' }}"
                                    href="{{ route('group-localities.index') }}">
                                    <i class="si si-globe"></i><span class="sidebar-mini-hide">Groupes de
                                        localités</span>
                                </a>
                            </li>
                        @endif
                        <li>
                            <a class="{{ request()->is('activities') || request()->is('activities/*') ? ' active' : '' }}"
                                href="{{ route('activities.index') }}">
                                <i class="si si-drawer"></i><span class="sidebar-mini-hide">Branches
                                    d'activités</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('professional-categories') || request()->is('professional-categories/*') ? ' active' : '' }}"
                                href="{{ route('professional-categories.index') }}">
                                <i class="si si-drawer"></i><span class="sidebar-mini-hide">Catégories
                                    professionnelles</span>
                            </a>
                        </li>
                        <li>
                            <a class="{{ request()->is('qualification-areas') || request()->is('qualification-areas/*') ? ' active' : '' }}"
                                href="{{ route('qualification-areas.index') }}">
                                <i class="si si-drawer"></i><span class="sidebar-mini-hide">Domaines de
                                    qualifications</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a class="{{ request()->is('employers') || request()->is('employers/*') ? ' active' : '' }}"
                            href="{{ route('employers.index') }}">
                            <i class="si si-briefcase"></i><span class="sidebar-mini-hide">Employeurs</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
