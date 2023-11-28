<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Banner</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=addbn" method="post" onsubmit="return validateForm()"
            enctype="multipart/form-data" id="myForm">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Mã Banner</label>
                <input type="text" class="form-control" name="id" disabled>
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="img">Chọn tệp</label>
                  </div>
                </div>
                <span id="exampleInputFile-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề</label>
                <input type="text" class="form-control" name="title" id="title">
                <span id="title-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Tiêu đề phụ</label>
                <input type="text" class="form-control" name="subtitle" id="subtitle">
                <span id="subtitle-error" class="error-text text-danger"></span>
              </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="submit" class="btn btn-primary" name="addbn" value="THÊM MỚI">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listbn" class="btn btn-info">DANH SÁCH</a>
                </div>

              </div>
              <!-- Thông báo thành công -->
              <?php if (isset($thongbao) && ($thongbao != "")): ?>
                <div id="success-alert" class="alert alert-success mt-3">
                  <?php echo $thongbao; ?>
                </div>
              <?php endif; ?>

              <!-- Thêm đoạn mã JavaScript -->
              <script>
                // Sử dụng setTimeout để tự động ẩn đi sau 1 giây
                setTimeout(function () {
                  document.getElementById('success-alert').style.display = 'none';
                }, 2000);
              </script>
          </form>
          <script>
            function validateForm() {

              // Lấy giá trị của các trường dữ liệu
              var exampleInputFile = document.getElementById("exampleInputFile").value;
              var title = document.getElementById("title").value;
              var subtitle = document.getElementById("subtitle").value;

              // Bắt lỗi nếu tên sản phẩm trống
              if (exampleInputFile.trim() === "") {
                document.getElementById("exampleInputFile-error").textContent = "Hình không được để trống";
              }
              if (title.trim() === "") {
                document.getElementById("title-error").textContent = "Title không được để trống";
              }
              if (subtitle.trim() === "") {
                document.getElementById("subtitle-error").textContent = "Subtitle không được để trống";
                return false;
              }
              else {
                // Xóa thông báo lỗi cũ
                document.getElementById("exampleInputFile-error").textContent = "";
                document.getElementById("title-error").textContent = "";
                document.getElementById("subtitle-error").textContent = "";
              }

              return true;
            }
          </script>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>