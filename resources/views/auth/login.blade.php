<!doctype html>
<html lang="en" dir="ltr">

<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico" />

    <!-- TITLE -->
    <title>Login</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/dark-style.css" rel="stylesheet" />
    <link href="../assets/css/transparent-style.css" rel="stylesheet">
    <link href="../assets/css/skin-modes.css" rel="stylesheet" />

    <!-- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="../assets/colors/color1.css" />
</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOBAL LOADER -->
        <div id="global-loader">
            <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOBAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">

                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <a href="index.html"><img src="../assets/images/brand/logo-white.png" class="header-brand-img"
                                alt=""></a>
                    </div>
                </div>

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                        <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                            @csrf
                            <span class="login100-form-title pb-5">
                                Login
                            </span>
                            <div class="panel panel-primary">
                                <div class="panel-body">
                                    <!-- Email Login -->
                                    <div class="wrap-input100 validate-input input-group"
                                        data-bs-validate="Valid email is required: ex@abc.xyz">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 border-start-0 form-control ms-0" type="email"
                                            name="email" value="{{ old('email') }}" placeholder="Email" required
                                            autofocus autocomplete="username">
                                    </div>
                                    @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror

                                    <!-- Password -->
                                    <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                        <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                            <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                        </a>
                                        <input class="input100 border-start-0 form-control ms-0" type="password"
                                            name="password" placeholder="Password" required
                                            autocomplete="current-password">
                                    </div>
                                    @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror

                                    <!-- Forgot Password -->
                                    <div class="text-end pt-4">
                                        <p class="mb-0"><a href="{{ route('password.request') }}"
                                                class="text-primary ms-1">Forgot Password?</a></p>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="container-login100-form-btn">
                                        <button type="submit" class="login100-form-btn btn-primary">
                                            Log In
                                        </button>
                                    </div>

                                    <!-- Sign Up -->
                                    <div class="text-center pt-3">
                                        <p class="text-dark mb-0">Not a member?<a href="{{ route('register') }}"
                                                class="text-primary ms-1">Sign Up</a>
                                        </p>
                                    </div>

                                    <!-- Social Login -->
                                    <label class="login-social-icon"><span>Login with Social</span></label>
                                    <div class="d-flex justify-content-center">
                                        <a href="javascript:void(0)">
                                            <div class="social-login me-4 text-center">
                                                <i class="fa fa-google"></i>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <div class="social-login me-4 text-center">
                                                <i class="fa fa-facebook"></i>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)">
                                            <div class="social-login text-center">
                                                <i class="fa fa-twitter"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="../assets/js/show-password.min.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

</body>

</html>
