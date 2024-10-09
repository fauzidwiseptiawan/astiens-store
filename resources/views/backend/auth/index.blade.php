<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Log In | Attex - Bootstrap 5 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('template/backend') }}/images/favicon.ico">
    <!-- Theme Config Js -->
    <script src="{{ asset('template/backend') }}/js/config.js"></script>
    <!-- Plugin css -->
    <link rel="stylesheet" href="{{ asset('template/backend') }}/vendor/jquery-toast-plugin/jquery.toast.min.css">
    <!-- App css -->
    <link href="{{ asset('template/backend') }}/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <!-- Icons css -->
    <link href="{{ asset('template/backend') }}/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">
                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="index.html" class="logo-dark">
                        <span><img src="{{ asset('template/backend') }}/images/logo-dark.png" alt="dark logo"
                                height="22"></span>
                    </a>
                    <a href="index.html" class="logo-light">
                        <span><img src="{{ asset('template/backend') }}/images/logo.png" alt="logo"
                                height="22"></span>
                    </a>
                </div>
                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your email address and password to access account.</p>
                    <!-- form -->
                    <form class="login" action="{{ route('auth') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="email" name="email"
                                placeholder="Enter your email">
                            <div id="errorEmail"class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password" name="password"
                                placeholder="Enter your password">
                            <div id="errorPassword" class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="signin">
                                <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                <a href="auth-recoverpw.html" class="text-muted float-end fs-12 mt-0">Forgot your
                                    password?</a>
                            </div>
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit" id="login"><i
                                    class="ri-login-box-line"></i> Log In
                            </button>
                        </div>
                    </form>
                    <!-- end form-->
                </div>
            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <h2 class="mb-3">I love the color!</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> Everything you need is in this
                                template. Love the overall look and feel. Not too flashy, and still very professional
                                and smart.
                            </p>
                            <p>
                                - Admin User
                            </p>
                        </div>
                        <div class="carousel-item">
                            <h2 class="mb-3">Flexibility !</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> Pretty nice theme, hoping you guys
                                could add more features to this. Keep up the good work.
                            </p>
                            <p>
                                - Admin User
                            </p>
                        </div>
                        <div class="carousel-item">
                            <h2 class="mb-3">Feature Availability!</h2>
                            <p class="lead"><i class="ri-double-quotes-l"></i> This is a great product, helped us a
                                lot and very quick to work with and implement.
                            </p>
                            <p>
                                - Admin User
                            </p>
                        </div>
                    </div>
                </div>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="{{ asset('template/backend') }}/js/vendor.min.js"></script>
    <script src="{{ asset('template/backend') }}/vendor/jquery-toast-plugin/jquery.toast.min.js"></script>
    <!-- App js -->
    <script src="{{ asset('template/backend') }}/js/app.min.js"></script>
    <script>
        // function pageRedirect
        function pageRedirect() {
            window.location = "{{ route('dashboard') }}";
        }

        // function validate email
        function validateEmail(string) {
            var regex = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var result = string.replace(/\s/g, "").split(/,|;/);

            for (var i = 0; i < result.length; i++) {
                if (!regex.test(result[i])) {
                    return false;
                }
            }
            return true;
        }

        // remove alert email
        $(document).on("input", "#email", function(e) {
            if ($('#email').val() !== null) {
                $('#email').removeClass('is-invalid');
                $('#errorEmail').html('');
            }
        })

        // remove alert password
        $(document).on("input", "#password", function(e) {
            if ($('#password').val() !== null) {
                $('#password').removeClass('is-invalid');
                $('#errorPassword').html('');
            }
        })

        $(document).on("click", "#login", function(e) {
            e.preventDefault();

            var email = $('#email').val();
            var password = $('#password').val();

            var fd = new FormData();
            fd.append("email", email);
            fd.append("password", password);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: $('.login').attr('action'),
                method: $('.login').attr('method'),
                dataType: 'JSON',
                processData: false,
                contentType: false,
                data: fd,
                beforeSend: function() {
                    $('#login').attr('disabled', 'disabled');
                    $('#login').html('<i class="ri-loader-4-line"></i>');
                },
                complete: function() {
                    $('#login').removeAttr('disabled');
                    $('#login').html('<i class="ri-login-box-line"></i> Log in');
                },
                success: function(response) {
                    if (!validateEmail(email)) {
                        $('#password').val('');
                        $.toast({
                            text: 'Email format must match!',
                            icon: 'error',
                            showHideTransition: 'plain',
                            hideAfter: 1500,
                            position: 'top-right'
                        });
                    } else {
                        if (response.status == 400) {
                            $('#password').val('');
                            if (response.message.email) {
                                $('#email').addClass('is-invalid');
                                $('#errorEmail').html(response.message.email);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('');
                                $('#errorEmail').html('');
                            }
                            if (response.message.password) {
                                $('#password').addClass('is-invalid');
                                $('#errorPassword').html(response.message.password);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#password').addClass('');
                                $('#errorPassword').html('');
                            }
                        } else if (response.status == 401) {
                            $('#password').val('');
                            $.toast({
                                text: response.message,
                                icon: 'error',
                                showHideTransition: 'plain',
                                hideAfter: 1500,
                                position: 'top-right'
                            });
                        } else {
                            if (response.status == 200) {
                                $.toast({
                                    text: response.message,
                                    icon: 'success',
                                    showHideTransition: 'plain',
                                    hideAfter: 1500,
                                    position: 'top-right',
                                    afterHidden: function() {
                                        setTimeout('pageRedirect()', 0);
                                    }
                                });
                            }
                        }
                    }
                }
            })
        })
    </script>

</body>

</html>
