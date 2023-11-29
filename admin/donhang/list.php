    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Quản lý đơn hàng</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Khách hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng hàng</th>
                                        <th>Giá trị đơn hàng</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Tình trạng dơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Kiểm tra xem $user có dữ liệu hay không
                                if (!empty($listdh)) {
                                    // Hiển thị thông tin tai khoan
                                    foreach ($listdh as $donhang) {
                                        extract($donhang);
                                    
                                        // Chuyển đổi giá trị status thành trạng thái tương ứng
                                        switch ($status) {
                                            case 0:
                                                $status_text = 'Đơn hàng mới';
                                                break;
                                            case 1:
                                                $status_text = 'Đang xử lý';
                                                break;
                                            case 2:
                                                $status_text = 'Đang giao hàng';
                                                break;
                                            case 3:
                                                $status_text = 'Giao hàng thành công';
                                                break;
                                            default:
                                                $status_text = 'Trạng thái không xác định';
                                                break;
                                        }
                                    
                                        echo ' <tr>
                                                <td>' . $bill_id . '</td>
                                                <td>' . $username . '</td>
                                                <td>' . $proname . '</td>
                                                <td>' . $qty . '</td>
                                                <td>$' . number_format("$price",2) . '</td>
                                                <td>' . $ngaydathang . '</td>
                                                <td>' . $status_text . '</td>
                                            </tr>';
                                    }
                                    
                                } else {
                                    echo '<tr><td colspan="4">Không có danh mục nào.</td></tr>';
                                }
                                ?>
                                    <!-- <tr>
                                        <td>DH001</td>
                                        <td>Toàn</td>
                                        <td>2</td>
                                        <td>200.000VNĐ</td>
                                        <td>03/11/2023</td>
                                        <td>Thanh toán trực tiếp</td> 
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