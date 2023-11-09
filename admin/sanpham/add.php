<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thêm mới sản phẩm</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=addsp" method="post" enctype="multipart/form-data" id="myForm">
            <div class="card-body">
              <div class="form-group">
                <label for="iddm">Danh mục</label>
                <select class="form-select" name="iddm" id="iddm">
                  <?php
                  foreach ($categories as $category) {
                    extract($category);
                    echo '<option value="' . $id . '">' . $name . '</option>';
                  }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Tên sản phẩm</label>
                <input type="text" class="form-control" name="tensp" id="tensp">
                <span id="tensp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Giá</label>
                <input type="text" class="form-control" name="giasp" id="giasp">
                <span id="giasp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="hinh" name="hinh[]" multiple>
                    <label class="custom-file-label" for="hinh">Chọn tệp</label>
                  </div>
                </div>
                <span id="hinh-error" class="error-text text-danger"></span>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Mô tả</label>
                <textarea name="mota" id="mota" cols="30" rows="10" class="form-control"></textarea>
                <span id="mota-error" class="error-text text-danger"></span>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="submit" class="btn btn-primary" name="themmoi" value="THÊM MỚI">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listsp" class="btn btn-info">DANH SÁCH</a>
                </div>
              </div>
              <?php
              if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
              ?>
            </div>
          </form>

          <script>
            document.getElementById('myForm').addEventListener('submit', function(e) {
              // Lấy giá trị của các trường dữ liệu
              var tensp = document.getElementById('tensp').value;
              var giasp = document.getElementById('giasp').value;
              var hinh = document.getElementById('hinh').value;
              var mota = document.getElementById('mota').value;

              // Xóa thông báo lỗi cũ
              document.getElementById('tensp-error').textContent = "";
              document.getElementById('giasp-error').textContent = "";
              document.getElementById('hinh-error').textContent = "";
              document.getElementById('mota-error').textContent = "";

              // Bắt lỗi nếu tên sản phẩm trống
              if (tensp.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('tensp-error').textContent = 'Tên sản phẩm không được để trống';
              }
              if (giasp.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('giasp-error').textContent = 'Giá sản phẩm không được để trống';
              }

              // Bắt lỗi nếu giá sản phẩm không phải là số
              if (isNaN(giasp)) {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('giasp-error').textContent = 'Giá sản phẩm phải là số';
              }
              // Bắt lỗi nếu giá sản phẩm không phải là số hoặc không lớn hơn 0
              if (isNaN(giasp) || giasp <= 0) {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('giasp-error').textContent = 'Giá sản phẩm phải là số dương';
              }

              // Bắt lỗi nếu tệp hình không được để trống
              if (hinh.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('hinh-error').textContent = 'Hình ảnh không được để trống';
              }

              // Bắt lỗi nếu mô tả trống
              if (mota.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('mota-error').textContent = 'Mô tả không được để trống';
              }
            });
          </script>

        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>