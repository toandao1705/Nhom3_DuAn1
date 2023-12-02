<div class="invoice invoice-content invoice-1">
        <div class="back-top-home hover-up mt-30 ml-30">
            <a class="hover-up" href="index.php"><i class="fi-rs-home mr-5"></i> Homepage</a>
        </div>
        <div class="container">
        <?php
            if(isset($bill)&&(is_array($bill))){
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-header">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice-name">
                                            <div class="logo">
                                                <a href="index.php"><img src="view/assets/imgs/theme/logo-light.svg" alt="logo" /></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice-numb">
                                            <h6 class="text-end mb-10 mt-20">Date: <?=$order_date ?></h6>
                                            <h6 class="text-end invoice-header-1">Invoice No: #DH<?= $id ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-lg-9 col-md-6">
                                    <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Invoice To</h4>
                                            <p class="invoice-addr-1">
                                                <strong><?= $name?></strong> <br />
                                                <?= $email?><br />
                                                <?= $phone?>, <?= $address?>, <br />VietNam
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                    <div class="invoice-number">
                                            <h4 class="invoice-title-1 mb-10">Bill To</h4>
                                            <p class="invoice-addr-1">
                                                <strong>NestMart Inc</strong> <br />
                                                billing@NestMart.com <br />
                                                123 Hoang Quoc Viet<br />Ninh Kieu, Can Tho, VietNam
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-lg-9 col-md-6">
                                        <h4 class="invoice-title-1 mb-10">Due Date:</h4>
                                        <p class="invoice-from-1"><?=$order_date ?></p>
                                    </div>
                                    <div class="col-lg-3 col-md-6">
                                        <h4 class="invoice-title-1 mb-10">Payment Method</h4>
                                        <p class="invoice-from-1">
                                        <?php
                                            if ($payment_methods == 0) {
                                                echo 'Cash on Delivery';
                                            } elseif ($payment_methods == 1) {
                                                echo 'Online Payment';
                                            } else {
                                                echo 'Unknown Payment Method';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="invoice-center">
                                <div class="table-responsive">
                                    <table class="table table-striped invoice-table">
                                        <thead class="bg-active">
                                            <tr>
                                                <th>Item name</th>
                                                <th class="text-center">Unit Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if (isset($bill) && is_array($bill) && !empty($bill)) {
                                                foreach ($bill as $billDetail) {
                                                    $tongsp = $billDetail['qty'] * $billDetail['price'];
                                                    echo '
                                                    <tr>
                                                        <td>
                                                            <div class="item-desc-1">
                                                                <span>' . $billDetail['proname'] . '</span>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">$' . number_format($billDetail['price'], 2) . '</td>
                                                        <td class="text-center">' . $billDetail['qty'] . '</td>
                                                        <td class="text-right">$' . number_format($tongsp, 2) . '</td>
                                                    </tr>
                                                    ';
                                                    
                                                }
                                            }
                                            ?>
                                           <tr>
                                                <td colspan="3" class="text-end f-w-600">SubTotal</td>
                                                <td class="text-right">$<?= $total ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Tax</td>
                                                <td class="text-right">$0</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" class="text-end f-w-600">Grand Total</td>
                                                <td class="text-right f-w-600">$<?= $total ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>
                                            <h3 class="invoice-title-1">Important Note</h3>
                                            <ul class="important-notes-list-1">
                                                <li>All amounts shown on this invoice are in US dollars</li>
                                                <li>finance charge of 1.5% will be made on unpaid balances after 30 days.</li>
                                                <li>Once order done, money can't refund</li>
                                                <li>Delivery might delay due to some external dependency</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-offsite">
                                        <div class="text-end">
                                            <p class="mb-0 text-13">Thank you for your business</p>
                                            <p><strong>AliThemes JSC</strong></p>
                                            <div class="mobile-social-icon mt-50 print-hide">
                                                <h6>Follow Us</h6>
                                                <a href="#"><img src="view/assets/imgs/theme/icons/icon-facebook-white.svg" alt="" /></a>
                                                <a href="#"><img src="view/assets/imgs/theme/icons/icon-twitter-white.svg" alt="" /></a>
                                                <a href="#"><img src="view/assets/imgs/theme/icons/icon-instagram-white.svg" alt="" /></a>
                                                <a href="#"><img src="view/assets/imgs/theme/icons/icon-pinterest-white.svg" alt="" /></a>
                                                <a href="#"><img src="view/assets/imgs/theme/icons/icon-youtube-white.svg" alt="" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-custom btn-print hover-up"> <img src="view/assets/imgs/theme/icons/icon-print.svg" alt="" /> Print </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-custom btn-download hover-up"> <img src="view/assets/imgs/theme/icons/icon-download.svg" alt="" /> Download </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>