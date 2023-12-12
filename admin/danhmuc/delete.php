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
                        if (isset($_SESSION['error_message'])) {
                            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
                            unset($_SESSION['error_message']); // Xóa thông báo lỗi sau khi hiển thị
                        }
                        ?>
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
                                $i =1;
                                // Kiểm tra xem $categories có dữ liệu hay không
                                if (!empty($categories)) {
                                    // Hiển thị thông tin danh mục
                                    // Kiểm tra xem $categories có phải là mảng không
                                    if (is_array($categories)) {
                                        // Hiển thị thông tin danh mục
                                        foreach ($categories as $category) {
                                            extract($category);
                                            echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>' . $category['id'] . '</td>
                                            <td>' . $category['name'] . '</td>
                                            <td>
                                                <a href="index.php?act=restoredm&id=' . $category['id'] . '"><button class="btn btn-primary" value="">Khôi phục</button></a>
                                                <a href="index.php?act=deletedm&id=' . $category['id'] . '"><button class="btn btn-danger">Xóa</button></a>
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

                    </div>
                    <script>
                        function confirmDelete(id) {
                            // Kiểm tra xem danh mục có thông báo lỗi từ PHP hay không
                            var error_message = "<?php echo isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '' ?>";

                            // Nếu có thông báo lỗi, hiển thị nó và thoát khỏi hàm
                            if (error_message !== "") {
                                alert(error_message);
                                return;
                            }

                            // Nếu không có lỗi, tiếp tục với hộp thoại xác nhận xóa
                            var confirmed = confirm("Bạn có chắc chắn muốn xóa không?");
                            if (confirmed) {
                                // Nếu người dùng chọn Yes, chuyển hướng đến trang xóa với tham số id
                                window.location.href = "index.php?act=deletedm&id=" + id;
                            } else {
                                // Nếu người dùng chọn No, không thực hiện hành động gì
                            }
                        }
                    </script>

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
            window.location.href = "index.php?act=restoredm&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
</section>
<!-- /.content -->