
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - Voler Admin Dashboard</title>
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/bootstrap.css')}}">
    
    <link rel="shortcut icon" href="{{asset('img/ise.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('voler/dist/assets/css/app.css')}}">
    <link href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
</head>

<body>
    <div id="auth">
        
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="{{asset('img/ise.png')}}" height="48" class='mb-4'>
                        <h3>Sign In</h3>
                        <p>Please sign in to continue to Apps.</p>
                    </div>
                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left">
                            <label for="username">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control" id="username">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <div class="clearfix">
                                <label for="password">Password</label>
                                {{-- <a href="auth-forgot-password.html" class='float-end'>
                                    <small>Forgot password?</small>
                                </a> --}}
                            </div>
                            <div class="position-relative">
                                <input type="password" class="form-control" id="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button class="btn btn-primary float-end"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                        </div>
                    </form>
                    <div class="divider">
                        <div class="divider-text">PERSONNEL</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    </div>
    <script src="{{asset('voler/dist/assets/js/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('voler/dist/assets/js/app.js')}}"></script>
    
    <script src="{{asset('voler/dist/assets/js/main.js')}}"></script>
</body>

</html>
