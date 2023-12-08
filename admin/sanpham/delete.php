    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title d-flex">Lịch Sử Xóa Sản Phẩm</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=listsp">Trở lại</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã loại</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Lượt xem</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php
                                $i =1;
                                if (!empty($productsList)) {
                                    foreach ($productsList as $product) {
                                        extract($product);
                                        $suasp = "index.php?act=restoresp&id=" . $id;
                                        $xoasp = "index.php?act=deletesp&id=" . $id;
                                        $hinhpath = "../upload/";
                                        // Lấy danh sách hình ảnh từ đối tượng $loadedProducts
                                        $images = $loadedProducts->load_images($id);

                                        // Chỉ lấy ảnh đầu tiên nếu có
                                        $imageColumn = '';
                                        if (!empty($images)) {
                                            $imageColumn = '<img src="' . $hinhpath . $images[0]['img'] . '" alt="Image" style="max-width: 100px;">';
                                        }

                                        echo '
                                        <tr>
                                            <td>'.$i++.'</td>
                                            <td>' . $category_name . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $imageColumn . '</td>
                                            <td>' . $price . '</td>
                                            <td>' . $quantity . '</td>
                                            <td>' . $view . '</td>
                                            <td>
                                            <div class="' . ($status == 0 ? 'border bg-success text-white rounded-pill d-inline-block' : 'border bg-secondary text-white rounded-pill d-inline-block') . '">' . ($status == 0 ? '<div class = "mx-3">Còn hàng</div>' : '<div class = "mx-3">Đã hết hàng</div>') . '</div>
                                            <td>
                                            <td>
                                                <a href="' . $suasp . '"><button class="btn btn-primary">Khôi phục</button></a>
                                                <a href="' . $xoasp . '"><button class="btn btn-danger" onclick="deleteProduct(' . $id . ')">Xóa</button></a>
                                            </td>
                                        </tr>
                                    ';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Không có sản phẩm nào.</td></tr>';
                                }
                                ?>
                            </table>
                            <ul class="pagination">
                                <?php
                                for ($i = 1; $i <= $totalPages; $i++) {
                                    echo '<li class="page-item"><a class="page-link" href="index.php?act=list_delete_history_sanpham&page=' . $i . '">' . $i . '</a></li>';
                                }
                                ?>
                            </ul>

                        </div>
                        <script>
                            function deleteProduct(productId) {
                                var confirmation = confirm("Bạn có chắc chắn muốn xóa sản phẩm này?");
                                if (confirmation) {
                                    window.location.href = 'index.php?act=deletesp&id=' + productId;
                                } else {
                                    event.preventDefault();
                                    // Nếu người dùng chọn No, không thực hiện hành động gì
                                }
                            }
                        </script>

                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                // Lấy các checkbox
                                var checkboxes = document.querySelectorAll(".checkbox");

                                // Lấy nút "Chọn tất cả"
                                var selectAllButton = document.getElementById("select-all");

                                // Lấy nút "Bỏ chọn tất cả"
                                var deselectAllButton = document.getElementById("deselect-all");

                                // Thêm sự kiện khi nút "Chọn tất cả" được nhấn
                                selectAllButton.addEventListener("click", function() {
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        checkboxes[i].checked = true;
                                    }
                                });

                                // Thêm sự kiện khi nút "Bỏ chọn tất cả" được nhấn
                                deselectAllButton.addEventListener("click", function() {
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        checkboxes[i].checked = false;
                                    }
                                });
                            });
                        </script>








                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->