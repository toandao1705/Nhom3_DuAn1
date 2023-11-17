<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="index.php?act=adddm" method="post" onsubmit="return validateForm()">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Mã Loại</label>
                                <input type="text" class="form-control" name="maloai" disabled>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tên Loại</label>
                                <input type="text" class="form-control" name="tenloai" id="tenloai">
                                <span id="tenloai-error" class="error-text text-danger"></span>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <input type="submit" class="btn btn-primary" name="themmoi" value="THÊM MỚI">
                                    <input type="reset" class="btn btn-secondary" value="NHẬP LẠI">
                                    <a href="index.php?act=listdm" class="btn btn-info">DANH SÁCH</a>
                                </div>
                            </div>

                            <!-- Thông báo thành công -->
                            <?php if (isset($thongbao) && ($thongbao != "")) : ?>
                            <div id="success-alert" class="alert mt-3 btn-danger">
                                <?php echo $thongbao; ?>
                            </div>
                            <?php endif; ?>

                            <!-- Thêm đoạn mã JavaScript -->
                            <script>
                            // Sử dụng setTimeout để tự động ẩn đi sau 1 giây
                            setTimeout(function() {
                                document.getElementById('success-alert').style.display = 'none';
                            }, 2000);
                            </script>

                    </form>
                    <script>
                    function validateForm() {
                        var tenloai = document.getElementById("tenloai").value;
                        if (tenloai.trim() === "") {
                            document.getElementById("tenloai-error").textContent =
                                "Tên Loại không được để trống";
                            return false;
                        } else {
                            document.getElementById("tenloai-error").textContent = "";
                        }

                        return true;
                    }
                    </script>

                </div>
                <!-- /.card -->


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
</section>