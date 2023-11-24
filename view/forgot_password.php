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
                                    echo $result;

                                    if ($email == '') {
                                        $error['email'] = 'Không được để trống';
                                    }
                                    if (empty($error) && !empty($result)) {
                                        
                                        $code = substr(rand(0,999999),0,6);
                                        $title = "Quên mật khẩu";
                                        $content = "Mã xác nhận của bạn là: <span style='color:green'>".$code."</span>";
                                        $mail->sendMail($title,$content,$email);

                                        $_SESSION['mail'] = $email;
                                        $_SESSION['code'] = $code;
                                        header('location: index.php?act=validate');
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
                                    <a class="text-muted" href="#">Learn more</a>
                                </div>
                                <div class="form-group">

                                    <input type="submit" class="btn btn-heading btn-block hover-up" name="submit">

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
            alert("Bạn phải đồng ý với các điều khoản và chính sách.");
            return false;
        }
    }
    </script>
</main>