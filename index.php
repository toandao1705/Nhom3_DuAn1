<?php
session_start();
ob_start();
include 'model/pdo.php';
include "model/category.php";
$category = new category();
$status = 0;
$categories = $category->loadall_danhmuc($status);
include "view/component/header.php";
include "model/product.php";
include "model/banner.php";
include "model/global.php";
include "model/user.php";
include "model/cart.php";
include "global.php";
if (!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];
include "./mail/index.php";


$mail= new Mailer();
$products = new products();

$spnew = $products->loadall_sanpham_home();
$spview = $products->hienthi_sanpham_view();
$delete = 0;
$banner = new banner();
$listbanner = $banner->loadall_banner($delete);


// data dành cho trang chủ
// $dssp_view=get_dssp_view(8);


if ((isset($_GET['act'])) && ($_GET['act'] != "")) {
    $act = $_GET['act'];
    switch ($act) {
        case 'deals':
            include "view/deals.php";
            break;
        case 'about':
            include "view/about.php";
            break;
        case 'shop':
            include "view/shop.php";
            break;
        case 'reset_password':
            include "view/reset_password.php";
            break;
        case 'product_full':
            $product = new products();
            if (isset($_GET['idsp']) && ($_GET['idsp'] > 0)) {
                $id = $_GET['idsp'];
                $onesp = $product->loadone_sanpham($id);
                extract($onesp);
                $sp_cung_loai = $product->load_sanpham_cungloai($id, $id_category);
                include "view/product_full.php";
            } else {
                include "view/home.php";
            }
            break;
        case 'blog_post':
            include "view/blog_post.php";
            break;
        case 'privacy_policy':
            include "view/privacy_policy.php";
            break;
        case 'terms':
            include "view/terms.php";
            break;
        case 'addtocart':
            // Thêm thông tin sản phẩm từ biểu mẫu thêm vào giỏ hàng vào session
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
                // var_dump($_POST);
                // exit;
                $id = $_POST['id'];
                $name = $_POST['name'];
                $img = $_POST['img'];
                $price = $_POST['price'];
                $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
                $ttien = $quantity * $price;
                $spadd = [$id, $name, $img, $price, $quantity, $ttien];

                // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
                $productExists = false;
                foreach ($_SESSION['mycart'] as $index => $cartItem) {
                    if ($cartItem[0] == $id) {
                        $productExists = true;
                        // Nếu sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng mới
                        $_SESSION['mycart'][$index][4] += $quantity;
                        break;
                    }
                }

                // Nếu sản phẩm chưa có trong giỏ hàng, thêm vào
                if (!$productExists) {
                    array_push($_SESSION['mycart'], $spadd);
                }
            }

            include "view/cart/cart.php";
            break;



        case 'delcart':
            if (isset($_GET['idcart'])) {
                array_splice($_SESSION['mycart'], $_GET['idcart'], 1);
            } else {
                $_SESSION['mycart'] = [];
            }
            header('Location: index.php?act=addtocart');
            break;
        case 'checkout':
            include "view/checkout.php";
            break;
        case 'invoice':
            $connect = new connect();
            $carts = new cart();
            if(isset($_POST['order']) && ($_POST['order'])){
                if(isset($_SESSION['user'])) $iduser=$_SESSION['user']['id'];
                else $id=0;
                $name=$_POST['name'];
                $email=$_POST['email'];
                $address=$_POST['address'];
                $payment_methods=$_POST['payment_methods'];
                $phone=$_POST['phone'];
                $order_date=date('h:i:sa d/m/Y');
                $total = $carts->tongdonhang();
                //tạo bill
                $order_date=date('h:i:sa d/m/Y');
                $order_date=date('h:i:sa d/m/Y');
                $idbill = $carts->insert_bill($iduser, $name, $email, $address, $phone, $payment_methods,$order_date, $total);

                //insert into cart : $session['mycart'] & idbill

                foreach ($_SESSION['mycart'] as $product) {
                    // Thêm sản phẩm vào chi tiết hóa đơn (bill_detail)
                    $carts->insert_cart($iduser, $product[0], $product[2], $product[1], $product[3], $product[4], $product[5]);
                    
                    // // Lấy id sản phẩm vừa thêm vào chi tiết hóa đơn
                    // $idpro = $carts->getLastInsertedProductId();
                    
                    // // Insert vào bảng bill_detail
                    // $carts->insert_bill_detail($idbill, $idpro, $product[3], $product[4]);
                }
                
                
                
                // Sau khi thêm vào chi tiết hóa đơn, bạn có thể xóa session cart
                $_SESSION['mycart'] = [];
                
                
            }
                // $bill=$cart->loadone_bill($idbill);
                // $billct=$cart->loadall_cart($idbill);
            include "view/invoice.php";
            break;
        case 'contact':
            include "view/contact.php";
            break;
        case 'account':
            include "view/account.php";
            break;
        case 'blog_category':
            include "view/blog_category.php";
            break;
        case 'register':
            $register = new user();
            if (isset($_POST['register']) && ($_POST['register'])) {
                $email = $_POST['email'];
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $registers = $register->insert_taikhoan($name, $email, $pass, $address, $phone);
                $thongbao = "Đã đăng ký thành công vui lòng đăng nhập";
                header("Location: index.php?act=login");
            }
            include "view/register.php";
            break;
        case 'forgot_password':
            $forgot_password = new user();
            $user= new user();
            include "view/forgot_password.php";
            break;
        case 'validate':
            include "view/validate.php";
            break;
        case 'reset_pass':
            $forgot_password = new user();
            $user= new user();
            include "view/reset_pass.php";
            break;
        case 'page_404':
            include "view/page_404.php";
            break;
        case 'home1':
            include "view/home1.php";
            break;
        case 'search':
            $search = new products();
            if (isset($_POST['kyw']) && ($_POST['kyw'] != "")) {
                $kyw = $_POST['kyw'];
            } else {
                $kyw = "";
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $delete = 0;
            $dssp = $search->loadall_tksanpham($kyw, $iddm, $delete);
            $tendm = $search->load_ten_dm($iddm);
            include "view/search.php";
            break;
            // case 'logout':
            //     session_unset();
            //     header("Location: index.php");
            //     break;
        case 'logout':
            // Initialize the session.
            // If you are using session_name("something"), don't forget it now!
            // session_start();

            // Unset all of the session variables.
            $_SESSION = array();

            // If it's desired to kill the session, also delete the session cookie.
            // Note: This will destroy the session, and not just the session data!
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(
                    session_name(),
                    '',
                    time() - 42000,
                    $params["path"],
                    $params["domain"],
                    $params["secure"],
                    $params["httponly"]
                );
            }

            // Finally, destroy the session.
            session_destroy();
            header("Location: index.php");
            exit;
            break;
        case 'login_google':
            $login = new user();
            if (isset($_POST['login']) && ($_POST['login'])) {
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $checkuser = $login->checkUsers($name, $pass);

                if (is_array($checkuser)) {
                    $_SESSION['user'] = $checkuser;
                    header("Location: index.php?act=shop");
                    exit;
                } else {
                    $thongbao = "Tài khoản không tồn tại. Vui lòng kiểm tra lại";
                }
            }

            session_regenerate_id(true);
            // require 'config.php';

            if (isset($_SESSION['login_id'])) {
                header('Location: index.php?act=shop');
                exit;
            }

            require 'view/google-api/vendor/autoload.php';

            // Creating new google client instance
            $client = new Google_Client();

            // Enter your Client ID
            $client->setClientId('444210929427-tgnqn412o963o71gh41mps89t9h9n12f.apps.googleusercontent.com');
            // Enter your Client Secrect
            $client->setClientSecret('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');
            // Enter the Redirect URL
            $client->setRedirectUri('http://localhost/nhom3_duan1/index.php?act=login_google');

            // Adding those scopes which we want to get (email & profile Information)
            $client->addScope("email");
            $client->addScope("profile");



            // ...

            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                if (!isset($token["error"])) {
                    $client->setAccessToken($token['access_token']);

                    // getting profile information
                    $google_oauth = new Google_Service_Oauth2($client);
                    $google_account_info = $google_oauth->userinfo->get();

                    // Storing data into database
                    $id = mysqli_real_escape_string($db_connection, $google_account_info->id);
                    $full_name = mysqli_real_escape_string($db_connection, trim($google_account_info->name));
                    $email = mysqli_real_escape_string($db_connection, $google_account_info->email);
                    $profile_pic = mysqli_real_escape_string($db_connection, $google_account_info->picture);

                    // checking user already exists or not
                    $get_user = mysqli_query($db_connection, "SELECT * FROM `user` WHERE `google_id`='$id'");
                    if (mysqli_num_rows($get_user) > 0) {
                        $user_info = mysqli_fetch_assoc($get_user);

                        $_SESSION['login_id'] = $id;
                        $_SESSION['user'] = $user_info; // Lưu thông tin user vào session

                        header('Location: index.php');
                        exit;
                    } else {
                        // if user not exists we will insert the user
                        $insert = mysqli_query($db_connection, "INSERT INTO `user`(`google_id`,`name`,`email`) VALUES('$id','$full_name','$email')");

                        if ($insert) {
                            $_SESSION['login_id'] = $id;
                            $_SESSION['user'] = array(
                                'id' => mysqli_insert_id($db_connection),
                                'google_id' => $id,
                                'name' => $full_name,
                                'email' => $email
                            ); // Lưu thông tin user vào session

                            header('Location: index.php');
                            exit;
                        } else {
                            echo "Sign up failed!(Something went wrong).";
                        }
                    }
                } else {
                    header('Location: index.php?act=login');
                    exit;
                }
            }

            // ...


            include "view/login.php";
            break;

        default:
            include "view/home.php";
            break;
    }
} else {
    include "view/home.php";
}
include "view/component/footer.php";