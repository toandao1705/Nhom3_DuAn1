<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Danh sách lịch sử xóa tài khoản</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=listtk">Trở lại</a></h3>
                        </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Tích</th>
                                    <th>Mã</th>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Vai trò</th>
                                </tr>
                            </thead>
                            <?php
                            if (!empty($users)) {
                                // Hiển thị thông tin danh mục
                                foreach ($users as $user) {
                                    extract($user);
                                    echo '<tr>
                                            <td><input type="checkbox"></td>
                                            <td>' . $id . '</td>
                                            <td>' . $name . '</td>
                                            <td>' . $email . '</td>
                                            <td>' . $address . '</td>
                                            <td>' . $phone . '</td>
                                            <td>' . $role . '</td>
                                            <td>
                                                <a href="index.php?act=restoretk&id=' . $id . '"><button class="btn btn-primary">Khôi phục</button></a>
                                                <a href="index.php?act=deletetk&id=' . $id . '"><button class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">Không có tài khoản nào.</td></tr>';
                            }
                            ?>
                            <tbody>
                                <!-- <tr>
                                        <td><input type="checkbox"></td>
                                        <td>1</td>
                                        <td>text</td>
                                        <td>text</td>
                                        <td>no photo</td>
                                        <td>
                                            <a href="index.php?act=updatebn"><button class="btn btn-primary">Sửa</button></a>
                                            <a href="#"><button class="btn btn-danger">Xóa</button></a>

                                        </td>
                                    </tr> -->
                            </tbody>


                        </table>
                        <div class="box mt-3">
                            <button class="btn btn-primary mb-3" id="select-all">Chọn tất cả</button>
                            <button class="btn btn-warning mb-3" id="deselect-all">Bỏ chọn tất cả</button>
                            <button class="btn btn-danger mb-3" id="delete-selected">Xóa các mục đã chọn</button>
                            <a href="index.php?act=addbn"><button class="btn btn-success mb-3"
                                    id="add-row">Thêm</button></a>
                        </div>
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