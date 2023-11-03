<?php
include "component/header.php";

    //controller

    if(isset($_GET['act'])){
        $act=$_GET['act'];
        switch($act){
            case 'adddm' : 
                include "danhmuc/add.php";
                break;
            case 'listdm' : 
                include "danhmuc/list.php";
                break;
            case 'updatedm' : 
                include "danhmuc/update.php";
                break;
            case 'addsp' : 
                include "sanpham/add.php";
                break;
            case 'listsp' : 
                include "sanpham/list.php";
                break;
            case 'updatesp' : 
                include "sanpham/update.php";
                break;
            case 'listtk' : 
                include "taikhoan/list.php";
                break;
            case 'updatetk' : 
                include "taikhoan/update.php";
                break;
            case 'listbl' : 
                include "binhluan/list.php";
                break;
            case 'listdh' : 
                include "donhang/list.php";
                break;
            case 'listthongke' : 
                include "thongke/thongke.php";
                break;
            default:
            include "home.php";
            break;
        }
    }else{
        include "home.php";
    }
    
include "component/sidebar.php";
include "component/footer.php";
?>