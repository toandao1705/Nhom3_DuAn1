    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Danh sách tài khoản</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=list_delete_history_taikhoan">Lịch sử xóa tài khoản</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Stt</th>
                                        <th>Mã tài khoản</th>
                                        <th>Tên tài khoản</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Số điện thoại</th>
                                        <th>Vai trò</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i =1;
                                // Kiểm tra xem $user có dữ liệu hay không
                                if (!empty($listtk)) {
                                    // Hiển thị thông tin tai khoan
                                    foreach ($listtk as $taikhoan) {
                                        extract($taikhoan);
                                        $xoasp = "index.php?act=delete_hidden_taikhoan&id=" . $id;
                                        $suatk = "index.php?act=suatk&id=" . $id;
                                        echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$address.'</td>
                                            <td>'.$phone.'</td>
                                            <td>'.($role == 1 ? 'Admin' : 'User').'</td>
                                            <td>
                                                <a href="'.$suatk.'"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="'.$xoasp.'"><button onclick="confirmDelete(' . $id . ')" class="btn btn-danger">Xóa</button></a>
                                            </td>';
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
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=listtk&page=' . $i . '">' . $i . '</a></li>';
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
            window.location.href = "index.php?act=delete_hidden_taikhoan&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
    </section>
    <!-- /.content -->