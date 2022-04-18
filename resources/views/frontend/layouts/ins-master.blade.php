<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=9">
    {!! SEO::generate() !!}

    <title>{{env("APP_NAME")}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#ed2a26">
    <link rel="manifest" href="{{ asset('manifest.json')}}">

    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="{{env("APP_NAME")}}">
    <link rel="icon" sizes="512x512" href="{{ static_asset('frontend/images/fav.png') }}">
    
    <link rel="icon" type="image/png" href="{{ static_asset('frontend/images/fav.png') }}">
    <link rel="icon" sizes="192x192" href="{{ static_asset('frontend/images/fav.png') }}">
    @include('frontend.inc.styles')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-78QJR1848J"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-78QJR1848J');
</script>
    
</head>

<body>
    
    @if(Auth::guard('author')->check())
    @include('frontend.inc.ins-topnav')
    @else
    @php
    $categorys = \App\Models\Category::whereStatus(1)->orderBy('name','asc')->get();
    @endphp
    @include('frontend.inc.stu-topnav')
    @endif
    
    @if(Auth::guard('author')->check())
    @include('frontend.inc.ins-navbar')
    @else
    @include('frontend.inc.stu-navbar')
    @endif
    
    <div class="wrapper" >
        <div class="sa4d25">
            @yield('content')
        </div>
        
        @include('frontend.inc.ins-footer')
    </div>

    @include('frontend.inc.scripts')

    @yield('scripts')
    
    <x-snackbar />

</body>

</html>