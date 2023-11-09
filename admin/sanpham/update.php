<?php
if (is_array($product)) {
  extract($product);
}
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
                <input type="text" class="form-control" name="tensp" value="<?= $name ?>">
                <span id="tensp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Giá</label>
                <input type="text" class="form-control" name="giasp" value="<?= $price ?>">
                <span id="giasp-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group mb-3">
                  <label class="custom-file-label" for="hinh">Chọn tệp</label>
                  <input type="file" class="custom-file-input" id="hinh" name="hinh[]" multiple>
                </div>

                <div class="row mt-3">
                  <?php
                  // Load all images associated with the product
                  $allImages = $loadedProducts->loadall_images($id);

                  // Display each image
                  if (is_array($allImages) || is_object($allImages)) {
                    foreach ($allImages as $image) {
                      $imagePath = "../upload/" . $image['img'];
                      if (is_file($imagePath)) {
                        echo '
                  <div class="col-md-2 mb-3">
                      <img src="' . $imagePath . '" class="img-thumbnail" alt="Image" style="width=200px; height:260px;">
                  </div>';
                      }
                    }
                } else {
                    // Xử lý khi $allImages không phải là mảng hoặc đối tượng
                    echo "Không phải là mảng hoặc đối tượng!";
                }
                  
                  ?>
                </div>

                <span id="hinh-error" class="error-text text-danger"></span>
              </div>


              <div class="form-group">
                <label for="exampleInputPassword1">Mô tả</label>
                <textarea name="mota" id="" cols="30" rows="10" class="form-control"><?= $describe ?></textarea>
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
            function validateForm() {
              var tensp = document.getElementsByName("tensp")[0].value;
              var giasp = document.getElementsByName("giasp")[0].value;
              var hinh = document.getElementsByName("hinh")[0].value;
              var mota = document.getElementsByName("mota")[0].value;

              if (tensp.trim() === "") {
                document.getElementById("tensp-error").textContent = "Tên sản phẩm không được để trống";
                return false;
              } else {
                document.getElementById("tensp-error").textContent = "";
              }

              // Bắt lỗi nếu giá sản phẩm không phải là số dương hoặc không được để trống
              if (isNaN(giasp) || giasp.trim() === "" || parseFloat(giasp) <= 0) {
                document.getElementById("giasp-error").textContent = "Giá sản phẩm phải là số dương và không được để trống";
                return false;
              } else {
                document.getElementById("giasp-error").textContent = "";
              }

              if (hinh === "") {
                document.getElementById("hinh-error").textContent = "Vui lòng chọn hình ảnh";
                return false;
              } else {
                document.getElementById("hinh-error").textContent = "";
              }

              if (mota.trim() === "") {
                document.getElementById("mota-error").textContent = "Mô tả không được để trống";
                return false;
              } else {
                document.getElementById("mota-error").textContent = "";
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