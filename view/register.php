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
                        <div class="col-lg-6 col-md-8">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Create an Account</h1>
                                        <p class="mb-30">Already have an account? <a href="index.php?act=login">Login</a></p>
                                    </div>
                                    <form action="index.php?act=register" method="post" enctype="multipart/form-data" id="validateF">
                                    <div class="form-group">
                                                <?php if(isset($thongbao) && ($thongbao != "")){ ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $thongbao ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="text" name="name" id="username" placeholder="Username" />
                                            <span id="username-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="text" name="email" id="email" placeholder="Email" />
                                            <span id="email-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="password" name="pass" id="pass" placeholder="Password" />
                                            <span id="pass-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="phone" name="phone" id="phone" placeholder="Phone" />
                                            <span id="phone-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"></label>
                                            <input type="address" name="address" id="address" placeholder="Address" />
                                            <span id="address-error" class="error-text text-danger"></span>
                                        </div>
                                        <div class="form-group mb-30">
                                            <input type="submit" value="Register" name="register" class="btn btn-fill-out btn-block hover-up font-weight-bold custom-btn" style="background-color: #3bb77e;">
                                            <!-- <button class="btn btn-fill-out btn-block hover-up font-weight-bold" name="register">Register</button> -->
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                    </form>
                                    <script>
                                        // Hàm kiểm tra định dạng email
                                        function isValidEmail(email) {
                                            var emailPattern = /\S+@\S+\.\S+/;
                                            return emailPattern.test(email);
                                        }

                                        // Hàm kiểm tra định dạng số điện thoại
                                        function isValidPhoneNumber(phone) {
                                            var phonePattern = /^\d{10}$/;
                                            return phonePattern.test(phone);
                                        }

                                        document.getElementById('validateF').addEventListener('submit', function(e) {
                                            // Lấy giá trị của các trường dữ liệu
                                            var username = document.getElementById('username').value;
                                            var email = document.getElementById('email').value;
                                            var pass = document.getElementById('pass').value;
                                            var address = document.getElementById('address').value;
                                            var phone = document.getElementById('phone').value;

                                            // Xóa thông báo lỗi cũ
                                            document.getElementById('username-error').textContent = '';
                                            document.getElementById('email-error').textContent = '';
                                            document.getElementById('pass-error').textContent = '';
                                            document.getElementById('address-error').textContent = '';
                                            document.getElementById('phone-error').textContent = '';

                                            // Bắt lỗi nếu địa chỉ trống
                                            if (username.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('username-error').textContent = 'Username cannot be empty';
                                            }

                                            // Bắt lỗi nếu email trống hoặc không đúng định dạng
                                            if (email.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('email-error').textContent = 'Email cannot be empty';
                                            } else if (!isValidEmail(email)) {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('email-error').textContent = 'Email invalidate';
                                            }

                                            // Bắt lỗi nếu mật khẩu trống hoặc không đúng định dạng
                                            if (pass.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('pass-error').textContent = 'Password cannot be empty';
                                            } else if (pass.length < 6) {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('pass-error').textContent = 'Passwords must be at least 6 characters';
                                            }

                                            // Bắt lỗi nếu địa chỉ trống
                                            if (address.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('address-error').textContent = 'Address cannot be empty';
                                            }

                                            // Bắt lỗi nếu số điện thoại trống hoặc không đúng định dạng
                                            if (phone.trim() === '') {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('phone-error').textContent = 'Phone cannot be empty';
                                            } else if (!isValidPhoneNumber(phone)) {
                                                e.preventDefault(); // Ngăn chặn việc submit form
                                                document.getElementById('phone-error').textContent = 'The phone number must have exactly 10 digits';
                                            }
                                        });
                                    </script>
                                    <?php
                                    // if (isset($thongbao) && ($thongbao != "")) {
                                    //     echo $thongbao;
                                    // }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pr-30 d-none d-lg-block">
                            <div class="card-login mt-115">
                                <a href="#" class="social-login facebook-login">
                                    <img src="view/assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                    <span>Continue with Facebook</span>
                                </a>
                                <a href="#" class="social-login google-login">
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
</main>