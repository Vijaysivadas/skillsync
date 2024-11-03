<!DOCTYPE html>
<html lang="en-US" dir="ltr" data-navigation-type="default" data-navbar-horizontal-shape="default">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield("title", config('app.name'))</title>
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset("assets/template/vendors/simplebar/simplebar.min.js")}}"></script>
    <script src="{{asset("assets/template/js/config.js")}}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap"
          rel="stylesheet">
    <link href="{{asset('assets/template/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href="{{asset('assets/template/css/theme-rtl.min.css')}}" type="text/css" rel="stylesheet" id="style-rtl">
    <link href="{{asset('assets/template/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('assets/template/css/user-rtl.min.css')}}" type="text/css" rel="stylesheet" id="user-style-rtl">
    <link href="{{asset('assets/template/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script>
</head>
<body>
<main class="main" id="top">
{{--    @include("includes.sidebar")--}}
    @include("includes.header")
    <div class="content">
        @yield("content")
        @include("includes.footer")
    </div>
</main>
<script src="{{asset('assets/template/vendors/popper/popper.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/anchorjs/anchor.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/is/is.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/fontawesome/all.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/lodash/lodash.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/list.js/list.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/template/vendors/dayjs/dayjs.min.js')}}"></script>
<script src="{{asset('assets/template/js/phoenix.js')}}"></script>

</body>

</html>
