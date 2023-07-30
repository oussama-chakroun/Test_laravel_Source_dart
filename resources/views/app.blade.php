<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    {{-- bootstrap cdn and fonts for same styles --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

    {{-- custom style for using a asidrebar --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    {{-- custom script for using same evnets like hide/show sidebar --}}
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    {{-- cdn for jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    {{-- source of sidebar  --->>>  https://bbbootstrap.com/snippets/bootstrap-5-sidebar-menu-toggle-button-34132202  --}}

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body id="body-pd" class="body-pd">
    {{-- including navigation sidebar from layout/sidebar --}}
    @include('layout/sidebar')

    <!--Container Main start-->
    <div class="height-100 bg-light">
        @yield('content')
    </div>
    <!--Container Main end-->
</body>
{{-- <body>
    <div class="container">
       
    </div>
</body> --}}

</html>
