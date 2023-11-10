<?php
session_start();
ob_start();
include ("../model/global.php");
include '../model/pdo.php';
include '../model/user.php';
include '../model/banner.php';
include '../model/category.php';
include '../model/product.php';
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
                if(isset($_POST['addbn'])){
                    // lấy dữ liệu về 
                   $title=$_POST['title'];
                   $subtitle=$_POST['subtitle'];
                   $img=$_FILES['img']['name'];

                    //insert into
                    $banner = new banner();
                    $listbanner = $banner->banner_insert($img, $title, $subtitle);
                    
    
                    // uploads hình ảnh
                    $target_file=IMG_PATH_ADMIN.$img;
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    
                    //trở về trang dsbn
                    $banner = new banner();
                    $listbanner = $banner->loadall_banner();
                    include "banner/list.php";
                }else{
                    include "banner/add.php";
                }
                break;
            case 'listbn':
                $banner = new banner();
                $listbanner = $banner->loadall_banner();
                include "banner/list.php";
                break;
            case 'updatebn':
                $banner = new banner();
                
                if(isset($_GET['id'])&&($_GET['id']>0)){
                    $onebanner=$banner->loadone_banner($_GET['id']);
                }
                $listbanner = $banner->loadall_banner();
                // trở về trang danh sách banner
                include "banner/update.php";
                break;
            case 'update_banner':
                $banner = new banner();
                if(isset($_POST['updatebn'])&&($_POST['updatebn'])){
                    $id=$_POST['id'];
                    $title=$_POST['title'];
                    $subtitle=$_POST['subtitle'];
                    $img=$_FILES['img']['name'];
                     // uploads hình ảnh
                     $target_file=IMG_PATH_ADMIN.$img;
                     move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                     $banner->update_banner( $id, $title, $subtitle, $img);
                     
                }
                $listbanner = $banner->loadall_banner();
                include 'banner/list.php';
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
                $categories = $category->status_danhmuc($delete);
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
                $status = 0;
                $categories = $category->status_danhmuc($status);
                include "danhmuc/list.php";
                break;
            case 'addsp':
                $products = new products();
                $category = new category();
                if (isset($_POST['themmoi']) && ($_POST['themmoi'])) {
                    $iddm = $_POST['iddm'];
                    $tensp = $_POST['tensp'];
                    $giasp = $_POST['giasp'];
                    $mota = $_POST['mota'];

                    if (isset($_FILES['hinh']['name']) && !empty($_FILES['hinh']['name'][0])) {
                        $images = $_FILES['hinh']['name'];
                        $target_dir = "../upload/";
                        $target_file = $target_dir . basename($_FILES["hinh"]["name"][0]);
                        foreach ($images as $key => $image) {
                            $target_file = $target_dir . basename($image);
                            if (move_uploaded_file($_FILES["hinh"]["tmp_name"][$key], $target_file)) {
                                // File uploaded successfully
                            } else {
                                // Error uploading file
                            }
                        }
                    }

                    $images = $_FILES['hinh']['name'];
                    $products->insert_sanpham($tensp, $giasp, $mota, $iddm, $images);
                    $thongbao = "Thêm thành công";
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
                $categories = $category->loadall_danhmuc();
                $productsList = $loadedProducts->loadall_sanpham($kyw, $iddm);

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
                $productsList = $loadedProducts->loadall_sanpham("", 0);
                include "sanpham/list.php";
                break;
            case 'list_delete_history':
                $category = new category();
                $delete = 1;
                $categories = $category->status_danhmuc($delete);
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
                    $category->delete_danhmuc($_GET['id']);
                }
                $sql = "SELECT * FROM category order by id desc";
                $delete = 1;
                $categories = $category->status_danhmuc($delete);
                include "danhmuc/delete.php";
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
