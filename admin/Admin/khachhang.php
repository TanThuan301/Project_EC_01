<?php
include('../../connect_db/connection_db.php');
session_start();
if (!isset($_SESSION['tendangnhap'])) {
  header('Location: login.php');
}

if (isset($_GET['action']) && $_GET['action'] == 'dangxuat') {
  session_destroy();
  header('Location: index.php');
}


?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Khách hàng</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../assets/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="../../assets/css/css.css" rel="stylesheet">

  <script src="../../assets/js/sweetalert.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index.php" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Tìm kiếm" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['tendangnhap'] ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
              <a href="index.php" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <!-- <i class="right fas fa-angle-left"></i> -->
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="donhang.php" class="nav-link ">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Đơn hàng
                  <span class="badge badge-info right"><?php echo $_SESSION['soluongdonhang']?></span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">

              <a href="khachhang.php" class="nav-link active">
                <i class="nav-icon fas fa-copy"></i>
                <p>
                  Khách hàng
                  <!-- <i class="fas fa-angle-left right"></i> -->
                  <?php $sql_select = mysqli_query($con, "SELECT * FROM tbl_khachhang");
                    $soluongkh=0; 

                    while ($row_kh = mysqli_fetch_array($sql_select)) {
                      
                      $soluongkh+=1;
                    }
                    $_SESSION['soluongkhachhang']=$soluongkh;
                  ?>
                  <span class="badge badge-info right"><?php echo $soluongkh ?></span>
                </p>
              </a>

            </li>
            <li class="nav-item has-treeview">
              <a href="sanpham.php" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Sản phẩm
                  <!-- <i class="right fas fa-angle-left"></i> -->
                  <!-- <i class="fas fa-angle-left right"></i> -->
                  <span class="badge badge-info right"><?php echo $_SESSION['soluongsanpham']?></span>
                </p>
              </a>

            </li>
            <li class="nav-item has-treeview">
              <a href="thuonghieu-cauhinh.php" class="nav-link">
                <i class="nav-icon fas fa-tree"></i>
                <p>
                  Thương hiệu-Cấu hình
                  <!-- <i class="fas fa-angle-left right"></i> -->
                </p>
              </a>

            </li>
            

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Sản phẩm</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active">Khách hàng</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Danh sách khách hàng</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body p-0">
            <table class="table table-striped projects">
              <thead>
                <tr>
                  <th style="width: 1%" class="text-center">
                    #
                  </th>
                  <th style="width: 10%" class="text-center">
                    Tên khách hàng
                  </th>
                  <th style="width: 14%" class="text-center">
                    Số điện thoại
                  </th>
                  <th style="width: 15%" class="text-center">
                    Địa chỉ
                  </th>
                  <th style="width: 15%" class="text-center">
                    Email
                  </th>
                  <th style="width: 15%" class="text-center">
                    Số đơn hàng đã đặt
                  </th>

                </tr>
              </thead>
              <tbody>

                <?php
                $sql_select = mysqli_query($con, "SELECT * FROM tbl_khachhang");
                $i = 0;
                while ($row_kh = mysqli_fetch_array($sql_select)) {
                  $i++;
                  $soluongkh+=1;
                  $count_dh=0;
                    $ten_kh=$row_kh['tendangnhap'];
                    $sql_count_dh=mysqli_query($con,"SELECT tbl_donhang.magiaodich FROM tbl_khachhang,tbl_donhang WHERE tbl_donhang.ten_kh=tbl_khachhang.tendangnhap AND tbl_khachhang.tendangnhap='$ten_kh' GROUP BY tbl_donhang.magiaodich");
                    while ($row = mysqli_fetch_array($sql_count_dh)){
                      $count_dh++;
                    }
                ?>


                  <tr>
                    <td class="text-center">
                      <?php echo $i ?>
                    </td>
                    <td class="text-center">
                    <span class="badge badge-success"> <a>
                        <?php echo $row_kh['hoten'] ?>
                      </a></span>


                    </td>
                    <td class="text-center">
                      <a>
                        <?php echo $row_kh['sdt'] ?>
                      </a>

                    </td>
                    <td class="project_progress text-center">
                      <a><?php echo $row_kh['diachi'] ?></a>
                    </td>
                    <td class="project-state text-center">
                    <span class="badge badge-success"> <a><?php echo $row_kh['tendangnhap'] ?></a></span>
                    </td>

                    <td class="project-actions text-center">
                    <span class="badge badge-danger"> <a><?php echo $count_dh ?></a></span>
                    </td>
                  </tr>
                <?php


                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.1-pre
      </div>
      <strong>Copyright &copy; 2022 .</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>
</body>

</html>