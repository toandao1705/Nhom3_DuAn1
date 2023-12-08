<?php
if (is_array($product)) {
  extract($product);
}

$allImages = $loadedProducts->loadall_images($id);
?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cập nhật loại hàng hóa</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=update_product" method="post" enctype="multipart/form-data" id="myForm" onsubmit="return validateForm()">
            <div class="card-body">
              <div class="form-group">
                <select name="iddm" id="">
                  <?php
                  foreach ($categories as $category) {
                    if ($id_category == $category['id']) $s = "selected";
                    else $s = "";
                    echo '<option value="' . $category['id'] . '" ' . $s . '>' . $category['name'] . '</option>';
                  }
                  ?>

                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tên sản phẩm</label>
                <input type="text" class="form-control" name="tensp" id="tensp" value="<?= $name ?>">
                <span id="tensp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Giá</label>
                <input type="text" class="form-control" name="giasp" id="giasp" value="<?= $price ?>">
                <span id="giasp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Số lượng</label>
                <input type="text" class="form-control" name="soluong" id="soluongsp" value="<?= $quantity ?>">
                <span id="soluongsp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group mb-3">
                  <label class="custom-file-label" for="hinh">Chọn tệp</label>
                  <input type="file" class="custom-file-input" id="hinh" name="hinh[]" multiple onchange="previewImages(this)">
                </div>

                <div class="row mt-3" id="current-images">
                  <?php
                  if (is_array($allImages) || is_object($allImages)) {
                    foreach ($allImages as $image) {
                      $imagePath = "../upload/" . $image['img'];
                      if (is_file($imagePath)) {
                        echo '
                      <div class="col-md-2 mb-3 current-image">
                          <img src="' . $imagePath . '" class="img-thumbnail" alt="Image" style="width=200px; height:260px;">
                      </div>';
                      }
                    }
                  } else {
                  }
                  ?>
                </div>


                <!-- Dùng để hiển thị các ảnh mới được chọn -->
                <div class="row mt-3" id="preview-container"></div>
                <span id="hinh-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
              <label for="role">Vai trò</label>
              <select class="form-control" name="status" id="status">
                <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Còn hàng</option>
                <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Đã hết hàng</option>
              </select>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Mô tả</label>
                <textarea name="mota" id="mota" cols="30" rows="10" class="form-control"><?= $describe ?></textarea>
                <span id="mota-error" class="error-text text-danger"></span>
              </div>
            </div>

            <div class="card-footer">
              <div class="btn-group" role="group" aria-label="Actions">
                <input type="hidden" class="btn btn-primary" name="id" value="<?= $id ?>">
                <input type="submit" class="btn btn-secondary" name="capnhat" value="CẬP NHẬT">
                <input type="reset" value="NHẬP LẠi" class="btn btn-info">
                <a href="index.php?act=listsp"><input class="btn btn-info" type="button" value="DANH SÁCH"></a>
              </div>
            </div>
            <?php
            if (isset($thongbao) && ($thongbao != "")) echo $thongbao;
            ?>
          </form>
          <script>
            function previewImages(input) {
              var previewContainer = document.getElementById('preview-container');
              previewContainer.innerHTML = '';

              // Ẩn các ảnh hiện tại
              var currentImages = document.querySelectorAll('.current-image');
              currentImages.forEach(function(image) {
                image.style.display = 'none';
              });

              var files = input.files;
              for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();

                reader.onload = function(e) {
                  var img = document.createElement('img');
                  img.src = e.target.result;
                  img.className = 'img-thumbnail';
                  img.alt = 'Image';
                  img.style = 'width: 200px; height: 260px; margin-right: 10px;';

                  previewContainer.appendChild(img);
                };

                reader.readAsDataURL(files[i]);
              }
            }
          </script>


          <script>
            function validateForm() {
              // Lấy giá trị của các trường dữ liệu
              var tensp = document.getElementById('tensp').value;
              var giasp = document.getElementById('giasp').value;
              var hinh = document.getElementById('hinh').value;
              var mota = document.getElementById('mota').value;

              // Xóa thông báo lỗi cũ
              document.getElementById('tensp-error').textContent = '';
              document.getElementById('giasp-error').textContent = '';
              document.getElementById('hinh-error').textContent = '';
              document.getElementById('mota-error').textContent = '';

              // Bắt lỗi nếu tên sản phẩm trống
              if (tensp.trim() === '') {
                document.getElementById('tensp-error').textContent = 'Tên sản phẩm không được để trống';
                return false;
              }

              // Bắt lỗi nếu giá trống hoặc không phải là số dương
              if (giasp.trim() === '') {
                document.getElementById('giasp-error').textContent = 'Giá sản phẩm không được để trống';
                return false;
              }else if (isNaN(giasp) || parseInt(giasp) <= 0) {
                document.getElementById('giasp-error').textContent = 'Giá sản phẩm phải là số dương';
                return false;
              }

              // Bắt lỗi nếu không có hình ảnh được chọn
              if (hinh.trim() === '') {
                document.getElementById('hinh-error').textContent = 'Hình ảnh không được để trống';
                return false;
              }

              // Bắt lỗi nếu mô tả trống
              if (mota.trim() === '') {
                document.getElementById('mota-error').textContent = 'Mô tả không được để trống';
                return false;
              }

              // Nếu mọi thứ đều hợp lệ, cho phép submit form
              return true;
            }
          </script>


        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>