<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> -->

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    @include('layouts.navigation')

    <!-- @isset($header)
        <header class="bg-white border-bottom shadow-sm mb-4">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.sidebar') {{-- Sidebar goes here --}}
            </div>
            <div class="col-md-9">
    <main class="mt-4 d-flex justify-content-center">
        <div class="w-100" style="max-width: 1000px; padding: 0 1rem;">
            {{ $slot }}
        </div>
    </main>
</div>


        </div>
    </div>
</body>

</html>