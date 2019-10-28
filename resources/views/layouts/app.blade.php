<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BBS') - {{ setting('site_name', '五花肉') }}</title>
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', '红烧五花肉，个人博客'))" />
    <meta name="description" content="@yield('description', setting('seo_description', '个人博客，记录成长。'))" />
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?e4e1345d1af0c7446d8f36b59cc9fecb";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app" class="{{ routeClass() }}-page">

        @include('layouts._header')

        <div class="container">

            @include('shared._messages')

            @yield('content')

        </div>

        @include('layouts._footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
