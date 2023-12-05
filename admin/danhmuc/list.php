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
                                    <th>Stt</th>
                                    <th>Mã loại</th>
                                    <th>Tên loại</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                // Kiểm tra xem $categories có dữ liệu hay không
                                if (!empty($categories)) {
                                    // Hiển thị thông tin danh mục
                                    foreach ($categories as $category) {
                                        echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>' . $category['id'] . '</td>
                                            <td>' . $category['name'] . '</td>
                                            <td>
                                                <a href="index.php?act=updatedm&id=' . $category['id'] . '"><button class="btn btn-primary" value="">Sửa</button></a>
                                                <a href="index.php?act=delete_hidden&id=' . $category['id'] . '"><button onclick="confirmDelete(' . $category['id'] . ')" class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=listdm&page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="box mt-3">
                            <a href="index.php?act=adddm"><button class="btn btn-primary mb-3" id="add-row">Thêm Danh Mục</button></a>
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
    <script>
    // Hàm để hiển thị hộp thoại xác nhận xóa
    function confirmDelete(id) {
        var confirmed = confirm("Bạn có chắc chắn muốn xóa không?");
        if (confirmed) {
            // Nếu người dùng chọn Yes, chuyển hướng đến trang xóa với tham số id
            window.location.href = "index.php?act=delete_hidden&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
</section>
<!-- /.content -->