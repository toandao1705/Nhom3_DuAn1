 <main class="main">
     <div class="page-header breadcrumb-wrap">
         <div class="container">
             <div class="breadcrumb">
                 <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                 <span></span> Shop
                 <span></span> Cart
             </div>
         </div>
     </div>
     <div class="container mb-80 mt-50">
         <div class="row">
             <div class="col-lg-8 mb-40">
                 <h1 class="heading-2 mb-10">Your Cart</h1>
                 <div class="d-flex justify-content-between">
                     <?php
                        $cart = isset($_SESSION['mycart']) ? $_SESSION['mycart'] : [];
                        $cartCount = count($cart);
                        ?>
                     <h6 class="text-body">There are <span class="text-brand"><?= $cartCount ?></span> products in your cart</h6>
                     <h6 class="text-body"><a href="#" class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-8">
                 <form action="index.php?act=addtocart" method="post">
                     <div class="table-responsive shopping-summery">
                         <table class="table table-wishlist">
                             <div class="form-group">
                                 <?php
                                    if (isset($_SESSION['quantityAnnouncement']) && ($_SESSION['quantityAnnouncement'] != "")) {
                                        echo ' <div class="alert alert-danger" role="alert">' . $_SESSION['quantityAnnouncement'] . '
                                    </div>';
                                    }
                                    ?>
                                 <?php
                                    // Unset session sau khi đã sử dụng nó
                                    unset($_SESSION['quantityAnnouncement']);
                                    ?>
                             </div>
                             <thead>
                                 <tr class="main-heading">
                                     <!-- <th class="custome-checkbox start pl-30">
                                     <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="">
                                     <label class="form-check-label" for="exampleCheckbox11"></label>
                                 </th> -->
                                     <th scope="col" colspan="2">Product</th>
                                     <th scope="col">Unit Price</th>
                                     <th scope="col">Quantity</th>
                                     <th scope="col">Subtotal</th>
                                     <th scope="col" class="end">Remove</th>
                                 </tr>
                             </thead>

                             <tbody>
                                 <?php
                                    if (isset($_SESSION['mycart']) && count($_SESSION['mycart']) > 0) {
                                        $tong = 0;
                                        $i = 0;
                                        foreach ($_SESSION['mycart'] as $cart) {
                                            $hinh = $cart[2];
                                            $ttien = $cart[3] * $cart[4];
                                            $tong += $ttien;

                                            $xoasp = 'index.php?act=delcart&idcart=' . $i . '';
                                            echo '
                                        <tr class="pt-30">
                                            <td class="image product-thumbnail pt-40"><img src="' . $hinh . '" alt="#"></td>
                                            <td class="product-des product-name">
                                                <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="shop-product-right.php">' . $cart[1] . '</a></h6>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-body">$' . $cart[3] . '</h4>
                                            </td>
                                            <td class="text-center detail-info" data-title="Stock">
                                                <div class="detail-extralink mr-15">
                                                    <div class="detail-qty border radius">
                                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                        <input type="text" name="quantity[]" class="qty-val" value="' . $cart[4] . '" min="1">
                                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-brand"> $' . $ttien . '</h4>
                                            </td>
                                            <td class="action text-center" data-title="Remove"><a href="' . $xoasp . '" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                        </tr>
                                                            ';
                                            // $soluong_sanpham++;
                                            $i += 1;
                                        }
                                    } else {
                                        // Giỏ hàng không có sản phẩm
                                        echo '<tr><td colspan="6" class="text-center">Your shopping cart is empty.</td></tr>';
                                    }
                                    ?>
                             </tbody>
                         </table>
                     </div>
                     <div class="divider-2 mb-30"></div>
                     <div class="cart-action d-flex justify-content-between">
                         <a href="index.php?act=shop" class="btn col-2"><i class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                         <input type="submit" class="btn  mr-10 mb-sm-15 col-2" name="updateCart" value="Update Cart">
                         <!-- <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-refresh mr-10"></i>Update Cart</a> -->
                     </div>
                 </form>
             </div>
             <div class="col-lg-4">
                 <div class="border p-md-4 cart-totals ml-30">
                     <div class="table-responsive">
                         <table class="table no-border">
                             <tbody>
                                 <tr>
                                     <td class="cart_total_label">
                                         <h6 class="text-muted">Subtotal</h6>
                                     </td>
                                     <td class="cart_total_amount">
                                         <h4 class="text-brand text-end">$<?= $tong ?></h4>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td scope="col" colspan="2">
                                         <div class="divider-2 mt-10 mb-10"></div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="cart_total_label">
                                         <h6 class="text-muted">Shipping</h6>
                                     </td>
                                     <td class="cart_total_amount">
                                         <h5 class="text-heading text-end">Free</h4< /td>
                                 </tr>
                                 <tr>
                                     <td class="cart_total_label">
                                         <h6 class="text-muted">Estimate for</h6>
                                     </td>
                                     <td class="cart_total_amount">
                                         <h5 class="text-heading text-end">United Kingdom</h4< /td>
                                 </tr>
                                 <tr>
                                     <td scope="col" colspan="2">
                                         <div class="divider-2 mt-10 mb-10"></div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td class="cart_total_label">
                                         <h6 class="text-muted">Total</h6>
                                     </td>
                                     <td class="cart_total_amount">
                                         <h4 class="text-brand text-end">$<?= $tong ?></h4>
                                     </td>
                                 </tr>
                             </tbody>
                         </table>
                     </div>
                     <a href="index.php?act=checkout" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                 </div>
             </div>
         </div>
     </div>
 </main>