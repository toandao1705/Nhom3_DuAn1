<?php
if (is_array($taikhoan)) {
  extract($taikhoan);
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
            <h3 class="card-title">Cập nhật tài khoản</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=updatetk" method="post" enctype="multipart/form-data" id="validateF">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputPassword1">Tên tài khoản</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>" disabled>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= $email ?>">
                <span id="email-error" class="error-text text-danger"></span>
              </div>
              <!-- <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu</label>
                <input type="password" class="form-control" name="pass" id="pass" value="">
                <span id="pass-error" class="error-text text-danger"></span>
              </div> -->
              <div class="form-group">
                <label for="exampleInputPassword1">Địa chỉ</label>
                <input type="text" class="form-control" name="address" id="address" value="<?= $address ?>">
                <span id="address-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?= $phone ?>">
                <span id="tel-error" class="error-text text-danger"></span>
              </div>
              <div class="form-group">
                <label for="role">Vai trò</label>
                <select class="form-control" name="role" id="role">
                  <option value="0" <?= $role === '0' ? 'selected' : '' ?>>User</option>
                  <option value="1" <?= $role === '1' ? 'selected' : '' ?>>Admin</option>
                </select>
              </div>
            </div>



            <div class="card-footer">
              <input type="hidden" name="id" value="<?= $id ?>">
              <input type="submit" class="btn btn-secondary" name="capnhat" value="CẬP NHẬT">
              <input type="reset" class="btn btn-info" value="NHẬP LẠi">
              <a href="index.php?act=listtk"><input class="btn btn-info" type="button" value="DANH SÁCH"></a>
            </div>
            <div class="form-group">
              <?php if (isset($_SESSION['thongbao']) && ($_SESSION['thongbao'] != "")) { ?>
                <div class="alert alert-danger" role="alert">
                  <?= $_SESSION['thongbao'] ?>
                </div>
              <?php } ?>
              <?php
              // Unset session sau khi đã sử dụng nó
              unset($_SESSION['thongbao']);
              ?>
            </div>
          </form>
          <script>
            // Hàm kiểm tra định dạng email
            function isValidEmail(email) {
              var emailPattern = /\S+@\S+\.\S+/;
              return emailPattern.test(email);
            }

            // Hàm kiểm tra định dạng số điện thoại
            function isValidPhoneNumber(phone) {
              var phonePattern = /^\d{10}$/;
              return phonePattern.test(phone);
            }

            document.getElementById('validateF').addEventListener('submit', function(e) {
              // Lấy giá trị của các trường dữ liệu
              var email = document.getElementById('email').value;
              var address = document.getElementById('address').value;
              var phone = document.getElementById('phone').value;

              // Xóa thông báo lỗi cũ
              document.getElementById('email-error').textContent = '';
              document.getElementById('address-error').textContent = '';
              document.getElementById('tel-error').textContent = '';

              // Bắt lỗi nếu email trống hoặc không đúng định dạng
              if (email.trim() === '') {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('email-error').textContent = 'Email không được để trống';
              } else if (!isValidEmail(email)) {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('email-error').textContent = 'Email không đúng định dạng';
              }

              // Bắt lỗi nếu địa chỉ trống
              if (address.trim() === '') {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('address-error').textContent = 'Địa chỉ không được để trống';
              }

              // Bắt lỗi nếu số điện thoại trống hoặc không đúng định dạng
              if (phone.trim() === '') {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('tel-error').textContent = 'Số điện thoại không được để trống';
              } else if (!isValidPhoneNumber(phone)) {
                e.preventDefault(); // Ngăn chặn việc submit form
                document.getElementById('tel-error').textContent = 'Số điện thoại phải có đúng 10 số';
              }
            });
          </script>




        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>