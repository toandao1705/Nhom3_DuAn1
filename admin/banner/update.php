<?php
if(is_array($onebanner)){
  extract($onebanner);
}
  $hinhpath=IMG_PATH_ADMIN.$img;
  if(is_file($hinhpath)){
    $img="<img src='" . $hinhpath . "' height='100px' width='150px'>";
    
  }else{
    $img= "nophoto";
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
            <h3 class="card-title">Cập nhật Banner</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="index.php?act=update_banner" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Mã Banner</label>
                <input type="text" class="form-control" name="maloai" disabled>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" value="<?=$title?>">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Subtitle</label>
                <input type="text" class="form-control" name="subtitle" value="<?=$subtitle?>">
              </div>
              <div class="form-group">
                <label for="hinh">Hình ảnh</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="hinh" name="img">
                    <label class="custom-file-label" for="hinh"></label>
                  </div>

                </div>
                <span id="hinh-error" class="error-text text-danger"></span>
              </div>
              <div class="mb-2">
                      <?=$img?>
                    </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <div class="btn-group" role="group" aria-label="Actions">
                  <input type="hidden" name="id" value="<?php if(isset($id)&&($id>0)) echo $id;?>">
                  <input type="submit" class="btn btn-primary" name="updatebn" value="CẬP NHẬT">
                  <input type="reset" class="btn btn-secondary" value="NHẬP LẠi">
                  <a href="index.php?act=listbn"><input class="btn btn-info" type="button" value="DANH SÁCH"></a>
                </div>
              </div>
          </form>
        </div>
        <!-- /.card -->


      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>