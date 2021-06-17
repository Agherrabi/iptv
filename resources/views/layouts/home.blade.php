<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Iptv</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('css/dataTables.min.css')}}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            .search-sec{
                background: #1A4668;padding: 2rem;
            }
            .search-slt{
                display: block;
                width: 100%;
                font-size: 0.875rem;
                line-height: 1.5;
                color: #55595c;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                height: calc(3rem + 2px) !important;
                border-radius:0;
            }
            .wrn-btn{
                width: 100%;
                font-size: 16px;
                font-weight: 400;
                text-transform: capitalize;
                height: calc(3rem + 2px) !important;
                border-radius:0;
            }
            .dataTable-top {
            padding: 0 0 1rem !important;
                }
                    .dataTable-table {
                    border-collapse: collapse !important;
                }
                .dataTable-wrapper .dataTable-container {
                    font-size: 0.865rem;
                }

                tbody, td, tfoot, th, thead, tr {
                    /* border-color: inherit; */
                    border-style: solid;
                    border-color: rgba(0, 0, 0, 0.125);
                    border-width: 0;

                }
                .dataTables_wrapper .dataTables_filter {
                    float: right;
                    text-align: right;
                    margin-bottom: 10px;
                }
                .table > :not(:last-child) > :last-child > *, .dataTable-table > :not(:last-child) > :last-child > * {
                    border-bottom-color: currentColor;
                    border-bottom: none;
                }
        </style>
        @yield('header')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="home">Smart Iptv</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">

            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">

                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @if(!Auth::guest())
                        @else
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url('/home') }}">Home</a></li>
                                <li><a href="{{ url('/league') }}">League</a></li>
                            </ul>
                        @endif

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="home">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Client
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('client')}}">Afficher</a>
                                    <a class="nav-link" href="{{url('client/create')}}">Ajouter</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Fournisseur
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsefour" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('fournisseur')}}">Afficher</a>
                                    <a class="nav-link" href="{{url('fournisseur/create')}}">Ajouter</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsepanel" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Panel
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsepanel" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('panel')}}">Afficher</a>
                                    <a class="nav-link" href="{{url('panel/create')}}">Ajouter</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsepck" aria-expanded="false" aria-controls="collapsepck">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                Abonnements
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsepck" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('pack')}}">Afficher</a>
                                    <a class="nav-link" href="{{url('pack/create')}}">Ajouter</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="{{route('reste15j')}}" >
                                <div class="sb-nav-link-icon"><i class="fas fa-hourglass-end"></i></div>
                                15 Jours Restants
                            </a>
                            @if(Auth::user()->is_admin==1)
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsuser" aria-expanded="false" aria-controls="collapsepck">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
                                Users
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsuser" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{url('user')}}">Afficher</a>
                                    <a class="nav-link" href="{{url('userajouter')}}">Ajouter</a>
                                </nav>
                            </div>
                            @endif


                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                      {{--
                     <div class="small">Connecté en tant que:</div>
                        iptv admin
                    </div> --}}
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">

                        <div class="card mb-4">
                            @yield('content')
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Smart Iptv 2021 &copy; By Unvers hight tech</div>

                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.js"integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('js/scripts.js')}}"></script>
        <script src="{{asset('js/dataTables.min.js')}}"></script>
        @yield('script')

    </body>
</html>
