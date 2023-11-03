<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cập nhật tài khoản</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=updatetk" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputPassword1">Tên tài khoản</label>
                <input type="text" class="form-control" name="name" value="">
                <span id="name-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" class="form-control" name="email" value="">
                <span id="email-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu</label>
                <input type="text" class="form-control" name="pass" value="">
                <span id="pass-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="">
                <span id="address-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Số điện thoại</label>
                <input type="text" class="form-control" name="tel" value="">
                <span id="tel-error" class="error-text text-danger"></span>
              </div>
            </div>

            <div class="card-footer">
              <input type="hidden" name="id" value="">
              <input type="submit" name="capnhat" value="CẬP NHẬT">
              <input type="reset" value="NHẬP LẠi">
              <a href="index.php?act=listtk"><input type="button" value="DANH SÁCH"></a>
            </div>
          </form>

          <script>
            function validateForm() {
              var name = document.getElementsByName("name")[0].value;
              var email = document.getElementsByName("email")[0].value;
              var pass = document.getElementsByName("pass")[0].value;
              var address = document.getElementsByName("address")[0].value;
              var tel = document.getElementsByName("tel")[0].value;

              var namePattern = /^[a-zA-Z0-9\s]+$/;
              var passPattern = /^.{6,}$/;
              var telPattern = /^\d{10}$/;
              var emailPattern = /\S+@\S+\.\S+/;

              var isValid = true;

              if (name.trim() === "") {
                document.getElementById("name-error").textContent = "Tên tài khoản không được để trống";
                isValid = false;
              } else if (!name.match(namePattern)) {
                document.getElementById("name-error").textContent = "Tên không được chứa ký tự đặt biệt";
                isValid = false;
              } else {
                document.getElementById("name-error").textContent = "";
              }

              if (email.trim() === "") {
                document.getElementById("email-error").textContent = "Email không được để trống";
                isValid = false;
              } else if (!email.match(emailPattern)) {
                document.getElementById("email-error").textContent = "Email không đúng định dạng";
                isValid = false;
              } else {
                document.getElementById("email-error").textContent = "";
              }

              if (!pass.match(passPattern)) {
                document.getElementById("pass-error").textContent = "Mật khẩu phải có ít nhất 10 ký tự";
                isValid = false;
              } else {
                document.getElementById("pass-error").textContent = "";
              }

              if (address.trim() === "") {
                document.getElementById("address-error").textContent = "Địa chỉ không được để trống";
                isValid = false;
              } else {
                document.getElementById("address-error").textContent = "";
              }

              if (!tel.match(telPattern)) {
                document.getElementById("tel-error").textContent = "Số điện thoại phải có đúng 10 số";
                isValid = false;
              } else {
                document.getElementById("tel-error").textContent = "";
              }

              return isValid;
            }
          </script>

        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>