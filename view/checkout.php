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
        <div class="row">
            <div class="col-lg-7">
                <div class="row mb-50">
                    <div class="col-lg-6 mb-sm-15 mb-lg-0 mb-md-3">
                        <?php
                        if (isset($_SESSION['user'])) {
                            $name = $_SESSION['user']['name'];
                            $address = $_SESSION['user']['address'];
                            $email = $_SESSION['user']['email'];
                            $phone = $_SESSION['user']['phone'];
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
                        }

                        ?>
                    </div>
                </div>
                <div class="row">
                    <h4 class="mb-30">Billing Details</h4>
                    <form method="post">
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" required="" name="name" value="<?= $name ?>" placeholder="Name *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="email" required="" name="email" value="<?= $email ?>" placeholder="Email *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="phone" required="" value="<?= $phone ?>" placeholder="Phone *">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <input type="text" name="address" required="" value="<?= $address ?>" placeholder="Address *">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                    <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                </div>
                            </div>
                        </div>
                        <div id="collapsePassword" class="form-group create-account collapse in">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input required="" type="password" placeholder="Password" name="password">
                                </div>
                            </div>
                        </div>
                    </form>
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
                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Cash on delivery</label>
                        </div>
                        <div class="custome-radio">
                            <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios5" checked="">
                            <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">Online Getway</label>
                        </div>
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="view/assets/imgs/theme/icons/payment-paypal.svg" alt="">
                        <img class="mr-15" src="view/assets/imgs/theme/icons/payment-visa.svg" alt="">
                        <img class="mr-15" src="view/assets/imgs/theme/icons/payment-master.svg" alt="">
                        <img src="view/assets/imgs/theme/icons/payment-zapper.svg" alt="">
                    </div>
                    <a href="index.php?act=invoice" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>