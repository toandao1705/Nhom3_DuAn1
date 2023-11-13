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
          <form action="index.php?act=addbn" method="post" onsubmit="return validateForm()" enctype="multipart/form-data"id="myForm">
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
                <span id="hinh-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" id="title">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" id="subtitle">
              </div>
             
              <!-- /.card-body -->
              
              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="submit" class="btn btn-primary" name="addbn" value="THÊM MỚI">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listbn" class="btn btn-info">DANH SÁCH</a>
                </div>
              
              </div>
              <?php
                if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
              ?>
          </form>
          <!-- function validateForm() {
            // Lấy giá trị của các trường dữ liệu
              var img = document.getElementById("img").value;
              var title = document.getElementById("title").value;
              var subtitle = document.getElementById("subtitle").value;

              if (tenloai.trim() === "") {
                document.getElementById("tenloai-error").textContent = "Tên Loại không được để trống";
                return false;
              } else {
                document.getElementById("tenloai-error").textContent = "";
              }

              return true;
            } -->
            <script>
            function validateForm() {
              var subtitle = document.getElementById("subtitle").value;

              if (subtitle.trim() === "") {
                document.getElementById("subtitle-error").textContent = "Tên Loại không được để trống";
                return false;
              } else {
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
<!-- // Lấy giá trị của các trường dữ liệu
              var img = document.getElementById("img").value;
              var title = document.getElementById("title").value;
              var subtitle = document.getElementById("subtitle").value;

              // Xóa thông báo lỗi cũ
              document.getElementById('img-error').textContent = "";
              document.getElementById('title-error').textContent = "";
              document.getElementById('subtitle-error').textContent = "";

              if (img.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('img-error').textContent = 'Hình ảnh không được để trống';
              }
              if (title.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('title-error').textContent = 'Hình ảnh không được để trống';
              }
              if (subtitle.trim() === "") {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('subtitle-error').textContent = 'Hình ảnh không được để trống'; -->