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
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php?act=logout"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">
                                <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Hello Rosie!</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                                manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Your Orders</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Total</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Kiểm tra xem $user có dữ liệu hay không
                                                        if (!empty($listdh)) {
                                                            // Hiển thị thông tin tai khoan
                                                            foreach ($listdh as $donhang) {
                                                                extract($donhang);

                                                                // Chuyển đổi giá trị status thành trạng thái tương ứng
                                                                switch ($status) {
                                                                    case 0:
                                                                        $status_text = 'Đơn hàng mới';
                                                                        break;
                                                                    case 1:
                                                                        $status_text = 'Đang xử lý';
                                                                        break;
                                                                    case 2:
                                                                        $status_text = 'Đang giao hàng';
                                                                        break;
                                                                    case 3:
                                                                        $status_text = 'Giao hàng thành công';
                                                                        break;
                                                                    default:
                                                                        $status_text = 'Trạng thái không xác định';
                                                                        break;
                                                                }
                                                                echo '
                                                                    <tr>
                                                                        <td>#' . $bill_id . '</td>
                                                                        <td>' . $ngaydathang . '</td>
                                                                        <td>' . $status_text . '</td>
                                                                        <td>$' . number_format($price, 2) . ' for ' . $qty . '</td>
                                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                                        </tr>';
                                                            }
                                                        } else {
                                                            echo '<tr><td colspan="4">There are no orders.</td></tr>';
                                                        }
                                                        ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="mb-0">Orders tracking</h3>
                                        </div>
                                        <div class="card-body contact-from-area">
                                            <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <form class="contact-form-style mt-30 mb-50" action="#" method="post">
                                                        <div class="input-style mb-20">
                                                            <label>Order ID</label>
                                                            <input name="order-id" placeholder="Found in your order confirmation email" type="text" />
                                                        </div>
                                                        <div class="input-style mb-20">
                                                            <label>Billing email</label>
                                                            <input name="billing-email" placeholder="Email you used during checkout" type="email" />
                                                        </div>
                                                        <button class="submit submit-auto-width" type="submit">Track</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card mb-3 mb-lg-0">
                                                <div class="card-header">
                                                    <h3 class="mb-0">Billing Address</h3>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        3522 Interstate<br />
                                                        75 Business Spur,<br />
                                                        Sault Ste. <br />Marie, MI 49783
                                                    </address>
                                                    <p>New York</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Shipping Address</h5>
                                                </div>
                                                <div class="card-body">
                                                    <address>
                                                        4299 Express Lane<br />
                                                        Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                    </address>
                                                    <p>Sarasota</p>
                                                    <a href="#" class="btn-small">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Account Details</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>Already have an account? <a href="index.php?act=login">Log in instead!</a></p>
                                            <?php
                                            if (isset($_SESSION['user']) && (is_array($_SESSION['user']))) {
                                                extract($_SESSION['user']);
                                                $name = $_SESSION['user']['name'];
                                                $email = $_SESSION['user']['email'];
                                                $address = isset($_SESSION['user']['address']) ? $_SESSION['user']['address'] : '';
                                                $phone = isset($_SESSION['user']['phone']) ? $_SESSION['user']['phone'] : '';
                                            }
                                            ?>
                                            <form action="index.php?act=updateAccountUser" method="post" enctype="multipart/form-data" id="validateF" onsubmit="return validateForm();">
                                                <div class="form-group">
                                                    <?php if (isset($thongbao) && ($thongbao != "")) { ?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <?= $thongbao ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Username <span class="required">*</span></label>
                                                    <input type="text" id="name" value="<?php echo $name ?>" placeholder="Username" disabled />

                                                    <span id="username-error" class="error-text text-danger"></span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email<span class="required">*</span></label>

                                                    <input type="text" name="email" id="email" value="<?= $email ?>" placeholder="Email" />
                                                    <span id="email-error" class="error-text text-danger"></span>
                                                </div>
                                                <!-- <div class="form-group col-md-12">
                                                    <label>Password<span class="required">*</span></label>
                                                    <input type="password" name="pass" id="pass" value="" placeholder="Password" />
                                                    <span id="pass-error" class="error-text text-danger"></span>
                                                </div> -->
                                                <div class="form-group col-md-12">
                                                    <label>Phone<span class="required">*</span></label>
                                                    <input type="phone" name="phone" id="phone" value="<?= $phone ?>" placeholder="Phone" />
                                                    <span id="phone-error" class="error-text text-danger"></span>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Address<span class="required">*</span></label>
                                                    <input type="address" name="address" id="address" value="<?= $address ?>" placeholder="Address" />
                                                    <span id="address-error" class="error-text text-danger"></span>
                                                </div>
                                                <div class="form-group mb-30">
                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                    <input type="submit" value="Save Change" name="updateAccount" class="btn btn-fill-out btn-block hover-up font-weight-bold custom-btn" style="background-color: #3bb77e;">
                                                    <!-- <button class="btn btn-fill-out btn-block hover-up font-weight-bold" name="register">Register</button> -->
                                                </div>
                                            </form>
                                            <script>
                                                function validateForm() {
                                                    var email = document.getElementById('email').value;
                                                    var phone = document.getElementById('phone').value;
                                                    var address = document.getElementById('address').value;

                                                    // Reset error messages
                                                    document.getElementById('email-error').innerText = '';
                                                    document.getElementById('phone-error').innerText = '';
                                                    document.getElementById('address-error').innerText = '';

                                                    // Validate email
                                                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                                                    if (!emailRegex.test(email)) {
                                                        document.getElementById('email-error').innerText = 'Invalid email format';
                                                        return false;
                                                    }

                                                    // Validate phone
                                                    var phoneRegex = /^\d{10,14}$/;
                                                    if (!phoneRegex.test(phone)) {
                                                        document.getElementById('phone-error').innerText = 'Invalid phone format (10 to 14 digits)';
                                                        return false;
                                                    }

                                                    // Validate address (assuming any non-empty string is valid)
                                                    if (address.trim() === '') {
                                                        document.getElementById('address-error').innerText = 'Address cannot be empty';
                                                        return false;
                                                    }

                                                    return true;
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>