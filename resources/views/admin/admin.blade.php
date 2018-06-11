<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Acisa Panaderias</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">
    <link href="/css/admin-menu.css" rel="stylesheet">
    @routes
    <script src="/js/app.js"></script>
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden   pace-done pace-done">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto"
                type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
        <!-- AQUí va el ICONO/logotipo de la empresa.
              pantalla grande ->izquierda 
              pantalla pequeña->centro header
          -->
        <!--<a class="navbar-brand" href="#"></a>-->
        <button class="navbar-toggler sidebar-toggler d-md-down-none"
                type="button">
            <span class="navbar-toggler-icon"></span>
          </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
                <a class="nav-link"
                    href="{{ route('admin.home') }}">Escritorio</a>
            </li>
            {{-- <li class="nav-item px-3">
                <a class="nav-link"
                   href="{{ route('config.index') }}">Configuraciones</a>
            </li> --}}
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   style="margin-right: 25px"
                   data-toggle="dropdown"
                   href="#"
                   role="button"
                   aria-haspopup="true"
                   aria-expanded="false"
                   v-pre>
                      <span class="d-md-down-none">admin </span>
                  </a>
                <div id="dropdown" class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    {{-- <a class="dropdown-item"
                       href="{{ route('admin.perfil') }}"><i class="fa fa-user"></i> Perfil</a> --}}
                    <form action="{{route('logout')}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class=" fa fa-lock"></i> Cerrar sesión
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </header>

    <div class="app-body">
        <!-- Barra lateral -->
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        Mantenimiento
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle"
                           href="#"><i class="icon-bag"></i> Almacén</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{route('categorias.index')}}"><i class="icon-bag"></i> Categorías</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{route('producto.index')}}"><i class="icon-bag"></i> Productos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle"
                           href="#"><i class="icon-basket"></i>Gestión pedidos</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('pedido.index') }}"><i class="icon-notebook"></i>Pedidos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-dropdown">
                        <a class="nav-link nav-dropdown-toggle"
                           href="#"><i class="icon-people"></i> Acceso</a>
                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('usuario.index') }}"><i class="icon-user"></i> Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="{{ route('rol.index') }}"><i class="icon-user-following"></i> Roles</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer"
                    type="button"></a>
        </div>

        @yield('main')
    </div>

    <footer class="app-footer">
        <span><a href="#">ACISA</a> © 2018</span>
    </footer>
    <script src="/js/admin-menu.js"></script>
</body>
</html>