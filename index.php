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
include "global.php";

$products = new products();
$spnew = $products->loadall_sanpham_home();
$delete = 0;
$banner = new banner();
$listbanner = $banner->loadall_banner($delete);


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
        case 'cart':
            include "view/cart.php";
            break;
        case 'checkout':
            include "view/checkout.php";
            break;
        case 'invoice':
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
        case 'login':
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
            include "view/login.php";
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
            if (isset($_POST['forgot_password']) && ($_POST['forgot_password'] == "Submit")) {
                $email = $_POST['email'];
                $checkemail = $forgot_password->checkEmail($email);
        
                if (is_array($checkemail)) {
                    $thongbao = "Mật khẩu của bạn là: " . $checkemail['pass'];
                } else {
                    $thongbaoloi = "Email này không tồn tại. Vui lòng kiểm tra lại";
                }
            }
            include "view/forgot_password.php";
            break;
        case 'page_404':
            include "view/page_404.php";
            break;
        case 'search':
            include "view/search.php";
            break;
        default:
            include "view/home.php";
            break;
    }
} else {
    include "view/home.php";
}
include "view/component/footer.php";