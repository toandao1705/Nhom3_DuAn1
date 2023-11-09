<?php
if (is_array($categories)) {
    extract($categories);
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
            <h3 class="card-title">Cập Nhật Danh Mục</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=update_category" method="post" onsubmit="return validateForm()">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Mã Loại</label>
                <input type="text" class="form-control" name="maloai" disabled>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Tên Loại</label>
                <input type="text" class="form-control" name="tenloai" id="tenloai" value="<?php if(isset($name)&&($name!="")) echo $name;?>">
                <span id="tenloai-error" class="error-text text-danger"></span>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="hidden" name="id" value="<?php if(isset($id)&&($id>0)) echo $id;?>">
                  <input type="submit" class="btn btn-primary" name="capnhat" value="CẬP NHẬT">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listdm"><input class="btn btn-info" type="button" value="DANH SÁCH"></a>
                </div>
              </div>
          </form>
          <script>
            function validateForm() {
              var tenloai = document.getElementById("tenloai").value;

              if (tenloai.trim() === "") {
                document.getElementById("tenloai-error").textContent = "Tên Loại không được để trống";
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