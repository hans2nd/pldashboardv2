<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pangan Lestari Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/template1') }}/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/template1') }}/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                "families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['{{ asset('assets/template1') }}/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <style>
        .bg-login-image {
            background-image: url('{{ asset('assets/template1') }}/img/images2.jpg');
            /* ganti sesuai lokasi gambarmu */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        /* efek overlay gelap supaya teks tetap jelas */
        .bg-login-image::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            /* ubah transparansi sesuai kebutuhan */
        }

        /* pastikan teks tetap di atas overlay */
        .bg-login-image>* {
            position: relative;
            z-index: 2;
        }
    </style>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/template1') }}/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/template1') }}/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/template1') }}/css/kaiadmin.min.css" />
</head>

<body class="login bg-primary">
    <div class="wrapper wrapper-login wrapper-login-full p-0">
        <div
            class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center bg-login-image">
            <h1 class="title fw-bold text-white mb-3">Pangan Lestari</h1>
            <p class="subtitle text-white op-7">Inovation and Collaboration</p>
        </div>
        <div class="login-aside w-50 d-flex align-items-center justify-content-center bg-white">
            <div class="container container-login container-transparent animated fadeIn">
                <h3 class="text-center">Sign In To Dashboard</h3>
                <div class="login-form">
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username"><b>Username</b></label>
                            <input id="username" name="username" type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Password</b></label>
                            {{-- <a href="#" class="link float-end">Forget Password ?</a> --}}
                            <div class="position-relative">
                                <input id="password" name="password" type="password" class="form-control" required>
                                <div class="show-password">
                                    <i class="icon-eye"></i>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-action-d-flex mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberme">
                                <label class="custom-control-label m-0" for="rememberme">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary ms-auto">Sign In</button>
                        </div>
                    </form>
                    {{-- <div class="login-account">
                        <span class="msg">Don't have an account yet ?</span>
                        <a href="#" id="show-signup" class="link">Sign Up</a>
                    </div> --}}
                </div>
            </div>

            {{-- <div class="container container-signup container-transparent animated fadeIn">
                <h3 class="text-center">Sign Up</h3>
                <div class="login-form">
                    <div class="form-group">
                        <label for="fullname"><b>Fullname</b></label>
                        <input id="fullname" name="fullname" type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><b>Email</b></label>
                        <input id="email" name="email" type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordsignin"><b>Password</b></label>
                        <div class="position-relative">
                            <input id="passwordsignin" name="passwordsignin" type="password" class="form-control"
                                required>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword"><b>Confirm Password</b></label>
                        <div class="position-relative">
                            <input id="confirmpassword" name="confirmpassword" type="password" class="form-control"
                                required>
                            <div class="show-password">
                                <i class="icon-eye"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row form-sub m-0">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="agree" id="agree">
                            <label class="form-check-label" for="agree">I Agree the terms and conditions.</label>
                        </div>
                    </div>
                    <div class="row form-action">
                        <div class="col-md-6">
                            <a href="#" id="show-signin" class="btn btn-danger btn-link w-100 fw-bold">Cancel</a>
                        </div>
                        <div class="col-md-6">
                            <a href="#" class="btn btn-secondary w-100 fw-bold">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
    <script src="{{ asset('assets/template1') }}/js/core/jquery-3.7.1.min.js"></script>

    <script src="{{ asset('assets/template1') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets/template1') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('assets/template1') }}/js/kaiadmin.min.js"></script>
    @include('components.alert')
</body>

</html>
