<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js' ></script>
</head>
<body>
    <div id="app">
            @include('inc.navbar')
            <div class="container">
                @include('inc.msgs')
                @yield('content')
            </div>
    </div>
    @if(env('GOOGLE_RECAPTCHA_KEY', '6LcQxrEUAAAAAME9IFGIfH43pav0feNzMbbh34Jc'))
    <div id="recaptcha" class="g-recaptcha"
        data-sitekey="{{'6LcQxrEUAAAAAME9IFGIfH43pav0feNzMbbh34Jc'}}">
    </div>
    @elseif(true)
        <h5>{{env('GOOGLE_RECAPTCHA_KEY', '6LcQxrEUAAAAAME9IFGIfH43pav0feNzMbbh34Jc')}}</h5>
@endif
    <script>
        var dangerMsg = document.getElementsByClassName('alert-danger');
        if(dangerMsg.length > 0) {
            setTimeout(fade, 2000, 'alert-danger');
        }
        function fade(className) {
            var elements = document.getElementsByClassName(className);
            var opacityValue = 1;
            var fadingInterval = setInterval(function(){
                opacityValue -= 0.1;
                if(opacityValue < -5) {
                    clearInterval(fadingInterval);
                }
                for(var i = 0; i < elements.length; i++) {
                    elements[i].style.opacity = opacityValue;
                    if(opacityValue < 0) {
                        elements[i].parentNode.removeChild(elements[i]);
                    }
                }
            }, 50);
        }
    </script>
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>

</body>
</html>
