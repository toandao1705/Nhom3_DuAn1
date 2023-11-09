<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Cập nhật Banner</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=updatebn" method="post" onsubmit="return validateForm()">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Mã Banner</label>
                <input type="text" class="form-control" name="maloai" disabled>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Subtitle</label>
                <input type="text" class="form-control" name="subtitle">
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="hinh" name="hinh" id="hinh">
                    <label class="custom-file-label" for="hinh">Chọn tệp</label>
                  </div>

                </div>
                <span id="hinh-error" class="error-text text-danger"></span>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="submit" class="btn btn-primary" name="themmoi" value="THÊM MỚI">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listbn" class="btn btn-info">DANH SÁCH</a>
                </div>
              </div>
          </form>
        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>