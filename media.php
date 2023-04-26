<?php 
ob_start(); 
session_start();
if (empty($_SESSION['user'])) {
  echo"<script>location='index.php';</script>";
}
include'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $_GET['modul'] ?></title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?modul=absensi">
        <div class="sidebar-brand-icon">
          <i class="fas fa-calendar-alt"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Jadwal</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <?php if ($_GET['modul']=="absensi"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=absensi">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Absensi</span></a>
      </li>
      <?php if ($_GET['modul']=="daftar_absensi"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=daftar_absensi">
          <i class="fas fa-fw fa-calendar-alt"></i>
          <span>Daftar Jadwal</span></a>
      </li>
      <?php if ($_GET['modul']=="tim"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=tim">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>Tim</span></a>
      </li>
      <?php if ($_GET['modul']=="karyawan"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=karyawan">
          <i class="fas fa-fw fa-users"></i>
          <span>Karyawan</span></a>
      </li>
      <?php if ($_GET['modul']=="kas" OR $_GET['modul']=="daftar_kas" ): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-coins"></i>
          <span>Kas</span>
        </a>
        <?php if ($_GET['modul']=="kas" OR $_GET['modul']=="daftar_kas" ): ?>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <?php else: ?>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <?php endif ?>
        
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="?modul=kas">Kas</a>
            <a class="collapse-item" href="?modul=daftar_kas">Daftar Kas</a>
          </div>
        </div>
      </li>
      <?php if ($_GET['modul']=="keterangan"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=keterangan">
          <i class="fas fa-fw fa-calendar-day"></i>
          <span>Keterangan</span></a>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Managemen User
      </div>

      <!-- Nav Item - Tables -->
      <?php if ($_GET['modul']=="user"): ?>
        <li class="nav-item active">
      <?php else: ?>
        <li class="nav-item">
      <?php endif ?>
        <a class="nav-link" href="?modul=user">
          <i class="fas fa-fw fa-table"></i>
          <span>User</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user']['user_nama'] ?></span>
                <img class="img-profile rounded-circle" src="assets/img/foto.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php
              error_reporting(0);
              if ($_GET['modul']=="absensi") {
                include"modul/absensi.php";
              }elseif ($_GET['modul']=="tim") {
                include"modul/tim.php";
              }elseif ($_GET['modul']=="user") {
                include"modul/user.php";
              }elseif ($_GET['modul']=="keterangan") {
                include"modul/keterangan.php";
              }elseif ($_GET['modul']=="daftar_absensi") {
                include"modul/daftar_absensi.php";
              }elseif ($_GET['modul']=="kas") {
                include"modul/kas.php";
              }elseif ($_GET['modul']=="daftar_kas") {
                include"modul/daftar_kas.php";
              }elseif ($_GET['modul']=="karyawan") {
                include"modul/karyawan.php";
              }
              ?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo date('Y'); ?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apakah anda yakin ingin keluar ?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-warning" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/datatables-demo.js"></script>

</body>

</html>
