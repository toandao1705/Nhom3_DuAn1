<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="shop-grid-right.php">Vegetables & tubers</a> <span></span> Seeds of Change Organic
            </div>
        </div>
    </div>
    <?php
    extract($onesp);
    // $hinh = $img_path . $img;
    ?>
    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <?php
                                    foreach ($onesp['images'] as $image) {
                                        $imgPath = $img_path . $image['img'];
                                    ?>
                                        <figure class="border-radius-10">
                                            <img src="<?php echo $imgPath; ?>" alt="product image" />
                                        </figure>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    <?php
                                    foreach ($onesp['images'] as $image) {
                                        $imgPath = $img_path . $image['img'];
                                    ?>
                                        <div><img src="<?php echo $imgPath; ?>" alt="product image" /></div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <span class="stock-status out-stock"> Sale Off </span>
                                <h2 class="title-detail"><?= $name ?></h2>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">$<?= $price ?></span>
                                        <span>
                                            <span class="save-price font-md color3 ml-15">26% Off</span>
                                            <span class="old-price font-md ml-15">$52</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg"><?= $describe ?></p>
                                </div>
                                <div class="attr-detail attr-size mb-30">
                                    <strong class="mr-10">Size / Weight: </strong>
                                    <ul class="list-filter size-filter font-small">
                                        <li><a href="#">50g</a></li>
                                        <li class="active"><a href="#">60g</a></li>
                                        <li><a href="#">80g</a></li>
                                        <li><a href="#">100g</a></li>
                                        <li><a href="#">150g</a></li>
                                    </ul>
                                </div>
                                <div class="detail-extralink mb-50">
                                    <!-- Trong phần chi tiết sản phẩm -->
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down" onclick="decreaseQuantity()"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="number" name="quantity" class="qty-val" value="1" id="quantityInput" min="1">
                                        <a href="#" class="qty-up" onclick="increaseQuantity()"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <?php
                                        echo '
                                            <form action="index.php?act=addtocart" method="post">
                                                <input type="hidden" name="id" value="' . $id . '">
                                                <input type="hidden" name="name" value="' . $name . '">
                                                <input type="hidden" name="img" value="' . $imgPath . '">
                                                <input type="hidden" name="price" value="' . $price . '">
                                                <input type="hidden" name="quantity" id="hiddenQuantity" value="1">
                                                <input type="submit" class="button button-add-to-cart" name="addtocart" onclick="addToCart()" value="ADD TO CART">
                                            </form>
                                            ';
                                        ?>
                                    </div>
                                    <!-- <button type="submit" class="button button-add-to-cart"><i class="fi-rs-shopping-cart"></i>Add to cart</button> -->
                                    <div class="mt-5">
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.php"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.php"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                </div>
                                <script>
                                    function increaseQuantity() {
                                        var quantityInput = document.getElementById('quantityInput');
                                        quantityInput.stepUp(1);
                                        updateHiddenQuantity();
                                    }

                                    function decreaseQuantity() {
                                        var quantityInput = document.getElementById('quantityInput');
                                        quantityInput.stepDown(1);
                                        updateHiddenQuantity();
                                    }

                                    function updateHiddenQuantity() {
                                        var quantityInput = document.getElementById('quantityInput');
                                        var hiddenQuantity = document.getElementById('hiddenQuantity');
                                        hiddenQuantity.value = quantityInput.value;
                                    }

                                    function addToCart() {
                                        updateHiddenQuantity();
                                        document.getElementById('addToCartForm').submit();
                                    }
                                </script>

                            </div>

                            <div class="font-xs">
                                <ul class="mr-50 float-start">
                                    <li class="mb-5">Type: <span class="text-brand">Organic</span></li>
                                    <li class="mb-5">MFG:<span class="text-brand"> Jun 4.2022</span></li>
                                    <li>LIFE: <span class="text-brand">70 days</span></li>
                                </ul>
                                <ul class="float-start">
                                    <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                    <li class="mb-5">Tags: <a href="#" rel="tag">Snack</a>, <a href="#" rel="tag">Organic</a>, <a href="#" rel="tag">Brown</a></li>
                                    <li>Stock:<span class="in-stock text-brand ml-5">8 Items In Stock</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p>Uninhibited carnally hired played in whimpered dear gorilla koala depending and much yikes off far quetzal goodness and from for grimaced goodness unaccountably and meadowlark near unblushingly crucial scallop tightly neurotic hungrily some and dear furiously this apart.</p>
                                    <p>Spluttered narrowly yikes left moth in yikes bowed this that grizzly much hello on spoon-fed that alas rethought much decently richly and wow against the frequent fluidly at formidable acceptably flapped besides and much circa far over the bucolically hey precarious goldfinch mastodon goodness gnashed a jellyfish and one however because.</p>
                                    <ul class="product-more-infor mt-30">
                                        <li><span>Type Of Packing</span> Bottle</li>
                                        <li><span>Color</span> Green, Pink, Powder Blue, Purple</li>
                                        <li><span>Quantity Per Case</span> 100ml</li>
                                        <li><span>Ethyl Alcohol</span> 70%</li>
                                        <li><span>Piece In One</span> Carton</li>
                                    </ul>
                                    <hr class="wp-block-separator is-style-dots" />
                                    <p>Laconic overheard dear woodchuck wow this outrageously taut beaver hey hello far meadowlark imitatively egregiously hugged that yikes minimally unanimous pouted flirtatiously as beaver beheld above forward energetic across this jeepers beneficently cockily less a the raucously that magic upheld far so the this where crud then below after jeez enchanting drunkenly more much wow callously irrespective limpet.</p>
                                    <h4 class="mt-30">Packaging & Delivery</h4>
                                    <hr class="wp-block-separator is-style-wide" />
                                    <p>Less lion goodness that euphemistically robin expeditiously bluebird smugly scratched far while thus cackled sheepishly rigid after due one assenting regarding censorious while occasional or this more crane went more as this less much amid overhung anathematic because much held one exuberantly sheep goodness so where rat wry well concomitantly.</p>
                                    <p>Scallop or far crud plain remarkably far by thus far iguana lewd precociously and and less rattlesnake contrary caustic wow this near alas and next and pled the yikes articulate about as less cackled dalmatian in much less well jeering for the thanks blindly sentimental whimpered less across objectively fanciful grimaced wildly some wow and rose jeepers outgrew lugubrious luridly irrationally attractively dachshund.</p>
                                    <h4 class="mt-30">Suggested Use</h4>
                                    <ul class="product-more-infor mt-30">
                                        <li>Refrigeration not necessary.</li>
                                        <li>Stir before serving</li>
                                    </ul>
                                    <h4 class="mt-30">Other Ingredients</h4>
                                    <ul class="product-more-infor mt-30">
                                        <li>Organic raw pecans, organic raw cashews.</li>
                                        <li>This butter was produced using a LTG (Low Temperature Grinding) process</li>
                                        <li>Made in machinery that processes tree nuts but does not process peanuts, gluten, dairy or soy</li>
                                    </ul>
                                    <h4 class="mt-30">Warnings</h4>
                                    <ul class="product-more-infor mt-30">
                                        <li>Oil separation occurs naturally. May contain pieces of shell.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Additional-info">
                                <table class="font-md">
                                    <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                                    <img src="view/assets/imgs/vendor/vendor-18.svg" alt="" />
                                    <div class="vendor-name ml-15">
                                        <h6>
                                            <a href="vendor-details-2.php">Noodles Co.</a>
                                        </h6>
                                        <div class="product-rate-cover text-end">
                                            <div class="product-rate d-inline-block">
                                                <div class="product-rating" style="width: 90%"></div>
                                            </div>
                                            <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                        </div>
                                    </div>
                                </div>
                                <ul class="contact-infor mb-50">
                                    <li><img src="view/assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>5171 W Campbell Ave undefined Kent, Utah 53127 United States</span></li>
                                    <li><img src="view/assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Contact Seller:</strong><span>(+91) - 540-025-553</span></li>
                                </ul>
                                <div class="d-flex mb-55">
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Rating</p>
                                        <h4 class="mb-0">92%</h4>
                                    </div>
                                    <div class="mr-30">
                                        <p class="text-brand font-xs">Ship on time</p>
                                        <h4 class="mb-0">100%</h4>
                                    </div>
                                    <div>
                                        <p class="text-brand font-xs">Chat response</p>
                                        <h4 class="mb-0">89%</h4>
                                    </div>
                                </div>
                                <p>Noodles & Company is an American fast-casual restaurant that offers international and American noodle dishes and pasta in addition to soups and salads. Noodles & Company was founded in 1995 by Aaron Kennedy and is headquartered in Broomfield, Colorado. The company went public in 2013 and recorded a $457 million revenue in 2017.In late 2018, there were 460 Noodles & Company locations across 29 states and Washington, D.C.</p>
                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Customer questions & answers</h4>
                                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                                            <script>
                                                $(document).ready(function() {
                                                    $("#binhluan").load("view/form_comment.php", {
                                                        id_pro: <?= $id ?>
                                                    });
                                                });
                                            </script>
                                            <div class="comment-list" id="binhluan">

                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <h6>4.8 out of 5</h6>
                                            </div>
                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                            </div>
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Related products</h2>
                    </div>
                    <div class="col-12">
                        <style>
                            input.add {
                                width: 85px;
                                height: 36px;
                                color: #3BB77E;
                            }
                        </style>
                        <div class="row related-products">
                            <?php
                            // Mảng để lưu ID của các sản phẩm đã được hiển thị
                            $displayedProducts = array();

                            foreach ($sp_cung_loai as $sp_cung_loai) {
                                extract($sp_cung_loai);

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
                                        <img class="default-img" src="<?php echo $imgPath; ?>" style="width:246.21px; height:246.21px;" />
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>