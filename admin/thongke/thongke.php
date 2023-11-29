    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h3 class="card-title">Danh sách thống kê sản phẩm theo danh mục</h3>
                            <h3 class="card-title ml-auto"><a href="index.php?act=listthongkebl">Thống kê bình
                                    luận theo sản phẩm</a></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>

                                        <th>Mã Danh Mục</th>
                                        <th>Tên danh mục</th>
                                        <th>Số lượng</th>
                                        <th>Giá cao nhất</th>
                                        <th>Giá thấp nhất</th>
                                        <th>Giá trung bình</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($listthongke as $thongke) {
                                        extract($thongke);
                                        echo'<tr>
                                        <td>'.$madm.'</td>
                                        <td>'.$tendm.'</td>
                                        <td>'.$countsp.'</td>
                                        <td>$'.number_format("$maxprice",2).'</td>
                                        <td>$'.number_format("$minprice",2).'</td>
                                        <td>$'.number_format("$avgprice",2).'</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>


                            </table>
                            <div class="box mt-3">
                                <a href="index.php?act=bieudo">
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