<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- LINK SCRIPT DE JAVASCRIP Y CSS(BOOTSTRAP) --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <title>MakeItSimple</title>
</head>

<body>
    {{-- Incorporacion de la nav-bar --}}
    @include('dashboard/partials/nav-bar')

    <div class="container">

        {{-- Status de accion --}}
        @include('dashboard/partials/session-flash-status')

        {{-- Despligue de nuestra area para formularios y tabla --}}
        @yield('name')

    </div>

</body>

</html>
