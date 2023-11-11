<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Quản Lý Danh Mục</h3>
                        <h3 class="card-title ml-auto"><a href="index.php?act=list_delete_history">Lịch sử xóa danh mục</a></h3>
                        
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
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
                                    foreach ($categories as $category) {
                                        echo '<tr>
                                            <td><input type="checkbox"></td>
                                            <td>' . $category['id'] . '</td>
                                            <td>' . $category['name'] . '</td>
                                            <td>
                                                <a href="index.php?act=updatedm&id=' . $category['id'] . '"><button class="btn btn-primary" value="">Sửa</button></a>
                                                <a href="index.php?act=delete_hidden&id=' . $category['id'] . '"><button class="btn btn-danger" value="">Xóa</button></a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
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
