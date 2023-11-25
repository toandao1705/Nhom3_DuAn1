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
                                        <th>Tích</th>
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
                                // Kiểm tra xem $user có dữ liệu hay không
                                if (!empty($listtk)) {
                                    // Hiển thị thông tin tai khoan
                                    foreach ($listtk as $taikhoan) {
                                        extract($taikhoan);
                                        $xoasp = "index.php?act=delete_hidden_taikhoan&id=" . $id;
                                        $suatk = "index.php?act=suatk&id=" . $id;
                                        echo '<tr>
                                            <td><input type="checkbox"></td>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>'.$email.'</td>
                                            <td>'.$address.'</td>
                                            <td>'.$phone.'</td>
                                            <td>'.($role == 1 ? 'Admin' : 'User').'</td>
                                            <td>
                                                <a href="'.$suatk.'"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="'.$xoasp.'"><button class="btn btn-danger">Xóa</button></a>

                                            </td>';
                                    }
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                ?>
                                    <!-- <tr>
                                        <td><input type="checkbox"></td>
                                        <td>1</td>
                                        <td>toan</td>
                                        <td>toan12@gmail.com</td>
                                        <td>**********</td>
                                        <td>Cần Thơ</td>
                                        <td>0123456789</td>
                                        <td>Quản trị</td>
                                        <td>
                                            <a href="index.php?act=updatetk"><button class="btn btn-primary">Sửa</button></a>
                                            <a href="#"><button class="btn btn-danger">Xóa</button></a>

                                        </td>
                                    </tr> -->
                                </tbody>


                            </table>

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
    </section>
    <!-- /.content -->