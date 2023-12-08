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

include "./mail/index.php";

$mail = new Mailer();
if (!isset($_SESSION['mycart'])) $_SESSION['mycart'] = [];

$products = new products();

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 20;
$start = ($page - 1) * $limit;
$spnew = $products->loadall_sanpham_home($start, $limit);
$totalProducts = count($products->loadall_sanpham_home(0, PHP_INT_MAX));
$totalPages = ceil($totalProducts / $limit);
//không vượt quá số trang tổng cộng
$page = max(min($page, $totalPages), 1);


$spview = $products->hienthi_sanpham_view();
$sp_deals = $products->deals_sanpham();
$delete = 0;
$banner = new banner();
$listbanner = $banner->loadall_banner($delete, 0, PHP_INT_MAX);


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
            if (isset($_GET['partnerCode'])) {
                $data_momo = [
                    'partnerCode' => $_GET['partnerCode'],
                    'orderId' => $_GET['orderId'],
                    'requestId' => $_GET['requestId'],
                    'amount' => $_GET['amount'],
                    'orderInfo' => $_GET['orderInfo'],
                    'orderType' => $_GET['orderType'],
                    'transId' => $_GET['transId'],
                    'payType' => $_GET['payType'],
                    'signature' => $_GET['signature'],
                ];
                $data = new cart();
                $data->insert_momo($data_momo);
            }
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
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
                        $_SESSION['mycart'][$index][5] = $_SESSION['mycart'][$index][4] * $price; // Cập nhật thành tiền mới
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
            if (isset($_POST['order']) && ($_POST['order'])) {
                if (isset($_SESSION['user'])) $iduser = $_SESSION['user']['id'];
                else $id = 0;
                $name = $_POST['name'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $payment_methods = $_POST['payment_methods'];
                $phone = $_POST['phone'];
                $order_date = date('h:i:sa d/m/Y');
                $total = $carts->tongdonhang();
                $idbill = $carts->insert_bill($iduser, $name, $email, $address, $phone, $payment_methods, $order_date, $total);

                //insert into cart : $session['mycart'] & idbill

                foreach ($_SESSION['mycart'] as $product) {
                    // Thêm sản phẩm vào chi tiết hóa đơn (bill_detail)
                    $carts->insert_cart($_SESSION['user']['id'], $product[0], $product[2], $product[1], $product[3], $product[4], $product[5]);
                    $carts->insert_bill_detail($idbill, $product[0], $product[3], $product[4]);
                }



                // Kiểm tra xem $idbill có tồn tại không trước khi sử dụng
                if ($idbill) {
                    if ($payment_methods == 1) {
                        $totall = 0;
                        $subtotal = 0;
                        foreach ($_SESSION['mycart'] as $item) {
                            $subtotal = $item[3] * $item[4] * 24000;
                            $totall += $subtotal;
                        }
                        function execPostRequest($url, $data)
                        {
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt(
                                $ch,
                                CURLOPT_HTTPHEADER,
                                array(
                                    'Content-Type: application/json',
                                    'Content-Length: ' . strlen($data)
                                )
                            );
                            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                            //execute post
                            $result = curl_exec($ch);
                            //close connection
                            curl_close($ch);
                            return $result;
                        }
                        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


                        $partnerCode = 'MOMOBKUN20180529';
                        $accessKey = 'klm05TvNBzhg7h7j';
                        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
                        $orderInfo = "Thanh toán qua MoMo";
                        $amount = $totall;
                        $orderId = rand(00, 9999);
                        $redirectUrl = "http://localhost/nhom3_duan1/index.php?act=addtocart";
                        $ipnUrl = "http://localhost/nhom3_duan1/index.php?act=addtocart";
                        $extraData = "";


                        if (!empty($_POST)) {
                            $partnerCode = $partnerCode;
                            $accessKey = $accessKey;
                            $serectkey = $secretKey;
                            $orderId = $orderId; // Mã đơn hàng
                            $orderInfo = $orderInfo;
                            $amount = $amount;
                            $ipnUrl = $ipnUrl;
                            $redirectUrl = $redirectUrl;
                            $extraData = $extraData;

                            $requestId = time() . "";
                            $requestType = "payWithATM";
                            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
                            //before sign HMAC SHA256 signature
                            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
                            $signature = hash_hmac("sha256", $rawHash, $serectkey);
                            $data = array(
                                'partnerCode' => $partnerCode,
                                'partnerName' => "Test",
                                "storeId" => "MomoTestStore",
                                'requestId' => $requestId,
                                'amount' => $amount,
                                'orderId' => $orderId,
                                'orderInfo' => $orderInfo,
                                'redirectUrl' => $redirectUrl,
                                'ipnUrl' => $ipnUrl,
                                'lang' => 'vi',
                                'extraData' => $extraData,
                                'requestType' => $requestType,
                                'signature' => $signature
                            );
                            $result = execPostRequest($endpoint, json_encode($data));
                            $jsonResult = json_decode($result, true);  // decode json
                            var_dump($jsonResult);

                            if (isset($jsonResult['payUrl']) && !empty($jsonResult['payUrl'])) {
                                // `payUrl` tồn tại và không trống
                                // Sau khi thêm vào chi tiết hóa đơn, bạn có thể xóa session cart
                                $_SESSION['mycart'] = [];
                                header('Location: ' . $jsonResult['payUrl']);
                                exit; // Đảm bảo kết thúc script sau khi chuyển hướng
                            } else {
                                // `payUrl` không tồn tại hoặc trống
                                echo "Lỗi: Không tìm thấy payUrl.";
                            }
                        }
                    } else {
                        $bill = $carts->loadone_billDetail($idbill);
                        // Chuyển hướng đến trang invoice.php
                        $_SESSION['mycart'] = [];

                        include "view/invoice.php";
                    }
                    $title = "Đặt hàng Nest Mart & Gorcery";
                    $content = "
                    <div>
                    <p>Cảm ơn quý khách đã đặt hàng với mã đơn hàng là: DH " . $idbill . "</p>
                    <p></p>
                    </div>";
                    $adddressMail = $_SESSION['user']['email'];
                    $mail->sendMail($title, $content, $adddressMail);
                    // Bắt và loại bỏ đầu ra
                    // ob_get_clean();
                } else {
                    echo "Yêu cầu không hợp lệ";
                }
            }
            break;
        case 'contact':
            include "view/contact.php";
            break;
        case 'account':
            $donhang = new cart();
            $listdh = $donhang->loadall_donhang($_SESSION['user']['id']);
            include "view/account.php";
            break;
        case 'updateAccount':
            $user = new user();
            if (isset($_GET['id']) && ($_GET['id']) > 0) {
                $taikhoan = $user->loadone_taikhoan($_GET['id']);
            }
            include "view/account.php";
            break;
        case 'updateAccountUser':
            $user = new user();
            if (isset($_POST['updateAccountUser']) && ($_POST['updateAccountUser'])) {
                $id = $_POST['id'];
                // $name = $_POST['name'];
                $newEmail = $_POST['email'];
                if ($user->checkUserUpdate($newEmail, $name)) {
                    $thongbao = "Email already exists, please select another email";
                    include 'view/account.php';
                } else {
                    // $pass = $_POST['pass'];
                    $address = $_POST['address'];
                    $phone = $_POST['phone'];
                    $role = 0;
                    $user->update_taikhoan($id, $newEmail, $address, $phone, $role);
                    $_SESSION['user'] =  $user->checkUserOne($name, $pass);
                    $thongbao = "Cập nhật thành công";
                    header('location: index.php?act=account');
                }
            }
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

                // Kiểm tra username và email đã tồn tại hay không
                if ($register->checkUserUpdate($email, $name)) {
                    $thongbao = "Username or email already exists. Please select other information..";
                } else {
                    // Nếu không trùng lặp, thêm tài khoản mới
                    $registers = $register->insert_taikhoan($name, $email, $pass, $address, $phone);
                    $thongbao = "Đã đăng ký thành công. Vui lòng đăng nhập.";
                    header("Location: index.php?act=login_google");
                }
            }
            include "view/register.php";
            break;
        case 'forgot_password':
            $forgot_password = new user();
            $user = new user();
            include "view/forgot_password.php";
            break;
        case 'validate':
            include "view/validate.php";
            break;
        case 'reset_pass':
            $forgot_password = new user();
            $user = new user();
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
            if (isset($_POST['iddm']) && ($_POST['iddm'] > 0)) {
                $iddm = $_POST['iddm'];
            } else {
                $iddm = 0;
            }
            if (isset($_GET['iddm']) && ($_GET['iddm'] > 0)) {
                $iddm = $_GET['iddm'];
            } else {
                $iddm = 0;
            }
            $kytu = isset($_GET['kytu']) ? $_GET['kytu'] : "";
            $delete = 0;

            $dssp = $search->loadall_tksanpham($kyw, $kytu, $iddm, $delete);

            include "view/search.php";
            break;
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
        case 'login':
            include "view/login.php";
            break;
        case 'login_google':
            $login = new user();
            if (isset($_POST['login']) && ($_POST['login'])) {
                $name = $_POST['name'];
                $pass = $_POST['pass'];
                $checkuser = $login->checkUsersClient($name, $pass);

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
