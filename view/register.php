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
                                    <form action="index.php?act=register" method="post">
                                        <div class="form-group">
                                            <input type="text" required="" name="name" placeholder="Username" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" required="" name="email" placeholder="Email" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="pass" placeholder="Password" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="phone" name="phone" placeholder="Phone" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="address" name="address" placeholder="Address" />
                                        </div>
                                        <div class="form-group mb-30">
                                        <input type="submit" value="Register" name="register" class="btn btn-fill-out btn-block hover-up font-weight-bold custom-btn" style="background-color: #3bb77e;">
                                            <!-- <button class="btn btn-fill-out btn-block hover-up font-weight-bold" name="register">Register</button> -->
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
                                    </form>
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