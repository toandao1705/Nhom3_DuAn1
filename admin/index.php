<?php
session_start();
ob_start();
include("../model/global.php");
include '../model/pdo.php';
include '../model/user.php';
include '../model/banner.php';
include '../model/category.php';
include '../model/product.php';
include '../model/comment.php';
include '../model/cart.php';
$act = 'home';
if (isset($_SESSION['admin'])) {
    // Nếu đã đăng nhập, bao gồm header, footer và sidebar
    include "component/header.php";
    //controller
    if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
                // case 'addbn':
                //     include "banner/add.php";
                //     break;
            case 'addbn':
                if (isset($_POST['addbn'])) {
                    // lấy dữ liệu về 
                    $title = $_POST['title'];
                    $subtitle = $_POST['subtitle'];
                    $img = $_FILES['img']['name'];

                    //insert into
                    $banner = new banner();
                    $listbanner = $banner->banner_insert($img, $title, $subtitle);


                    // uploads hình ảnh
                    $target_file = IMG_PATH_ADMIN . $img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

                    //trở về trang dsbn
                    $banner = new banner();
                    $delete = 0;
                    $listbanner = $banner->loadall_banner($delete);
                    include "banner/list.php";
                } else {
                    include "banner/add.php";
                }
                break;
            case 'listbn':
                $banner = new banner();
                $delete = 0;
                $listbanner = $banner->loadall_banner($delete);
                include "banner/list.php";
                break;
            case 'updatebn':
                $banner = new banner();

                if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                    $onebanner = $banner->loadone_banner($_GET['id']);
                }
                $listbanner = $banner->loadall_banner($delete);
                // trở về trang danh sách banner
                include "banner/update.php";
                break;
            case 'update_banner':
                $banner = new banner();
                if (isset($_POST['updatebn']) && ($_POST['updatebn'])) {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $subtitle = $_POST['subtitle'];
                    $img = $_FILES['img']['name'];
                    // uploads hình ảnh
                    $target_file = IMG_PATH_ADMIN . $img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                    $banner->update_banner($id, $title, $subtitle, $img);
                }
                $delete = 0;
                $listbanner = $banner->loadall_banner($delete);
                include 'banner/list.php';
                break;
            case 'list_delete_history_banner':
                $banner = new banner();
                $delete = 1;
                $listbanner = $banner->loadall_banner($delete);
                include "banner/delete.php";
                break;
            case 'restorebn':
                $banner = new banner();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $banner->restore_banner($id);
                }
                header('location: index.php?act=list_delete_history_banner');
                break;
            case 'delete_hidden_banner':
                $banner = new banner();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $banner->delete_hidden_banner($id);
                }
                header('location: index.php?act=listbn');
                break;
            case 'deletebn':
                $banner = new banner();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $banner->delete_banner($_GET['id']);
                }
                $sql = "SELECT * FROM banner order by id desc";
                $delete = 1;
                $listbanner = $banner->loadall_banner($delete);
                include "banner/delete.php";
                break;
            case 'adddm':
                $category = new category();
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $tenloai = $_POST['tenloai'];
                    $categories = $category->insert_danhmuc($tenloai);
                    $thongbao = "Thêm danh mục thành công";
                }
                include "danhmuc/add.php";
                break;
            case 'listdm':
                $category = new category();
                $delete = 0;

                //Đặt số lượng bản ghi trên mỗi trang
                $limit = 5;

                // Lấy số trang hiện tại từ URL
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Tính điểm bắt đầu để tìm nạp bản ghi
                $start = ($page - 1) * $limit;

                // Tìm nạp danh mục cho trang hiện tại
                $categories = $category->status_danhmuc($delete, $start, $limit);

                // Đếm tổng số bản ghi
                $totalCategories = count($category->status_danhmuc($delete, 0, PHP_INT_MAX));

                // Tính tổng số trang
                $totalPages = ceil($totalCategories / $limit);

                include "danhmuc/list.php";
                break;

            case 'updatedm':
                $category = new category();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $categories = $category->loadone_danhmuc($_GET['id']);
                }
                include "danhmuc/update.php";
                break;
            case 'update_category':
                $category = new category();
                if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                    $tenloai = $_POST['tenloai'];
                    $id = $_POST['id'];
                    $category->update_danhmuc($id, $tenloai);
                }
                $sql = "SELECT * FROM category ORDER BY id DESC";
                $delete = 0;
                header('location: index.php?act=listdm');
                break;
            case 'addsp':
                $products = new products();
                $category = new category();
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $iddm = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $giasp = $_POST['giasp'];
                    $mota = $_POST['mota'];

                    // Kiểm tra xem đã tải lên hình ảnh hay chưa
                    if (isset($_FILES['hinh']['name']) && !empty($_FILES['hinh']['name'][0])) {
                        $images = $_FILES['hinh']['name'];
                        $target_dir = "../upload/";

                        // Di chuyển tất cả hình ảnh vào thư mục đích
                        $targetFiles = [];
                        foreach ($images as $key => $image) {
                            $targetFiles[] = $target_dir . basename($image);
                            if (move_uploaded_file($_FILES["hinh"]["tmp_name"][$key], $targetFiles[$key])) {
                                // File uploaded successfully
                            } else {
                                // Error uploading file
                                die('Error uploading file');
                            }
                        }

                        // Chèn sản phẩm chỉ khi có hình ảnh
                        $products->insert_sanpham($tensp, $giasp, $mota, $iddm, $targetFiles);
                        $thongbao = "Thêm thành công";
                    } else {
                        $thongbao = "Thêm không thành công vì không có hình ảnh";
                    }
                }

                $categories = $category->loadall_danhmuc();
                include "sanpham/add.php";
                break;
            case 'listsp':
                $loadedProducts = new products();
                $category = new category();
                if (isset($_POST['listok']) && ($_POST['listok'])) {
                    $kyw = $_POST['kyw'];
                    $iddm = $_POST['iddm'];
                } else {
                    $kyw = '';
                    $iddm = 0;
                }
                $delete = 0;
                $categories = $category->loadall_danhmuc();
                $productsList = $loadedProducts->loadall_sanpham($kyw, $iddm, $delete);

                include "sanpham/list.php";
                break;
            case 'updatesp':
                $loadedProducts = new products();
                $category = new category();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $product = $loadedProducts->loadone_sanpham($_GET['id']);
                }
                $categories = $category->loadall_danhmuc();
                include "sanpham/update.php";
                break;
            case 'update_product':
                $loadedProducts = new products();
                $category = new category();
                if (isset($_POST['capnhat']) && ($_POST['capnhat'])) {
                    $id = $_POST['id'];
                    $id_category = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $giasp = $_POST['giasp'];
                    $mota = $_POST['mota'];
                    // ...
                    $images = $_FILES['hinh']['name'];
                    $target_dir = "../upload/";
                    if (isset($_FILES['hinh']['name']) && !empty($_FILES['hinh']['name'][0])) {


                        foreach ($images as $key => $image) {
                            $target_file = $target_dir . basename($image);

                            if (move_uploaded_file($_FILES["hinh"]["tmp_name"][$key], $target_file)) {
                                // File uploaded successfully
                            } else {
                                // Error uploading file
                            }
                        }

                        // Truyền đường dẫn của hình ảnh vào hàm update_sanpham

                    }
                    // ...
                    $loadedProducts->update_sanpham($id, $id_category, $tensp, $giasp, $mota, $images);
                    $thongbao = "Cập nhật thành công";
                }
                // $sql="SELECT * FROM sanpham order by id desc";
                $productsList = $loadedProducts->loadall_sanpham("", 0, "");
                include "sanpham/list.php";
                break;
            case 'list_delete_history':
                $category = new category();
                $delete = 1;
                // Đặt số lượng bản ghi trên mỗi trang
                $limit = 5;

                // Lấy số trang hiện tại từ URL
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                //Tính điểm bắt đầu để tìm nạp bản ghi
                $start = ($page - 1) * $limit;

                // Tìm nạp danh mục cho trang hiện tại
                $categories = $category->status_danhmuc($delete, $start, $limit);

                // Đếm tổng số bản ghi
                $totalCategories = count($category->status_danhmuc($delete, 0, PHP_INT_MAX));

                // Tính tổng số trang
                $totalPages = ceil($totalCategories / $limit);
                include "danhmuc/delete.php";
                break;
            case 'delete_hidden':
                $category = new category();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $category->delete_hidden($id);
                }
                header('location: index.php?act=listdm');
                break;
            case 'restoredm':
                $category = new category();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $category->restore_danhmuc($id);
                }
                header('location: index.php?act=list_delete_history');
                break;
            case 'deletedm':
                $category = new category();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $deleted = $category->delete_danhmuc($_GET['id']);
                    if (!$deleted) {
                        // Hiển thị một thông báo lỗi thân thiện với người dùng
                        $error_message = "Không thể xóa danh mục vì có sản phẩm liên quan.";
                    }
                }
                $sql = "SELECT * FROM category ORDER BY id DESC";
                $delete = 1;
                $categories = $category->status_danhmuc($delete, '', '');
                include "danhmuc/delete.php";
                break;



            case 'delete_hidden_sanpham':
                $products = new products();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $products->delete_hidden_sanpham($id);
                }
                header('location: index.php?act=listsp');
                break;
            case 'list_delete_history_sanpham':
                $loadedProducts = new products();
                $category = new category();
                $delete = 1;
                $categories = $category->loadall_danhmuc();
                $productsList = $loadedProducts->loadall_sanpham("", "", $delete);
                include "sanpham/delete.php";
                break;
            case 'restoresp':
                $loadedProducts = new products();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $loadedProducts->restore_sanpham($id);
                }
                header('location: index.php?act=list_delete_history_sanpham');
                break;
            case 'deletesp':
                $loadedProducts = new products();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $loadedProducts->delete_sanpham($_GET['id']);
                }
                $sql = "SELECT * FROM products order by id desc";
                $delete = 1;
                $productsList = $loadedProducts->loadall_sanpham("", "", $delete);
                include "sanpham/delete.php";
                break;
            case 'listtk':
                $taikhoan = new user();
                $listtk = $taikhoan->loadall_taikhoan();
                include "taikhoan/list.php";
                break;
            case 'updatetk':
                include "taikhoan/update.php";
                break;
            case 'listbl':
                $binhluan = new comment();
                $listbl = $binhluan->loadall_binhluan();
                include "binhluan/list.php";
                break;
            case 'listdh':
                $donhang = new cart();
                $listdh = $donhang->loadall_donhang();
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
    // Nếu chưa đăng nhập, chỉ hiển thị trang đăng nhập
    $user = new user();

    // Khai báo hai biến username và password lấy từ input
    $name = $_POST['name'] ?? '';
    $pass = $_POST['pass'] ?? '';

    // Mã hóa mật khẩu theo kiểu MD5
    $hashedPassword = md5($pass);

    if ($user->checkUser($name, $hashedPassword)) {
        $result = $user->userid($name, $hashedPassword);
        $_SESSION['admin'] = $name; // kiểm tra có người dùng hay không
    }

    include "dangnhap/login.php";
}
