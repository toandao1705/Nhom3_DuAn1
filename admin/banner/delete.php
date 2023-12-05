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
                                    <th>Stt</th>
                                    <th>Mã</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Hình ảnh</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i =1;
                            if (!empty($listbanner)) {
                                // Hiển thị thông tin danh mục
                                foreach ($listbanner as $banner) {
                                    extract($banner);
                                    echo '<tr>
                                            <td>'.$i++.'</td>
                                            <td>' . $id . '</td>
                                            <td>' . $title . '</td>
                                            <td>' . $subtitle . '</td>
                                            <td><img src="' . IMG_PATH_ADMIN . $img . '" width="80px"  /></td>
                                            <td>
                                                <a href="index.php?act=restorebn&id=' . $id . '"><button class="btn btn-primary">Khôi phục</button></a>
                                                <a href="index.php?act=deletebn&id=' . $id . '"><button onclick="confirmDelete(' . $id . ')" class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">Không có banner nào.</td></tr>';
                            }
                            ?>
                            </tbody>


                        </table>
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=list_delete_history_banner&page=' . $i . '">' . $i . '</a></li>';
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
            window.location.href = "index.php?act=deletebn&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
</section>
<!-- /.content -->