    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Quản Lý Danh Mục</h3>
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
                                <?php
                                    foreach($categories as $category){
                                        extract($category);
                                        echo ' <tr>
                                            <td><input type="checkbox"></td>
                                            <td>'.$id.'</td>
                                            <td>'.$name.'</td>
                                            <td>
                                                <a href="index.php?act=updatedm"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="#"><button class="btn btn-danger">Xóa</button></a>

                                            </td>
                                        </tr>';
                                    }
                                ?>
                                <tbody>
                                    <!-- <tr>
                                        <td><input type="checkbox"></td>
                                        <td>1</td>
                                        <td>Đồ Khô</td>
                                        <td>
                                            <a href="index.php?act=updatedm"><button class="btn btn-primary">Sửa</button></a>
                                            <a href="#"><button class="btn btn-danger">Xóa</button></a>

                                        </td>
                                    </tr> -->
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

                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->