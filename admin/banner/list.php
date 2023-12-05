<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h3 class="card-title">Quản Lý Banner</h3>
                        <h3 class="card-title ml-auto"><a href="index.php?act=list_delete_history_banner">Lịch sử xóa
                                banner</a></h3>
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
                                                <a href="index.php?act=updatebn&id=' . $id . '"><button class="btn btn-primary">Sửa</button></a>
                                                <a href="index.php?act=delete_hidden_banner&id=' . $id . '"><button onclick="confirmDelete(' . $id . ')" class="btn btn-danger">Xóa</button></a>
                                            </td>
                                        </tr>';
                                }
                            } else {
                                echo '<tr><td colspan="4">Không có banner nào.</td></tr>';
                            }
                            ?>
                            </tbody>


                        </table>
                        <!-- Pagination -->
                        <ul class="pagination">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo '<li class="page-item"><a class="page-link" href="index.php?act=listbn&page=' . $i . '">' . $i . '</a></li>';
                            }
                            ?>
                        </ul>
                        <div class="box mt-3">
                            <a href="index.php?act=addbn"><button class="btn btn-success mb-3"
                                    id="add-row">Thêm Banner</button></a>
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
    <script>
    // Hàm để hiển thị hộp thoại xác nhận xóa
    function confirmDelete(id) {
        var confirmed = confirm("Bạn có chắc chắn muốn xóa không?");
        if (confirmed) {
            // Nếu người dùng chọn Yes, chuyển hướng đến trang xóa với tham số id
            window.location.href = "index.php?act=delete_hidden_banner&id=" + id;
        } else {
            event.preventDefault();
            // Nếu người dùng chọn No, không thực hiện hành động gì
        }
    }
</script>
</section>
<!-- /.content -->