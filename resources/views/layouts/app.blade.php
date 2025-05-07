<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
    <main class="mt-4"> {{-- Added top margin --}}
        {{ $slot }}
    </main>
</div>

        </div>
    </div>
</body>

</html>
