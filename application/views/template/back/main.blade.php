<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{$title}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{base_url('assets/images/teladan.png')}}">
    <link rel="stylesheet" href="{{base_url('assets/plugins/highlightjs/styles/darkula.css')}}">
    <link rel="stylesheet" href="{{base_url('assets/css/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{base_url('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{base_url('assets/css/style.css')}}?v=rt6">
    @yield('scripts-css')
</head>
<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{base_url()}}">
                    <b class="logo-abbr"><img src="{{base_url('assets/images/teladan.png')}}" alt="" width="70px"> </b>
                    <span class="logo-compact"><img src="{{base_url('assets/images/teladan.png')}}" alt="" width="70px"></span>
                    <span class="brand-title">
                        <img src="{{base_url('assets/images/teladan.png')}}" alt="" width="70px">
                    </span>
                </a>
            </div>
        </div>
        <div class="header">    
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"></span>
                        </div>
                    </div>
                </div>
                <div class="header-right">
                    <li class="icons dropdown">
                        <div class="user-img c-pointer position-relative" data-toggle="dropdown" aria-expanded="false">
                            <span class="activity active"></span>
                            <img src="{{base_url('assets/images/user.jpg')}}" height="40" width="40" alt="">
                        </div>
                        <div class="drop-down dropdown-profile animated fadeIn dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(5px, 57px, 0px);">
                            <div class="dropdown-content-body">
                                <ul>
                                    <li>
                                        <i class="icon-user"></i> <span>&emsp;{{$this->session->userdata['nama_user']}}</span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </div>
        <div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                @if(isset($role) && $role == 1)
                    @include('template/menu/main2')
                @elseif(isset($role) && $role == 2)
                    @include('template/menu/main3')
                @elseif(isset($role) && $role == 3)
                    @include('template/menu/main4')
                @elseif(isset($role) && $role == 4)
                    @include('template/menu/main5')
                @else
                    @include('template/menu/main')
                @endif
                </ul>
            </div>
        </div>
        <div class="content-body">
            @yield('content')
        </div>
        <div class="footer">
            <div class="copyright d-inline-flex">
                <p>Copyright &copy; 2020 - <b>PT Sinai Teknologi Abadi</b> - Template Designed by <a href="https://themeforest.net/user/quixlab">Quixlab</a></p>
            </div>
        </div>
    </div>
    <script src="{{base_url('assets/js/jquery.min.js')}}"></script>
    <script src="{{base_url('assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{base_url('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{base_url('assets/js/custom.min.js')}}"></script>
    <script src="{{base_url('assets/js/settings.js')}}"></script>
    <script src="{{base_url('assets/js/styleSwitcher.js')}}"></script>
    <script src="{{base_url('assets/plugins/highlightjs/highlight.pack.min.js')}}"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <script>
        (function($) {
        "use strict"
            new quixSettings({
                version: "light", //2 options "light" and "dark"
                layout: "vertical", //2 options, "vertical" and "horizontal"
                navheaderBg: "color_7", //have 10 options, "color_1" to "color_10"
                headerBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarStyle: "vertical", //defines how sidebar should look like, options are: "full", "compact", "mini" and "overlay". If layout is "horizontal", sidebarStyle won't take "overlay" argument anymore, this will turn into "full" automatically!
                sidebarBg: "color_1", //have 10 options, "color_1" to "color_10"
                sidebarPosition: "static", //have two options, "static" and "fixed"
                headerPosition: "static", //have two options, "static" and "fixed"
                containerLayout: "wide",  //"boxed" and  "wide". If layout "vertical" and containerLayout "boxed", sidebarStyle will automatically turn into "overlay".
                direction: "ltr" //"ltr" = Left to Right; "rtl" = Right to Left
            });
        })(jQuery);
    </script>
    @yield('scripts-js')
</body>
</html>