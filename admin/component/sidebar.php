  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['admin']; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Bảng điều khiển
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bảng điều khiển</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?act=addbn" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Banner</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=adddm" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Danh Mục</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=addsp" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Sản Phẩm</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=listtk" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Tài Khoản</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=listbl" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Bình Luận</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=listdh" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Đơn Hàng</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?act=listthongke" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
              <p>Thống Kê</p>
            </a>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>