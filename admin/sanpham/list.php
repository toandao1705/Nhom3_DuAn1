    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Danh sách sản phẩm</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=list_delete_history_sanpham">Lịch sử xóa danh mục</a></h3>
                        </div>
                        <div class="card-header">
                            <form action="index.php?act=listsp" method="post" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="kyw" class="form-control" placeholder="Từ khóa">
                                    <select name="iddm" id="iddm" class="form-select">
                                        <option value="0" selected>Tất cả</option>
                                        <?php
                                        foreach ($categories as $category) {
                                            extract($category);
                                            echo '<option value="' . $id . '">' . $name . '</option>';
                                        }
                                        ?>

                                    </select>
                                    <div class="input-group-append">
                                        <input type="submit" name="listok" value="GO" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>




                        <!-- /.card-header -->
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Mã loại</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Giá</th>
                                        <th>Lượt xem</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <?php
                                foreach ($productsList as $product) {
                                    extract($product);
                                    $suasp = "index.php?act=updatesp&id=" . $id;
                                    $xoasp = "index.php?act=delete_hidden_sanpham&id=" . $id;
                                    $hinhpath = "../upload/";
                                    // Lấy danh sách hình ảnh từ đối tượng $loadedProducts
                                    $images = $loadedProducts->load_images($id);
                                
                                    // Chỉ lấy ảnh đầu tiên nếu có
                                    $imageColumn = '';
                                    if (!empty($images)) {
                                        $imageColumn = '<img src="'.$hinhpath. $images[0]['img'] . '" alt="Image" style="max-width: 100px;">';
                                    }
                                
                                    echo '
                                        <tr>
                                            <td><input class="checkbox" type="checkbox"></td>
                                            <td>' . $category_name . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $imageColumn . '</td>
                                            <td>' . $price . '</td>
                                            <td>' . $view . '</td>
                                            <td>
                                                <a href="' . $suasp . '"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="' . $xoasp . '"><button class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>
                                    ';
                                }
                                
                                
                                
                                ?>



                            </table>

                        </div>
                        <div class="box mt-3">
                            <button class="btn btn-primary mb-3" id="select-all">Chọn tất cả</button>
                            <button class="btn btn-warning mb-3" id="deselect-all">Bỏ chọn tất cả</button>
                            <button class="btn btn-danger mb-3" id="delete-selected">Xóa các mục đã chọn</button>
                            <a href="index.php?act=addsp"><button class="btn btn-success mb-3" id="add-row">Thêm</button></a>
                        </div>
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