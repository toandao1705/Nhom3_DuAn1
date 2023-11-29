    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Danh sách bình luận</h3>
                        <h3 class="card-title ml-auto"><a href="index.php?act=list_delete_history_binhluan">Lịch sử xóa bình luận</a></h3>
                    </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Tích</th>
                                        <th>ID</th>
                                        <th>Nội dung</th>
                                        <th>Tên người dùng</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ngày bình luận</th>
                                        <!-- <th></th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    // Kiểm tra xem $user có dữ liệu hay không
                                    if (!empty($listbl)) {
                                        // Hiển thị thông tin tai khoan
                                        foreach ($listbl as $binhluan) {
                                            extract($binhluan);
                                            $xoabl = "index.php?act=delete_hidden_binhluan&id=" . $id;
                                            echo ' <tr>
                                                <td><input type="checkbox"></td>
                                                <td>' . $id . '</td>
                                                <td>' . $content . '</td>
                                                <td>' . $id_user . '</td>
                                                <td>' . $id_pro . '</td>
                                                <td>' . $comment_date . '</td>
                                                <td>

                                                    <a href="' . $xoabl . '"><button class="btn btn-danger">Xóa</button></a>

                                                </td>
                                                
                                            </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                    }
                                    ?>
                                    
                                    <!-- <tr>
                                        <td><input type="checkbox"></td>
                                        <td>1</td>
                                        <td>rau củ khá tươi</td>
                                        <td>toan</td>
                                        <td>Cà chua</td>
                                        <td>03/11/2023</td>
                                        <td>

                                            <a href="' . $xoabl . '"><button class="btn btn-danger">Xóa</button></a>

                                        </td>
                                    </tr> -->
                                </tbody>


                            </table>
                            <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=listbl&page=' . $i . '">' . $i . '</a></li>';
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
    </section>
    <!-- /.content -->