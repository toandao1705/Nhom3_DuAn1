<?php
session_start();
ob_start();
include '../model/comment.php';
include '../model/pdo.php';
include "../model/user.php";
$user = new user();
$delete = 0;
$user = $user->loadall_taikhoan($delete, 0, 0);
$id_pro = $_REQUEST['id_pro'];
// $id_user = $_SESSION['user']['id'];
$comment  = new comment();
$delete = 0;
$dsbl = $comment->loadall_binhluan($id_pro, $delete, 0, PHP_INT_MAX);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="view/assets/imgs/theme/favicon.svg" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="view/assets/css/main.css?v=5.6" />
    <!-- Deals -->
    <link rel="stylesheet" href="view/assets/css/plugins/slider-range.css" />
    <!--leaflet map-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-..." crossorigin="anonymous">

</head>
<style>
    .clamp-text {
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
        -webkit-line-clamp: 3;
        /* Số dòng bạn muốn hiển thị */
    }

    .btn-light {
    background-color: white;
    color: black;
    }

    .btn-light:hover,
    .btn-light:focus {
        background-color: white;
        color: black;
        box-shadow: none;
    }

    .dropdown-menu {
    margin-top: -70px;
    margin-left: -50px;
    }

    .dropdown-item {
        margin: 0;
        padding: 5px 10px;
    }
</style>

<body>
    <div class="comment-list">
        <div class="single-comment ">
            <?php

            if (isset($_SESSION['user'])) {
            $commentCount = 0;
                foreach ($dsbl as $bl) {
                    extract($bl);
                    $suabl = "index.php?act=product_full&idsp='.$id_pro.'&id=" . $id;
                    $xoabl = "index.php?act=product_full&idsp='.$id_pro.'&id=" . $id;
                    $reportbl = "index.php?act=product_full&idsp='.$id_pro.'&id=" . $id;
                    echo '
                <div class="single-comment justify-content-between d-flex mb-30">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb text-center">
                            <img src="view/assets/imgs/blog/author-2.png" alt="" />
                            <a href="#" class="font-heading text-brand">' . $username . '</a>
                        </div>
                        <div class="desc" style="width: 100%;">
                            <div class="d-flex justify-content-between mb-10">
                                <div class="d-flex align-items-center">
                                    <span class="font-xs text-muted">' . $comment_date . '</span>
                                </div>
                            </div>
                            <div>
                                <p class="mb-10 clamp-text">' . wordwrap($content, 105, "<br>", true) . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="user justify-content-between d-flex">
                        <div class="dropdown">
                        <button class="btn btn-light border-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href=""'.$suabl.'"">Chỉnh sửa</a>
                        <a class="dropdown-item" href="'.$xoabl.'">Xóa</a>
                        <a class="dropdown-item" href=""'.$reportbl.'"">Báo cáo</a>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>';
                    $commentCount++;
                    if ($commentCount >= 3) {
                        break;
                    }
                }
            } else {
                $commentCount = 0;
                foreach ($dsbl as $bl) {
                extract($bl);
                echo '
                <div class="single-comment justify-content-between d-flex mb-30">
                    <div class="user justify-content-between d-flex">
                        <div class="thumb text-center">
                            <img src="view/assets/imgs/blog/author-2.png" alt="" />
                            <a href="#" class="font-heading text-brand">' . $username . '</a>
                        </div>
                        <div class="desc" style="width: 100%;">
                            <div class="d-flex justify-content-between mb-10">
                                <div class="d-flex align-items-center">
                                    <span class="font-xs text-muted">' . $comment_date . '</span>
                                </div>
                            </div>
                            <div>
                                <p class="mb-10 clamp-text">' . wordwrap($content, 105, "<br>", true) . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
            }}
            // Kiểm tra xem có bình luận hay không
            if ($commentCount === 0) {
                // Không có bình luận, hiển thị thông báo
                echo '<div class="no-comment">This product has no comments yet.</div>';
            }
            ?>
        </div>
    </div>
    <div class="comment-form">
        <h4 class="mb-15">Add a review</h4>
        <div class="product-rate d-inline-block mb-30"></div>
        <div class="row">

            <div class="col-lg-12 col-md-12">
                <?php
                if (isset($_SESSION['user'])) {
                ?>
                    <form class="form-contact comment_form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id_pro" value="<?= $id_pro ?>">
                                <input style="background-color: #3bb77e;" type="submit" class="button button-contactForm" name="submitComment" value="Submit Review">
                            </div>
                        </div>


                    </form>
                    <!-- Xử lý khi submit form -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitComment'])) {
                        $content = $_POST['content'];
                        $id_pro = $_POST['id_pro'];
                        $id_user = $_SESSION['user']['id'];
                        $comment_date = date('h:i:sa d/m/Y');
                        $comment->insert_binhluan($content, $id_user, $id_pro, $comment_date);
                        // Redirect sau khi thêm bình luận
                        header("location:" . $_SERVER['HTTP_REFERER']);
                    }
                    ?>

                    <!-- Kết thúc form nhập liệu -->
                <?php
                } else if (isset($_SESSION['login_id'])) {
                ?>
                    <form class="form-contact comment_form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <textarea class="form-control w-100" name="content" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id_pro" value="<?= $id_pro ?>">
                                <input style="background-color: #3bb77e;" type="submit" class="button button-contactForm" name="submitComment" value="Submit Review">
                            </div>
                        </div>


                    </form>
                    <!-- Xử lý khi submit form -->
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitComment'])) {
                        $content = $_POST['content'];
                        $id_pro = $_POST['id_pro'];
                        $id_user = $_SESSION['user']['id'];
                        $comment_date = date('h:i:sa d/m/Y');
                        $comment->insert_binhluan($content, $id_user, $id_pro, $comment_date);
                        // Redirect sau khi thêm bình luận
                        header("location:" . $_SERVER['HTTP_REFERER']);
                    }
                    ?>

                    <!-- Kết thúc form nhập liệu -->
                <?php
                } else {
                ?>
                    <p>please log in</p>

                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Vendor JS-->
    <script src="view/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="view/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="view/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="view/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="view/assets/js/plugins/slick.js"></script>
    <script src="view/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="view/assets/js/plugins/wow.js"></script>
    <script src="view/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="view/assets/js/plugins/magnific-popup.js"></script>
    <script src="view/assets/js/plugins/select2.min.js"></script>
    <script src="view/assets/js/plugins/waypoints.js"></script>
    <script src="view/assets/js/plugins/counterup.js"></script>
    <script src="view/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="view/assets/js/plugins/images-loaded.js"></script>
    <script src="view/assets/js/plugins/isotope.js"></script>
    <script src="view/assets/js/plugins/scrollup.js"></script>
    <script src="view/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="view/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="view/assets/js/plugins/jquery.elevatezoom.js"></script>
    <script src="view/assets/js/plugins/leaflet.js"></script>
    <!-- Template  JS -->
    <script src="./view/assets/js/main.js?v=5.6"></script>
    <script src="./view/assets/js/shop.js?v=5.6"></script>
    <script>
        var dropdownButton = document.getElementById('dropdownMenuButton');
        var dropdownMenu = document.querySelector('.dropdown-menu');

        dropdownButton.addEventListener('click', function() {
            dropdownMenu.classList.toggle('show');
        });
        </script>
</body>

</html>