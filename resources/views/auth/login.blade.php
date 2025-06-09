<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in Form</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Vanta.js & Three.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r121/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
</head>

<body>
    <div id="vanta-bg"></div>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="forms-wrap">
                    <form action="{{ route('login.attempt') }}" method="POST" autocomplete="off" class="sign-in-form">
                        @csrf
                        <div class="logo">
                            <img src="{{ asset('img/logo.png') }}" alt="easyclass" />
                            <h4>MyUMKM</h4>
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger"
                                style="font-size:0.95rem; border-radius:0.5rem; margin-bottom:1rem;">
                                <ul class="mb-0" style="padding-left:1.2rem;">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div id="auth-alert" data-type="success" data-message="{{ session('success') }}"
                                style="display:none;"></div>
                        @endif
                        @if (session('error'))
                            <div id="auth-alert" data-type="error" data-message="{{ session('error') }}"
                                style="display:none;"></div>
                        @endif
                        @if (session('info'))
                            <div id="auth-alert" data-type="info" data-message="{{ session('info') }}" style="display:none;"></div>
                        @endif

                        <div class="actual-form">
                            <div class="input-wrap">
                                <div class="label-with-icon">
                                    <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                    <label>Email</label>
                                </div>
                                <input type="email" name="email" class="input-field" autocomplete="off" required />
                            </div>

                            <div class="input-wrap" style="position:relative;">
                                <div class="label-with-icon">
                                    <span class="input-icon"><i class="fas fa-lock"></i></span>
                                    <label>Password</label>
                                </div>
                                <input type="password" name="password" class="input-field" id="login-password"
                                    autocomplete="off" required />
                                <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fas fa-eye"
                                        id="togglePasswordIcon"></i></span>
                            </div>

                            <input type="submit" value="Sign In" class="sign-btn" />

                            <div class="Or-Sign-Up-Using">
                                <span class="or-text">Owner Sign In Using</span>
                                <div class="login-social-icons">
                                    <a href="{{ route('google.login') }}" class="social-icon google"><img
                                            src="{{ asset('img/social/google.svg') }}" alt="Google" /></a>
                                    <a href="#" class="social-icon facebook"><img
                                            src="{{ asset('img/social/facebook.svg') }}" alt="Facebook" /></a>
                                    <a href="#" class="social-icon apple"><img
                                            src="{{ asset('img/social/apple.svg') }}" alt="Apple" /></a>
                                </div>
                            </div>

                            <p class="text">
                                Forgotten your password or your login details?
                                <a href="#">Get help</a> signing in
                            </p>
                        </div>
                    </form>
                </div>

                <div class="carousel">
                    <div class="images-wrapper">
                        <img src="{{ asset('img/image1.png') }}" class="image img-1 show" alt="" />
                        <img src="{{ asset('img/image2.png') }}" class="image img-2" alt="" />
                        <img src="{{ asset('img/image3.png') }}" class="image img-3" alt="" />
                    </div>

                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Create your own courses</h2>
                                <h2>Customize as you like</h2>
                                <h2>Invite students to your class</h2>
                            </div>
                        </div>

                        <div class="bullets">
                            <span class="active" data-value="1"></span>
                            <span data-value="2"></span>
                            <span data-value="3"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Javascript file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('js/auth/app.js') }}"></script>
</body>

</html>

{{--
    NOTE: All asset and form URLs in this file use Laravel's asset(), route(), or url() helpers. Do not hardcode http://, https://, or localhost. This ensures compatibility with HTTPS/ngrok and correct asset loading.
--}}
