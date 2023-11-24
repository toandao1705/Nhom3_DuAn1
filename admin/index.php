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
include '../model/statistical.php';

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
                    $thongbao = "Thêm banner thành công";
                
                }
                include "banner/add.php";
                
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
                $delete = 0;
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
                $thongbao = "";
            
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $tenloai = $_POST['tenloai'];
                    try {
                        $insertResult = $category->insert_danhmuc($tenloai);
                        $thongbao = "Thêm danh mục thành công";
                    } catch (Exception $e) {
                        $errorCode = $e->getCode();
                        if ($errorCode == 23000) {
                            // Mã lỗi 23000 thường là lỗi ràng buộc duy nhất (unique constraint)
                            $thongbaoloi = "Danh mục đã tồn tại.";
                        } else {
                            $thongbaoloi = $e->getMessage();
                        }
                    }
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
                $status = 0;
                $categories = $category->loadall_danhmuc($status);
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
                $status = 0;
                $categories = $category->loadall_danhmuc($status);
                $productsList = $loadedProducts->loadall_sanpham($kyw, $iddm, $delete);

                include "sanpham/list.php";
                break;
            case 'updatesp':
                $loadedProducts = new products();
                $category = new category();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $product = $loadedProducts->loadone_sanpham($_GET['id']);
                }
                $status=0;
                $categories = $category->loadall_danhmuc($status);
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
                $status = 0;
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
                $totalPages = 0;
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
                $categories = $category->status_danhmuc($delete, 0, 0);
                header('location: index.php?act=list_delete_history');
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
                $delete=0;
                $listtk = $taikhoan->loadall_taikhoan($delete);
                include "taikhoan/list.php";
                break;
            case 'delete_hidden_taikhoan':
                $user = new user();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $user->delete_hidden_taikhoan($id);
                }
                header('location: index.php?act=listtk');
                break;
            case 'list_delete_history_taikhoan':
                $user = new user();
                $delete = 1;
                $users = $user->loadall_taikhoan($delete);
                include "taikhoan/delete.php";
                break;
            case 'restoretk':
                $user = new user();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $user->restore_taikhoan($id);
                }
                header('location: index.php?act=list_delete_history_taikhoan');
                break;
            case 'deletetk':
                $user = new user();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $user->delete_taikhoan($_GET['id']);
                }
                $sql = "SELECT * FROM user order by id desc";
                $delete = 1;
                $users = $user->loadall_taikhoan($delete);
                include "taikhoan/delete.php";
                break;
            case 'suatk':
                $user = new user();
                if(isset($_GET['id'])&&($_GET['id'])>0){
                    $taikhoan=$user->loadone_taikhoan($_GET['id']);
                }
                $delete = 0;
                $listtaikhoan=$user->loadall_taikhoan($delete);
                include "taikhoan/update.php";
                break;
            case 'updatetk':
                $user = new user();
                if(isset($_POST['capnhat'])&&($_POST['capnhat'])){
                    $id=$_POST['id'];
                    $email=$_POST['email'];
                    $pass=$_POST['pass'];
                    $address=$_POST['address'];
                    $phone=$_POST['phone'];
                    $user->update_taikhoan($id, $email, $pass, $address, $phone);
                    $thongbao = "Cập nhật thành công";
                }
                header('location: index.php?act=listtk');
                break;
            case 'listbl':
                $binhluan = new comment();
                $delete = 0;
                $listbl = $binhluan->loadall_binhluan(0, $delete);
                include "binhluan/list.php";
                break;
            case 'delete_hidden_binhluan':
                $comment = new comment();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $comment->delete_hidden_binhluan($id);
                }
                header('location: index.php?act=listbl');
                break;
            case 'list_delete_history_binhluan':
                $comment = new comment();
                $delete = 1;
                $listbl = $comment->loadall_binhluan(0,$delete);
                include "binhluan/delete.php";
                break;
            case 'restorebl':
                $comment = new comment();
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $comment->restore_binhluan($id);
                }
                header('location: index.php?act=list_delete_history_binhluan');
                break;
            case 'deletebl':
                $comment = new comment();
                if (isset($_GET['id']) && ($_GET['id']) > 0) {
                    $comment->delete_binhluan($_GET['id']);
                }
                $sql = "SELECT * FROM comment order by id desc";
                $delete = 1;
                $listbl = $comment->loadall_binhluan('',$delete);
                include "binhluan/delete.php";
                break;
            case 'listdh':
                $donhang = new cart();
                $listdh = $donhang->loadall_donhang();
                include "donhang/list.php";
                break;
            case 'listthongke':
                $thongke = new statistical();
                $listthongke = $thongke->loadall_thongke();
                include "thongke/thongke.php";
                break;
            case 'bieudo':
                $thongke = new statistical();
                $listthongke = $thongke->loadall_thongke();
                include "thongke/bieudo.php";
                break;
            case 'listthongkebl':
                $thongkebl = new statistical();
                $listthongkebl = $thongkebl->loadall_thongkebl();
                include "thongke/thongkebl.php";
                break;
            case 'bieudobl':
                $thongkebl = new statistical();
                $listthongkebl = $thongkebl->loadall_thongkebl();
                include "thongke/bieudobl.php";
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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'] ?? '';
        $pass = $_POST['pass'] ?? '';
        
        // Mã hóa mật khẩu theo kiểu MD5
        $hashedPassword = md5($pass);
    
        if ($user->checkUser($name, $hashedPassword)) {
            $result = $user->userid($name, $hashedPassword);
            $_SESSION['admin'] = $name; // kiểm tra có người dùng hay không
            header("Location: index.php"); // Redirect to the dashboard or any other page
            exit();
        } else {
            $loginError = "Tên hoặc mật khẩu không đúng. Vui lòng thử lại.";
        }
    }

    include "dangnhap/login.php";
}