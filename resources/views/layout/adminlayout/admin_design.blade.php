<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Gestion La Mora">
    <meta name="author" content="jean newman">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="vendors/img/favicon.png">

    <title>Sistema Ventas - IncanatoIT</title>
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('css/mora.css') }}" />


</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">

    <div id='app'>

            @include('layout.adminLayout.admin_header')

            <div class="app-body">
            @include('layout.adminLayout.admin_sidebar')
        </div>
            @yield('content')

            @include('layout.adminLayout.admin_footer')

  </div>


    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ asset('js/mora.js') }}"></script>


</body>

</html>
