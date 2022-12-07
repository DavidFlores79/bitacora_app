<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light" style="background: #353535" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> --}}
        <button id="navbar-toggler" class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target=""
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets') }}/img/brand/logo.svg" class="navbar-brand-img" alt="...">
        </a>

        <!-- Modal -->
        <div class="menuModal modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-center p-3 text-secondary">
                    <div class="modal-body">
                        <!--Menu-->
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('home') }}">
                                    <i class="ni ni-tv-2 text-primary"></i> Inicio
                                </a>
                            </li>

                            @foreach ($modulosConCategorias as $key => $modulos)
                                <li class="nav-item ">
                                    <a class="nav-link text-dark" href="#navbar-examples" data-toggle="collapse"
                                        role="button" aria-expanded="false" aria-controls="navbar-examples">
                                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                                        <span class="nav-link-text">{{ $key }}</span>
                                    </a>
                                    <div class="collapse" id="navbar-examples">
                                        <ul class="nav nav-sm flex-column">
                                            @foreach ($modulos as $key => $modulo)
                                                <li class="nav-item ml-3">
                                                    <a class="nav-link text-dark"
                                                        href="{{ route($modulo['ruta'], ['id' => Crypt::encrypt($modulo['id'])]) }}">
                                                        {{ $modulo['nombre'] }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        <!-- User mobile -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('assets') }}/img/brand/user.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">¡Bienvenido!</h6>
                        <div class="mb-0 text-sm">{{ auth()->user()->miPerfil->nombre }}</div>
                        <div class="mb-0 text-sm text-dark font-weight-bold">{{ auth()->user()->name }}</div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>Salir</span>
                    </a>
                </div>
            </li>
        </ul>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">

            <!-- Navigation -->
            <ul class="navbar-nav mt-5">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('home') }}">
                    <i class="fas fa-home text-primary"></i> Inicio
                    </a>
                </li>


                @foreach ($modulosConCategorias as $key => $modulos)
                    <li class="nav-item ">
                        <a class="nav-link text-white" href="#navbar-examples{{ $loop->index }}" data-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="navbar-examples{{ $loop->index }}">
                            <i class="fas fa-stream" style="color: #f4645f;"></i>
                            <span class="nav-link-text">{{ $key }}</span>
                        </a>

                        <div class="collapse" id="navbar-examples{{ $loop->index }}">
                            <ul class="nav nav-sm flex-column">
                                @foreach ($modulos as $key => $modulo)
                                    <li class="nav-item">
                                        <a class="nav-link text-white"
                                            href="{{ route($modulo['ruta'], ['id' => Crypt::encrypt($modulo['id'])]) }}">
                                            {{ $modulo['nombre'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endforeach

                {{-- <li class="nav-item ">
                    <a class="nav-link text-white" href="#navbar-examples" data-toggle="collapse"
                        role="button" aria-expanded="false" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text">Tickets</span>
                    </a>

                    <div class="collapse" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a class="nav-link text-white" href="{{ route('profile.edit') }}">
                                    {{ __('Asignados') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route('user.index') }}">
                                    {{ __('En espera') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('proyectos') }}">
                        <i class="ni ni-pin-3 text-primary"></i> Proyectos
                    </a>
                </li> --}}
            </ul>
            {{-- <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted">Documentation</h6>
            <!-- Navigation --> --}}

        </div>
    </div>
</nav>
