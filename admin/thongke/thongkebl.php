    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Danh sách thống kê bình luận theo sản phẩm</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=listthongke">thống kê bình
                                    luận theo sản phẩm</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Tên khách hàng</th>
                                        <th>Số lượng</th>
                                        <th>Ngày bình luận gần nhất</th>
                                        <th>Ngày bình luận lâu nhất</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($listthongkebl as $thongkebl) {
                                        extract($thongkebl);
                                        echo'<tr>
                                        <td>'.$tensp.'</td>
                                        <td>'.$tenkh.'</td>
                                        <td>'.$countcm.'</td>
                                        <td>'.$ngaybl_gannhat.'</td>
                                        <td>'.$ngaybl_launhat.'</td>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="box mt-3">
                                <a href="index.php?act=bieudobl">
                                    <button class="btn btn-primary mb-3" id="select-all"> Xem biểu đồ
                                    </button>
                                </a>
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