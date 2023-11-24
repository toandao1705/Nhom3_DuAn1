<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    /* Add your styles here */
    .error-message {
        color: red;
    }
</style>

<body>
    <section class="vh-100" style="background-color: #0074D9;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block d-flex align-self-center" style="height: 100%;">
                                <img src="../view/assets/imgs/theme/logo.svg" alt="login form" class="img-fluid mx-auto w-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form role="form" method="post" id="loginForm" onsubmit="return validateForm()">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Đăng nhập vào tài khoản của bạn</h5>
                                        <?php if (isset($loginError)) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?php echo $loginError; ?>
                                        </div>
                                    <?php endif; ?>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="form2Example17" name="name" class="form-control form-control-lg" placeholder="Tên*" />
                                            <p id="nameError" class="error-message"></p>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="form2Example27" name="pass" class="form-control form-control-lg" placeholder="Mật khẩu*" />
                                            <p id="passError" class="error-message"></p>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn bg-gradient-primary w-100 my-4 mb-2 btn-primary">Đăng nhập</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Quên mật khẩu?</a>
                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Bạn không có tài khoản? <a href="#!" style="color: #393f81;">Đăng ký tại đây</a></p>
                                        <a href="#!" class="small text-muted">Điều khoản sử dụng.</a>
                                        <a href="#!" class="small text-muted">Chính sách bảo mật</a>
                                    </form>

                                    <script>
                                        function validateForm() {
                                            var name = document.getElementById('form2Example17').value;
                                            var password = document.getElementById('form2Example27').value;

                                            // Reset previous error messages
                                            document.getElementById('nameError').innerText = '';
                                            document.getElementById('passError').innerText = '';

                                            var isValid = true;

                                            // Validate name
                                            if (name.trim() === '') {
                                                document.getElementById('nameError').innerText = 'Vui lòng nhập tên.';
                                                isValid = false;
                                            }

                                            // Validate password
                                            if (password.trim() === '') {
                                                document.getElementById('passError').innerText = 'Vui lòng nhập mật khẩu.';
                                                isValid = false;
                                            } else if (password.length < 6) {
                                                document.getElementById('passError').innerText = 'Mật khẩu phải có ít nhất 6 ký tự.';
                                                isValid = false;
                                            }

                                            return isValid;
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>