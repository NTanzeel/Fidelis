<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        @push('fonts')
            <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        @endpush
        @stack('fonts')

        <!-- Styles -->
        @push('stylesheets')
            <link href="{{ asset('assets/css/frameworks/bootstrap/3.3.7.min.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/css/global/app.css') }}" rel="stylesheet">
            <link href="{{ asset('assets/css/layouts/default/app.css') }}" rel="stylesheet">
        @endpush
        @stack('stylesheets')

        <!-- Scripts -->
        <script>
            {!! 'window.Laravel = ' . json_encode(['csrfToken' => csrf_token()])  !!}
        </script>
    </head>
    <body>
        <div id="app">
            @section('header')
                @include('layouts.default.partials.header')
            @show

            @section('container')
                <div class="container-fluid">
                    <div class="row">
                        <div lang="col-sm-12">
                            @yield('content')
                        </div>
                    </div>
                </div>
            @show

            @section('footer')
            @show
        </div>

        <!-- Scripts -->
        @push('scripts')
            <script src="{{ asset('assets/js/frameworks/jquery/3.1.1.min.js') }}"></script>
            <script src="{{ asset('assets/js/frameworks/bootstrap/3.3.7.min.js') }}"></script>
        @endpush
        @stack('scripts')
    </body>
</html>