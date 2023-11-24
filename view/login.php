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
                                        <p class="mb-30">Don't have an account? <a href="index.php?act=register">Create here</a></p>
                                    </div>
                                    <form action="index.php?act=login_google" method="post">
                                        <div class="form-group">
                                            <input type="text" required="" name="name" placeholder="Username*" />
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="pass" placeholder="Your password *" />
                                        </div>
                                        <div class="login_footer form-group mb-50">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                                    <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                </div>
                                            </div>
                                            <a class="text-muted" href="index.php?act=forgot_password">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="login" value="Login" class="font-weight-bold text-light" style="background-color: #3bb77e;">
                                        </div>
                                    </form>
                                    <div class="col-lg-12 d-none d-lg-block">
                                        <div class="card-login">
                                            <a href="#" class="social-login facebook-login">
                                                <img src="view/assets/imgs/theme/icons/logo-facebook.svg" alt="" />
                                                <span>Continue with Facebook</span>
                                            </a>
                                            <a class="social-login google-login" href="<?php echo $client->createAuthUrl(); ?>">
                                                <img src="view/assets/imgs/theme/icons/logo-google.svg" alt="" />
                                                <span>Continue with Google</span>
                                            </a>
                                            <a href="#" class="social-login apple-login">
                                                <img src="view/assets/imgs/theme/icons/logo-apple.svg" alt="" />
                                                <span>Continue with Apple</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if (isset($thongbao) && ($thongbao != "")) {
                                        echo $thongbao;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>