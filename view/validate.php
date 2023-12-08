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
                                    the confirmation code.</p>
                            </div>
                            <form action="" class="form" method="post">
                                <?php
                                    if(isset($_POST['submit'])){
                                        $error = array();
                                        $currentTime = time();
                                        if ($currentTime < $_SESSION['expirationTime']) {
                                            
                                            if($_POST['text'] != $_SESSION['code']){
                                                $error['fail'] = 'Verification code is invalid !';
                                            }else{
                                                header('location: index.php?act=reset_pass');
                                            }
                                        }else {
                                            $errorTime = 'Code expiration time';
                                        }
                                    }
                                ?>
                                <div class="form-group">
                                    <?php if(isset($error['fail'])) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $error['fail'] ?>
                                    </div>
                                    <?php else : ?>
                                    <div class="alert alert-primary" role="alert">
                                        <?php
                                        if (isset($errorTime)) {
                                            echo $errorTime;
                                        }else{
                                            echo 'Please enter the confirmation code we sent you to your email';
                                        }
                                        ?>
                                    </div>
                                    <?php endif ?>

                                </div>
                                <input type="text" class="control-login" name="text" placeholder="Enter the confirmation code">
                                <div class=" form-group mt-3" >
                                    <button type="submit" class="btn btn-heading btn-block hover-up" name="submit">
                                        Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>