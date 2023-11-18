<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Lịch Sử Xóa Danh Mục</h3>
                        <h3 class="card-title ml-auto"><a href="index.php?act=listdm">Trở lại</a></h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php
                        if (isset($error_message)) {
                            echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
                        }
                        ?>
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tích</th>
                                    <th>Mã loại</th>
                                    <th>Tên loại</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Kiểm tra xem $categories có dữ liệu hay không
                                if (!empty($categories)) {
                                    // Hiển thị thông tin danh mục
                                // Kiểm tra xem $categories có phải là mảng không
                                if (is_array($categories)) {
                                    // Hiển thị thông tin danh mục
                                    foreach ($categories as $category) {
                                        extract($category);
                                        echo '<tr>
                                            <td><input type="checkbox"></td>
                                            <td>' . $category['id'] . '</td>
                                            <td>' . $category['name'] . '</td>
                                            <td>
                                                <a href="index.php?act=restoredm&id=' . $category['id'] . '"><button class="btn btn-primary" value="">Khôi phục</button></a>
                                                <a href="index.php?act=deletedm&id=' . $category['id'] . '"><button class="btn btn-danger" value="">Xóa</button></a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <ul class="pagination">
                            <?php
                            $totalPages = 0;
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=list_delete_history&page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="box mt-3">
                            <button class="btn btn-primary mb-3" id="select-all">Chọn tất cả</button>
                            <button class="btn btn-warning mb-3" id="deselect-all">Bỏ chọn tất cả</button>
                            <button class="btn btn-danger mb-3" id="delete-selected">Xóa các mục đã chọn</button>
                            <a href="index.php?act=adddm"><button class="btn btn-success mb-3" id="add-row">Thêm</button></a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->