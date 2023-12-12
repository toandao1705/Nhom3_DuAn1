<style>
    .error-message {
        color: red;
        margin-top: 5px;
    }
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h1 class="heading-2 mb-10">Checkout</h1>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                </div>
            </div>
        </div>
        <form action="index.php?act=invoice" id="orderForm" method="post" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-lg-7">
                    <div class="row mb-50">
                        <div class="col-lg-6 mb-sm-15 mb-lg-0 mb-md-3">
                            <?php
                            if (isset($_SESSION['user'])) {
                                $name = $_SESSION['user']['name'];
                                $email = $_SESSION['user']['email'];
                                $address = isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : '';
                                $phone = isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '';
                            } else {
                                $name = "";
                                $address = "";
                                $email = "";
                                $phone = "";
                                echo '
                            <div class="toggle_info">
                                <span><i class="fi-rs-user mr-10"></i><span class="text-muted font-lg">Already have an account?</span> <a href="index.php?act=login_google" class="collapsed font-lg" aria-expanded="false">Click here to login</a></span>
                            </div>
                        ';
                        echo '<script>alert("Bạn vui lòng đăng nhập trước khi thanh toán.");</script>';
                        echo '<script>window.location.href = "index.php?act=login_google";</script>';
                        exit; 
                            }

                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <h4 class="mb-30">Billing Details</h4>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="name" id="name" value="<?= $name ?>" placeholder="Name *">
                                <span id="nameError" class="error"></span>
                            </div>
                        </div>
                        <div class="row">
                        <div class="form-group col-lg-12">
                            <input type="email" name="email" id="email" value="<?= $email ?>" placeholder="Email *">
                            <span id="emailError" class="error"></span>
                        </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="phone" id="phone" value="<?= $phone ?>" placeholder="Phone *">
                                <span id="phoneError" class="error"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="address" id="address" value="<?= $address ?>" placeholder="Address *">
                                <span id="addressError" class="error"></span>
                            </div>
                        </div>
                        </div>
                </div>
                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>
                                    <?php
                                    $tong = 0;
                                    $i = 0;
                                    foreach ($_SESSION['mycart'] as $cart) {
                                        $hinh = $cart[2];
                                        $ttien = $cart[3] * $cart[4];
                                        $tong += $ttien;
                                        echo '
                                    <tr>
                                    <td class="image product-thumbnail"><img src="' . $hinh . '" alt="#"></td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="shop-product-full.php" class="text-heading">' . $cart[1] . '</a></h6></span>
                                        <div class="product-rate-cover">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width:90%">
                                                </div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">x ' . $cart[4] . '</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">$' . $cart[3] . '</h4>
                                    </td>
                                </tr>
                        ';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="total clearfix d-flex">
                            <h4>TOTAL</h4>
                            <h4 class="ms-auto">$<?= $tong ?></h4>
                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="online_payment" id="exampleRadios4">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment" onclick="updatePaymentMethod('online')">Pay with momo</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="redirect" id="exampleRadios6">
                                <label class="form-check-label" for="exampleRadios6" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment" onclick="updatePaymentMethod('vnpay')">Pay with vnpay</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" type="radio" name="direct_payment" id="exampleRadios5">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal" onclick="updatePaymentMethod('cash')">Cash on delivery</label>
                            </div>
                        </div>
                        <script>
                            function updatePaymentMethod(method) {
                                var onlinePaymentRadio = document.getElementById("exampleRadios4");
                                var onlinePaymentvnpay = document.getElementById("exampleRadios6");
                                var cashOnDeliveryRadio = document.getElementById("exampleRadios5");
                                var paymentMethodInput = document.getElementById("payment_methods"); // Sửa ID thành "payment_methods"

                                if (method === "online" && !onlinePaymentRadio.checked) {
                                    // Nếu chọn thanh toán online và chưa được chọn, chọn nó
                                    onlinePaymentRadio.checked = true;
                                    onlinePaymentvnpay.checked = false;
                                    cashOnDeliveryRadio.checked = false;
                                    paymentMethodInput.value = 1;
                                } else if (method === "cash" && !cashOnDeliveryRadio.checked) {
                                    // Nếu chọn thanh toán khi nhận hàng và chưa được chọn, chọn nó
                                    onlinePaymentRadio.checked = false;
                                    onlinePaymentvnpay.checked = false;
                                    cashOnDeliveryRadio.checked = true;
                                    paymentMethodInput.value = 0;
                                } else if (method === "vnpay" && !onlinePaymentvnpay.checked) {
                                    // Nếu chọn thanh toán khi nhận hàng và chưa được chọn, chọn nó
                                    cashOnDeliveryRadio.checked = false;
                                    onlinePaymentvnpay.checked = true;
                                    onlinePaymentRadio.checked = false;
                                    paymentMethodInput.value = 2;
                                }
                            }
                        </script>

                        <!-- Input ẩn để chứa giá trị thanh toán -->
                        <input type="hidden" name="payment_methods" id="payment_methods" value="1">
                        <input type="hidden" name="payUrl" id="payUrl" value="">


                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="view/assets/imgs/theme/icons/payment-paypal.svg" alt="">
                            <img class="mr-15" src="view/assets/imgs/theme/icons/payment-visa.svg" alt="">
                            <img class="mr-15" src="view/assets/imgs/theme/icons/payment-master.svg" alt="">
                            <img src="view/assets/imgs/theme/icons/payment-zapper.svg" alt="">
                        </div>
                        <div class="col-4">
                            <input type="submit" class="btn btn-fill-out btn-block mt-30" name="order" value="Place an Order">
                            <!-- <i class="fi-rs-sign-out ml-15"></i> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
    function validateForm() {
        // Kiểm tra sự tồn tại của $_SESSION['user'] bằng JavaScript
        var userExists = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;

        // Nếu $_SESSION['user'] không tồn tại, hiển thị thông báo và ngăn chặn việc submit form
        if (!userExists) {
            alert('Bạn vui lòng đăng nhập trước khi thanh toán.');
            return false; // Ngăn chặn submit form
        }

        // Nếu $_SESSION['user'] tồn tại, form được submit bình thường
        return true;
    }
</script>
    </div>

<script>
    function validateForm() {
        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        
        // Đặt lại các thông báo lỗi trước đó
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";
        document.getElementById("phoneError").innerHTML = "";
        document.getElementById("addressError").innerHTML = "";
        
        // Bắt lỗi cho trường name
        if (name.trim() === '') {
            document.getElementById("nameError").innerHTML = "<span class='error-message'>Please enter your name.</span>";
            event.preventDefault();
        }
        
        // Bắt lỗi cho trường email
        if (email.trim() === "") {
            document.getElementById("emailError").innerHTML = "<span class='error-message'>Please enter your email.</span>";
            event.preventDefault();
        } else if (!/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/.test(email)) {
            document.getElementById("emailError").innerHTML = "<span class='error-message'>Please enter a valid email.</span>";
            event.preventDefault(); 
        } else {
            document.getElementById("emailError").innerHTML = "";
        }
        
        // Bắt lỗi cho trường phone
        if (phone.trim() === "") {
            document.getElementById("phoneError").innerHTML = "<span class='error-message'>Please enter your phone number.</span>";
            event.preventDefault();
        } else if (phone.length < 10 || phone.length > 15) {
            document.getElementById("phoneError").innerHTML = "<span class='error-message'>Please enter the correct phone number.</span>";
            event.preventDefault(); 
        } else if (!/^\d+$/.test(phone)) {
            document.getElementById("phoneError").innerHTML = "<span class='error-message'>Please enter a valid phone number.</span>";
            event.preventDefault();
        } else {
            document.getElementById("phoneError").innerHTML = "";
        }
        
        // Bắt lỗi cho trường address
        if (address.trim() === "") {
            document.getElementById("addressError").innerHTML = "<span class='error-message'>Please enter your address.</span>";
            event.preventDefault();   
        } else {
            document.getElementById("addressError").innerHTML = "";
        }
    }
</script>
</main>