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
                <div class="col-xl-4 col-lg-6 col-md-12 m-auto">
                    <div class="login_wrap widget-taber-content background-white">
                        <div class="padding_eight_all bg-white">
                            <div class="heading_s1">
                                <img class="border-radius-15" src="view/assets/imgs/page/forgot_password.svg" alt="" />
                                <h2 class="mb-15 mt-15">Forgot your password?</h2>
                                <p class="mb-30">Not to worry, we got you! Let’s get you a new password. Please enter
                                    your email address or your Username.</p>
                            </div>
                            <form id="formDemo" method="post" onsubmit="return validateForm();">
                                <?php
                                if (isset($_POST['submit'])) {
                                    $error = array();
                                    $email = $_POST['email'];
                                    $result = $user->getUserEmail($email);

                                    if ($email == '') {
                                        $error['email'] = 'Cannot be left blank';
                                    }
                                    
                                    if (empty($error) && !empty($result)) {
                                        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // Tạo mã xác nhận ngẫu nhiên có 6 chữ số

                                        // Gửi email chứa mã code
                                        $title = "Forgot password";
                                        $content = "Your confirmation code is: <span style='color:green'>".$code."</span>";
                                        $mail->sendMail($title, $content, $email);

                                        // Lưu thông tin vào session để sử dụng trong trang validate.php
                                        $_SESSION['mail'] = $email;
                                        $_SESSION['code'] = $code;

                                        // Lấy thời gian hiện tại
                                        $currentTime = time();
                                        // Lấy thời gian hết hạn sau 60 giây
                                        $expirationTime = $currentTime + 30;

                                        // Lưu thời gian hết hạn vào session
                                        $_SESSION['expirationTime'] = $expirationTime;

                                        header('Location: index.php?act=validate');
                                        exit();
                                    }
                                }
                                ?>
                                <div class="form-group">
                                    <input type="text" required="" name="email" placeholder="Username or Email *" />
                                    <span
                                        style="color:red;"><?php if(isset($error['email'])) echo $error['email'] ?></span>
                                </div>

                                <div class=" login_footer form-group mb-50">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox"
                                                id="exampleCheckbox1" value="" />
                                            <label class="form-check-label" for="exampleCheckbox1"><span>I agree to
                                                    terms & Policy.</span></label>
                                        </div>
                                    </div>
                                    <a class="text-muted" href="index.php">Learn more</a>
                                </div>
                                <div class="form-group">

                                    <input type="submit" class="btn btn-heading btn-block hover-up" name="submit" value="Submit">

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    function validateForm() {
        var checkbox = document.getElementById("exampleCheckbox1");
        if (!checkbox.checked) {
            alert("You must agree to the terms and policies.");
            return false;
        }
    }
    </script>
</main>