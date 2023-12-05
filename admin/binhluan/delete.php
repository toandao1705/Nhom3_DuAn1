    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Lịch Sử Xóa Bình Luận</h3>
                        <h3 class="card-title ml-auto"><a href="index.php?act=listbl">Trở lại</a></h3>
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>ID</th>
                                        <th>Nội dung</th>
                                        <th>Tên người dùng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ngày bình luận</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i =1;
                                    // Kiểm tra xem $user có dữ liệu hay không
                                    if (!empty($listbl)) {
                                        // Hiển thị thông tin tai khoan
                                        foreach ($listbl as $binhluan) {
                                            extract($binhluan);
                                            $khoiphucbl = "index.php?act=restorebl&id=" . $id;
                                            $xoabl = "index.php?act=deletebl&id=" . $id;
                                            echo ' <tr>
                                                <td>'.$i++.'</td>
                                                <td>' . $id . '</td>
                                                <td>' . $content . '</td>
                                                <td>' . $id_user . '</td>
                                                <td>' . $id_pro . '</td>
                                                <td>' . $comment_date . '</td>
                                                <td>
                                                <a href="' . $khoiphucbl . '"><button class="btn btn-primary">Khôi phục</button></a>
                                                <a href="'.$xoabl.'"><button onclick="confirmDelete(' . $id . ')" class="btn btn-danger">Xóa</button></a>
                                            </td>
                                            </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                    }
                                    ?>
                                </tbody>


                            </table>
                            <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=list_delete_history_binhluan&page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                        </div>

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
        <script>
    // Hàm để hiển thị hộp thoại xác nhận xóa
    function confirmDelete(id) {
        var confirmed = confirm("Bạn có chắc chắn muốn xóa không?");
        if (confirmed) {
            // Nếu người dùng chọn Yes, chuyển hướng đến trang xóa với tham số id
            window.location.href = "index.php?act=deletebl&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
    </section>
    <!-- /.content -->