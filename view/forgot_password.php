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
                            <form method="post" onsubmit="return validateForm();">
                                <div class="form-group">
                                    <input type="text" required="" name="email" placeholder="Username or Email *" />
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <input type="text" required="" name="" placeholder="Security code *" />
                                    </div>
                                    <?php
                                    $securityCode = '';
                                    for ($i = 0; $i < 4; $i++) {
                                        $digit = mt_rand(0, 9); // Tạo một số ngẫu nhiên từ 0 đến 9
                                        $securityCode .= $digit;}
                                    ?>
                                    <span class="security-code">
                                        <b class="text-new"><?php echo $securityCode[0]; ?></b>
                                        <b class="text-hot"><?php echo $securityCode[1]; ?></b>
                                        <b class="text-sale"><?php echo $securityCode[2]; ?></b>
                                        <b class="text-best"><?php echo $securityCode[3]; ?></b>
                                    </span>
                                </div>
                                <div class="login_footer form-group mb-50">
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
                                    <button type="submit" class="btn btn-heading btn-block hover-up"
                                        name="forgot_password" value="Submit">Reset
                                        password</button>
                                </div>
                            </form>
                            <!-- Thông báo thành công -->
                            <?php if (isset($thongbao) && ($thongbao != "")) : ?>
                            <div id="success-alert"
                                class="alert mt-3 <?php echo ($checkemail ? 'alert-success' : 'alert-danger'); ?>">
                                <?php echo $thongbao; ?>
                            </div>
                            <?php endif; ?>

                            <!-- Thông báo thất bại -->
                            <?php if (isset($thongbaoloi) && ($thongbaoloi != "")) : ?>
                            <div id="success-alert"
                                class="alert mt-3 <?php echo ($checkemail ? 'alert-success' : 'alert-danger'); ?>">
                                <?php echo $thongbaoloi; ?>
                            </div>
                            <?php endif; ?>

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