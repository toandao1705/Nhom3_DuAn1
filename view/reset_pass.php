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
                                    if($_POST['repass'] != $_POST['newpass']){
                                        $error['fail'] = 'Re-enter the password does not match !';
                                    }else{
                                        $error['success'] = 'Password changed successfully! Change direction after 3 seconds.';
                                        $user->forgetPass($_POST['newpass'],$_SESSION['mail']);
                                        header('refresh:3;index.php?act=login');
                                    }
                                }
                                ?>
                                <?php if(isset($error) && isset($error['fail'])) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $error['fail'] ?>
                                </div>
                                <?php elseif (isset($error) && isset($error['success'])) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?= $error['success'] ?>
                                </div>
                                <?php else : ?>
                                <div class="alert alert-primary" role="alert">
                                Change new password here
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <input type="text" name="newpass" class="contro-login"
                                        value="<?php if(isset($_POST['newpass'])) echo $_POST['newpass'] ?>"
                                        placeholder="Enter your new password">
                                    <br>
                                    <input type="text" name="repass" class="contro-login mt-3"
                                        value="<?php if(isset($_POST['repass'])) echo $_POST['repass'] ?>"
                                        placeholder="Confirm password">
                                </div>

                                <div class=" form-group">
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