
<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{$title}}</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{base_url('assets/images/teladan.png')}}">
    <link href="{{base_url('assets/css/style.css')}}" rel="stylesheet">
    
</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <h4 class="text-center">{{strtoupper($title)}}</h4>
                                <a class="text-center" href="{{base_url()}}"><h4>{{strtoupper("UKS Sekolah Teladan Yogyakarta")}}</h4></a>
                                @if($hasil == 0)
                                    <br>
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        </button> <strong>Username atau password salah!</strong> You should check in on some of those fields below.
                                    </div>
                                @endif
                                <form action="" method="POST" >
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="username" class="form-control" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <input type="submit" class="btn login-form__btn submit w-100">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{base_url('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{base_url('assets/js/custom.min.js')}}"></script>
    <script src="{{base_url('assets/js/settings.js')}}"></script>
    <script src="{{base_url('assets/js/gleek.js')}}"></script>
    <script src="{{base_url('assets/js/styleSwitcher.js')}}"></script>
</body>
</html>





