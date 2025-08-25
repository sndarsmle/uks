<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{$title}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{base_url('assets/images/teladan.png')}}">
    <link rel="stylesheet" href="{{base_url('assets/plugins/highlightjs/styles/darkula.css')}}">
    <link href="{{base_url('assets/css/select2-bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{base_url('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{base_url('assets/css/style.css')}}?v=rt6" rel="stylesheet">
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
        <div class="header" style="height: 12rem; ">    
            <div class="header-content clearfix">
                <div class="header-center">
                    <div class="input-group icons">
                        <span class="logo-compact col-lg-12">
                        <center>
                            <img src="{{base_url('assets/images/logo_besar.png')}}" alt="" width="220px" style="margin-top:20px;">
                        </center>
                        </span>
                    </div>
                </div>
                <div class="header-right">

                </div>
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
                layout: "horizontal", //2 options, "vertical" and "horizontal"
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