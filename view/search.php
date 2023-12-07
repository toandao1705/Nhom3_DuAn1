<main class="main">
    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15"><?= $kyw ?></h1>
                        <div class="breadcrumb">
                            <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Shop <span></span>
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
                    foreach ($dssp as $sptk) {
                        extract($sptk);
                        if (!in_array($id, $displayedProducts)) {
                            $displayedProducts[] = $id; // Thêm ID vào mảng
                        $countsp++;}
                    }
                    ?>
                    <div class="totall-product">
                        <p>We found <strong class="text-brand"><?= $countsp ?></strong> items for you!</p>
                    </div>
                    <div class="sort-by-product-area">
                        <div class="sort-by-cover">
                        <form action="index.php?act=search" method="get" >
                        <select class="form-control select-filter" name="kytu" id="select-filter">
                            <option value="0">---Lọc theo---</option>
                            <option value="index.php?act=search&kytu=kasc">Characters: A to Z</option>
                            <option value="index.php?act=search&kytu=kdesc">Characters: Z to A</option>
                            <option value="index.php?act=search&kytu=pasc">Price: Low to High</option>
                            <option value="index.php?act=search&kytu=pdesc">Price: High to Low</option>
                        </select>
                        </form>
                        </div>
                    </div>
                </div>
                <div class="row product-grid">
                    <?php
                    // Mảng để lưu ID của các sản phẩm đã được hiển thị
                    $displayedProducts = array();
                    foreach ($dssp as $sptk) {
                        extract($sptk);
                        // Kiểm tra xem sản phẩm đã được hiển thị chưa
                        if (!in_array($id, $displayedProducts)) {
                            $displayedProducts[] = $id; // Thêm ID vào mảng

                            $linksp = "index.php?act=product_full&idsp=" . $id;
                            echo '
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="' . $linksp . '">'
                    ?>

                            <?php
                            // Di chuyển vòng lặp hình ảnh ra khỏi vòng lặp sản phẩm
                            $imgPath = $img_path . $img;
                            ?>
                            <img class="default-img" src="<?= $imgPath ?>" alt="" style="width:209.4px; height:209.4px;" />
                            <img class="hover-img" src="<?= $imgPath ?>" alt="" style="width:209.4px; height:209.4px;" />
                            <?php
                            ?>
                    <?php
                            echo '
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.php"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn" href="shop-compare.php"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                    </div>
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        <span class="hot">Hot</span>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a href="shop-grid-right.php">'.$category_name.'</a>
                                    </div>
                                    <h2><a href="index.php?act=product_full">'.$name.'</a></h2>
                                    <div class="product-rate-cover">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                    </div>
                                    <div>
                                        <span class="font-small text-muted">By <a href="vendor-details-1.php">'.$category_name.'</a></span>
                                    </div>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>$'.$price.'</span>
                                        </div>
                                        <div class="add-cart">
                                            <a class="add" href="shop-cart.php"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                    }
                    ?>
                    <!--end product card-->
                </div>
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
                                extract($category);
                                $imgdm++;
                                echo '
                                <li>
                                    <a href="index.php?act=search&iddm='.$category['id']. '"> <img src="view/assets/imgs/theme/icons/category-' . $imgdm . '.svg"
                                    alt="" />' . $category['name'] . '</a>
                                    <span class="count">30</span>
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
                <!-- Product sidebar Widget -->
                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="view/assets/imgs/shop/thumbnail-3.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a href="shop-product-detail.php">Chen Cardigan</a></h5>
                            <p class="price mb-0 mt-5">$99.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="view/assets/imgs/shop/thumbnail-4.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.php">Chen Sweater</a></h6>
                            <p class="price mb-0 mt-5">$89.50</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="view/assets/imgs/shop/thumbnail-5.jpg" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h6><a href="shop-product-detail.php">Colorful Jacket</a></h6>
                            <p class="price mb-0 mt-5">$25</p>
                            <div class="product-rate">
                                <div class="product-rating" style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
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
    <script>
		$(document).ready(function(){
			var active = location.search; //?kytu=asc
			$('#select-filter option[value="'+active+'"]').attr('selected','selected');
		})
		
		$('.select-filter').change(function(){
			
			var value = $(this).find(':selected').val();
			
			 //alert(value);
			if(value!=0){
				var url = value;
				// alert(url);
				window.location.replace(url); 
			}else{
				alert('Hãy lọc sản phẩm');
			}
			
		})
	</script>
</main>