<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @if(isset($seo->title))
    <title>{{ $seo->title }}</title>
    @else
    <title>{{ setting('site.title', 'Laravel Wave') . ' - ' . setting('site.description', 'The Software as a Service
        Starter Kit built on Laravel & Voyager') }}</title>
    @endif

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge"> <!-- † -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url" content="{{ url('/') }}">

    <link rel="icon" href="{{ setting('site.favicon', '/wave/favicon.png') }}" type="image/x-icon">

    {{-- Social Share Open Graph Meta Tags --}}
    @if(isset($seo->title) && isset($seo->description) && isset($seo->image))
    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:image" content="{{ $seo->image }}">
    <meta property="og:type" content="@if(isset($seo->type)){{ $seo->type }}@else{{ 'article' }}@endif">
    <meta property="og:description" content="{{ $seo->description }}">
    <meta property="og:site_name" content="{{ setting('site.title') }}">

    <meta itemprop="name" content="{{ $seo->title }}">
    <meta itemprop="description" content="{{ $seo->description }}">
    <meta itemprop="image" content="{{ $seo->image }}">

    @if(isset($seo->image_w) && isset($seo->image_h))
    <meta property="og:image:width" content="{{ $seo->image_w }}">
    <meta property="og:image:height" content="{{ $seo->image_h }}">
    @endif
    @endif

    <meta name="robots" content="index,follow">
    <meta name="googlebot" content="index,follow">

    @if(isset($seo->description))
    <meta name="description" content="{{ $seo->description }}">
    @endif

    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    {{--
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <!-- jQuery Modal -->
    <link href="{{ asset('themes/' . $theme->folder . '/css/jquery.modal.min.css')}}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('themes/' . $theme->folder . '/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/' . $theme->folder . '/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('themes/' . $theme->folder . '/css/magnifier.css') }}" rel="stylesheet">
</head>

<body
    class="flex flex-col min-h-screen @if(Request::is('/')){{ 'bg-white' }}@else{{ 'bg-gray-50' }}@endif @if(config('wave.dev_bar')){{ 'pb-10' }}@endif">
    <div class="_token" data-token="{{ csrf_token() }}"></div>
    <div class='containerr' style="display: none">
        <div class='loader'>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--dot'></div>
            <div class='loader--text'></div>
        </div>
    </div>

    @if(config('wave.demo') && Request::is('/'))
    @include('theme::partials.demo-header')
    @endif

    @include('theme::partials.header')

    <main class="flex-grow overflow-x-hidden">
        @yield('content')
    </main>



    @include('theme::partials.footer')

    @if(config('wave.dev_bar'))
    @include('theme::partials.dev_bar')
    @endif

    <!-- Full Screen Loader -->
    <div id="fullscreenLoader"
        class="fixed inset-0 top-0 left-0 z-50 flex flex-col items-center justify-center hidden w-full h-full bg-gray-900 opacity-50">
        <svg class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
            </path>
        </svg>
        <p id="fullscreenLoaderMessage" class="mt-4 text-sm font-medium text-white uppercase"></p>
    </div>
    <!-- End Full Loader -->


    @include('theme::partials.toast')
    @if(session('message'))
    <script>
        setTimeout(function(){ popToast("{{ session('message_type') }}", "{{ session('message') }}"); }, 10);
    </script>
    @endif
    @waveCheckout

</body>

</html>