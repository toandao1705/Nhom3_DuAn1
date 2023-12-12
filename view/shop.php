<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">Shop</h1>
                        <div class="breadcrumb">
                            <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span>&emsp;Shop</span> 
                        </div>
                    </div>
                    <div class="col-xl-9 text-end d-none d-xl-block">
                        <ul class="tags-list">
                            <?php
                            if (!empty($categories)) {
                                $count = 0; // Đếm số lượng danh mục đã hiển thị
                                foreach ($categories as $category) {
                                    extract($category);
                                    echo '<li class="hover-up">
                                    <a href="index.php?act=search&iddm='.$category['id']. '">' . $category['name'] . '</a>
                                    </li>';
                                    $count++;
                                    if ($count >= 5) {
                                        break; // Thoát khỏi vòng lặp sau khi hiển thị 5 danh mục
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="row">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <?php
                    $countsp = 0;
                    $displayedProducts = array();
                    foreach ($spnew as $sp) {
                        extract($sp);
                        if (!in_array($id, $displayedProducts)) {
                            $displayedProducts[] = $id; // Thêm ID vào mảng
                        $countsp++;}
                    }
                    ?>
                    <div class="totall-product">
                        <p>We found <strong class="text-brand"><?= $countsp ?></strong> items for you!</p>
                    </div>
                </div>
                <div class="row product-grid">
                <style>
                input.add {
                    width: 85px;
                    height: 36px;
                    color: #3BB77E;
                }
                </style>
                    <?php
                    // Mảng để lưu ID của các sản phẩm đã được hiển thị
                    $displayedProducts = array();

                    foreach ($spnew as $sp) {
                        extract($sp);

                        // Kiểm tra xem sản phẩm đã được hiển thị chưa
                        if (!in_array($id, $displayedProducts)) {
                            $displayedProducts[] = $id; // Thêm ID vào mảng

                            $linksp = "index.php?act=product_full&idsp=" . $id;
                            echo '
                                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">';
                    ?>
                            <?php
                            // Di chuyển vòng lặp hình ảnh ra khỏi vòng lặp sản phẩm
                            $imgPath = $img_path . $img;
                            ?>
                            <a href="<?= $linksp ?>">
                                <img class="default-img" src="<?php echo $imgPath; ?>" style="width:181.82px; height:181.82px;" />
                            </a>
                    <?php
                            echo '
                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="hot">Hot</span>
                        </div>
                        </div>
                        <div class="product-content-wrap">
                        <div class="product-category">
                            <a href="shop-grid-right.php">' . $category_name . '</a>
                        </div>
                        <h2><a href="' . $linksp . '">' . $name . '</a></h2>
                        <div class="product-rate-cover">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 80%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted">3.5</span>
                        </div>
                        <div>
                            <span class="font-small text-muted">By <a  href="vendor-details-1.php"> ' . $category_name . ' </a></span>
                        </div>
                        <div class="product-card-bottom">
                            <div class="product-price">
                                <span>$' . $price . '</span>
                            </div>
                            <div class="add-cart">
                            <form action="index.php?act=addtocart" method="post">
                            <input type="hidden" name="id" value="' . $id . '">
                            <input type="hidden" name="name" value="' . $name . '">
                            <input type="hidden" name="img" value="' . $imgPath . '">
                            <input type="hidden" name="price" value="' . $price . '">
                            <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                            <input type="submit" class="add" name="addtocart" onclick="addToCart()" value="Add">
                        </form>
                            </div>
                        </div>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                    }
                    ?>
                </div>
                <?php
                    echo '<div class="pagination-area mt-20 mb-20">';
                    echo '<nav aria-label="Page navigation example">';
                    echo '<ul class="pagination justify-content-start">';

                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="index.php?act=shop&page=' . ($page - 1) . '"><i class="fi-rs-arrow-small-left"></i></a></li>';
                    }

                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item' . ($page == $i ? ' active' : '') . '"><a class="page-link" href="index.php?act=shop&page=' . $i . '">' . $i . '</a></li>';
                    }

                    if ($page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="index.php?act=shop&page=' . ($page + 1) . '"><i class="fi-rs-arrow-small-right"></i></a></li>';
                    }

                    echo '</ul>';
                    echo '</nav>';
                    echo '</div>';
                    ?>
                <section class="section-padding pb-5">
                    <div class="section-title">
                        <h3 class="">Deals Of The Day</h3>
                        <a class="show-all" href="index.php?act=search">
                            All Deals
                            <i class="fi-rs-angle-right"></i>
                        </a>
                    </div>
                    <div class="row">
                        <?php
                        // ảng để lưu ID của các sản phẩm đã được hiển thị
                        $displayedProducts = array();
                        foreach ($sp_deals as $deals) {
                            extract($deals);

                            // Kiểm tra xem sản phẩm đã được hiển thị chưa
                            if (!in_array($id, $displayedProducts)) {
                                $displayedProducts[] = $id; // Thêm ID vào mảng

                                $linksp = "index.php?act=product_full&idsp=" . $id;
                                echo '
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="product-cart-wrap style-2">
                        <div class="product-img-action-wrap">
                            <div class="product-img">
                                <a href="' . $linksp . '">';
                        ?>
                                <?php
                                // Di chuyển vòng lặp hình ảnh ra khỏi vòng lặp sản phẩm
                                $imgPath = $img_path . $img;
                                ?>
                                <img src="<?= $imgPath ?>" style="width:378px; height:335px" alt="" />
                        <?php
                                echo '
                                </a>
                            </div>
                        </div>
                        <div class="product-content-wrap">
                            <div class="deals-countdown-wrap">
                                <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"></div>
                            </div>
                            <div class="deals-content">
                                <h2><a href="index.php?act=product_full">' . $name . '</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="vendor-details-1.php">' . $category_name . '</a></span>
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        <span>$' . $price . '</span>
                                    </div>
                                    <div class="add-cart">
                                    <form action="index.php?act=addtocart" method="post">
                                    <input type="hidden" name="id" value="' . $id . '">
                                    <input type="hidden" name="name" value="' . $name . '">
                                    <input type="hidden" name="img" value="' . $imgPath . '">
                                    <input type="hidden" name="price" value="' . $price . '">
                                    <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                    <input type="submit" class="add" name="addtocart" onclick="addToCart()" value="Add">
                                </form>
                                    </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>';
                            }
                        };
                        ?>
                    </div>
                </section>
                <!--End Deals-->
            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                    <?php
                        $imgdm = 0;
                        if (!empty($categories)) {
                            $count = 0; // Đếm số lượng danh mục đã hiển thị
                            foreach ($categories as $category) {
                                $imgdm++;
                                echo '
                                <li>
                                    <a href="index.php?act=search&iddm='.$category['id']. '">
                                        <img src="view/assets/imgs/theme/icons/category-' . $imgdm . '.svg" alt="" />' . $category['name'] . '
                                    </a>
                                    <span class="count">'.$category['product_count'].'</span>
                                </li>';
                                $count++;
                                if ($count >= 5) {
                                    break; // Thoát khỏi vòng lặp sau khi hiển thị 5 danh mục
                                }
                            }
                        }
                        ?>
                    </ul>
                </div>

                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    <?php
                        // Mảng để lưu ID của các sản phẩm đã được hiển thị
                        $displayedProducts = array();
                        // Biến đếm sản phẩm hiển thị
                        $displayedCount = 0;

                        foreach ($spnew as $sp) {
                            extract($sp);

                            // Kiểm tra xem đã hiển thị đủ 3 sản phẩm chưa
                            if ($displayedCount < 3 && !in_array($id, $displayedProducts)) {
                                $displayedProducts[] = $id; // Thêm ID vào mảng
                                $displayedCount++; // Tăng biến đếm

                                $linksp = "index.php?act=product_full&idsp=" . $id;
                                echo '
                                    <div class="single-post clearfix">
                                        <div class="image">';
                                // Di chuyển vòng lặp hình ảnh ra khỏi vòng lặp sản phẩm
                                $imgPath = $img_path . $img;
                                ?>
                                
                                    <img src="<?= $imgPath ?>" style="width:80px; height:80px" alt="#" />
                                <?php 
                                echo '
                                        </div>
                                        <div class="content pt-10">
                                            <h5><a href="shop-product-detail.php">'.$name.'</a></h5>
                                            <p class="price mb-0 mt-5">$'.$price.'</p>
                                            <div class="product-rate">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                        </div>
                                    </div>';
                            }
                        }
                        ?>
                </div>
                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="view/assets/imgs/banner/banner-11.png" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>