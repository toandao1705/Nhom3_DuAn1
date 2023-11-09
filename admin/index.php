
<?php
ob_start();
session_start();
include '../model/pdo.php';
include '../model/user.php';
include '../model/banner.php';
include '../model/category.php';
$act = 'home';
if (isset($_SESSION['admin'])) {
    // Nếu đã đăng nhập, bao gồm header, footer và sidebar
    include "component/header.php";
    //controller
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
            case 'addbn':
                include "banner/add.php";
                break;
            case 'listbn':
                $banner = new banner();
                $listbanner = $banner->loadall_banner();
                include "banner/list.php";
                break;
            case 'updatebn':
                include "banner/update.php";
                break;
            case 'adddm':
                include "danhmuc/add.php";
                break;
            case 'listdm':
                $category = new category();
                $categories = $category->loadall_danhmuc();
                include "danhmuc/list.php";
                break;
            case 'updatedm':
                include "danhmuc/update.php";
                break;
            case 'addsp':
                include "sanpham/add.php";
                break;
            case 'listsp':
                include "sanpham/list.php";
                break;
            case 'updatesp':
                include "sanpham/update.php";
                break;
            case 'listtk':
                include "taikhoan/list.php";
                break;
            case 'updatetk':
                include "taikhoan/update.php";
                break;
            case 'listbl':
                include "binhluan/list.php";
                break;
            case 'listdh':
                include "donhang/list.php";
                break;
            case 'listthongke':
                include "thongke/thongke.php";
                break;
            case 'logout':
                include "dangnhap/logout.php";
                break;
            default:
                include "home.php";
                break;
        }
    } else {
        include "home.php";
    }

    include "component/sidebar.php";
    include "component/footer.php";
} else {

    include "dangnhap/login.php";
    // Nếu chưa đăng nhập, chỉ hiển thị trang đăng nhập
    $user = new user();
    //khai bao hai bien username va password lay tu input
    $name = $_POST['name'] ?? '';
    $pass = $_POST['pass'] ?? '';

    if ($user->checkUser($name, $pass)) {
        $result = $user->userid($name, $pass);
        $_SESSION['admin'] = $name; // kiem tra coi co nguoi dung hay chua
    }
}
