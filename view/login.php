<script>
    console.log(1234567)
    window.fbAsyncInit = function () {
        // FB JavaScript SDK configuration and setup
        FB.init({
            appId: '322691830504794', // FB App ID
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true, // parse social plugins on this page
            version: 'v18.0' // use graph api version 2.8
        });

        // Check whether the user already logged in
        FB.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                //display user data
                getFbUserData();
            }
        });
    };

    // Load the JavaScript SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Facebook login with JavaScript SDK
    function fbLogin() {
        FB.login(function (response) {
            if (response.authResponse) {
                // Get and display the user profile data
                getFbUserData();
            } else {
                document.getElementById('status').innerHTML =
                    'User cancelled login or did not fully authorize.';
            }
        }, {
            scope: 'email'
        });
    }

    // Fetch the user profile data from facebook
    function getFbUserData() {
        FB.api('/me', {
            locale: 'en_US',
            fields: 'id,first_name,last_name,email,link,gender,locale,picture'
        },
            function (response) {
                document.getElementById('userData').innerHTML =
                    '<p><b>FB ID:</b> ' + response.id + '</p><p><b>Name:</b> ' +
                    response.first_name + ' ' + response.last_name + '</p><p><b>Email:</b> ' + response.email +
                    '</p>';
                document.getElementById('fbLink').setAttribute("onclick", "fbLogout()");
                document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
                document.getElementById('status').innerHTML = '<p>Thanks for logging in, ' + response.first_name +
                    '!</p>';
                // Save user data
                saveUserData(response);
            });
    }

    // Save user data to the database
    function saveUserData(userData) {
        console.log(userData); // Hiển thị giá trị của tham số userData trong bảng điều khiển
        $.post('view/userData.php', {
            oauth_provider: 'facebook',
            userData: JSON.stringify(userData)
        }, function () {
            window.location.href = 'index.php';
        });
    }

    // Logout from facebook
    function fbLogout() {
        FB.logout(function () {
            document.getElementById('fbLink').setAttribute("onclick", "fbLogin()");
            document.getElementById('fbLink').innerHTML = 'Logout from Facebook';
            document.getElementById('userData').innerHTML = '';
            document.getElementById('status').innerHTML = '<p>You have successfully logout from Facebook.</p>';
        });
    }
</script>
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <img class="border-radius-15" src="view/assets/imgs/page/login-1.png" alt="" />
                        </div>
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Login</h1>
                                        <p class="mb-30">Don't have an account? <a href="index.php?act=register">Create
                                                here</a></p>
                                        <div id="status"></div>
                                        <div id="userData" style="display: none;"></div>

                                    </div>
                                    <form action="index.php?act=login_google" method="post"
                                        enctype="multipart/form-data" id="validateF">
                                    <div class="form-group">
                                    <?php
                                    if (isset($thongbao) && ($thongbao != "")) {
                                        echo' <div class="alert alert-danger" role="alert">'.$thongbao.'
                                    </div>';
                                    }
                                    ?>
                                    </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="text" name="name" id="username" placeholder="Username*" />
                                            <span id="username-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" id="pass"
                                                placeholder="Your password *" />
                                            <span id="pass-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox1" value="" />
                                                    <label class="form-check-label"
                                                        for="exampleCheckbox1"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="index.php?act=forgot_password">Forgot
                                                password?</a>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="login" value="Login"
                                                class="font-weight-bold text-light" style="background-color: #3bb77e;">
                                        </div>
                                    </form>
                                    <script>
                                        document.getElementById('validateF').addEventListener('submit', function (e) {
                                            // Lấy giá trị của các trường dữ liệu
                                            var username = document.getElementById('username').value;
                                            var pass = document.getElementById('pass').value;
                                            // Xóa thông báo lỗi cũ
                                            document.getElementById('username-error').textContent = '';
                                            document.getElementById('pass-error').textContent = '';
                                            // Bắt lỗi nếu địa chỉ trống
                                            if (username.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('username-error').textContent =
                                                    'Username cannot be empty';
                                            }

                                            // Bắt lỗi nếu mật khẩu trống hoặc không đúng định dạng
                                            if (pass.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('pass-error').textContent =
                                                    'Password cannot be empty';
                                            } else if (pass.length < 6) {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('pass-error').textContent =
                                                    'Passwords must be at least 6 characters';
                                            }
                                        });
                                    </script>
                                    <div class="col-lg-12 d-none d-lg-block">
                                        <div class="card-login">
                                            <a href="javascript:void(0);" onclick="fbLogin();" id="fbLink"
                                                class="social-login facebook-login">
                                                <img src="view/assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                                <!-- Nút đăng nhập hoặc đăng xuất Facebook -->
                                                <span>Continue with Facebook</span>
                                                <!-- <div class="ac-data" id="userData"></div> -->
                                            </a>
                                            <a class="social-login google-login"
                                                href="<?php echo $client->createAuthUrl(); ?>">
                                                <img src="view/assets/imgs/theme/icons/logo-google.svg" alt="" />
                                                <span>Continue with Google</span>
                                            </a>
                                            <a href="#" class="social-login apple-login">
                                                <img src="view/assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                                <span>Continue with Apple</span>
                                            </a>
                                        </div>
                                    </div>

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>