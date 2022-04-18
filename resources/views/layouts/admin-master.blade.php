<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') - {{env("APP_NAME")}}</title>
    <link rel="icon" type="image/png" href="{{ static_asset('frontend/images/fav.png') }}">

    @include('inc.styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                
                @include('inc.topnav')

            </nav>
            <div class="main-sidebar">
                
                @include('inc.navbar')

            </div>

            
            <div class="main-content">
                
                @yield('content')
            </div>
            @include('inc.footer')

        </div>
    </div>

    
    
    @include('inc.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.3.1/highlight.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @yield('scripts')
</body>

</html>