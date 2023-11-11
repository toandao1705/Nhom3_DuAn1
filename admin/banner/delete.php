    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Lịch Sử Xóa Banner</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=listbn">Trở lại</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tích</th>
                                        <th>Mã</th>
                                        <th>Title</th>
                                        <th>Subtitle</th>
                                        <th>Hình ảnh</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <?php
                                    foreach($listbanner as $banner){
                                        extract($banner);
                                        echo '<tr>
                                            <td><input type="checkbox"></td>
                                            <td>'.$id.'</td>
                                            <td>'.$title.'</td>
                                            <td>'.$subtitle.'</td>
                                            <td><img src="'.IMG_PATH_ADMIN.$img.'" width="80px"  /></td>
                                            <td>
                                                <a href="index.php?act=restorebn&id='.$id.'"><button class="btn btn-primary">Khôi phục</button></a>
                                                <a href="index.php?act=deletebn&id='.$id.'"><button class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>';
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
                                <a href="index.php?act=addbn"><button class="btn btn-success mb-3" id="add-row">Thêm</button></a>
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