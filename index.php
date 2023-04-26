<?php  
include 'koneksi.php';
ob_start();
session_start();
if (isset($_SESSION['user'])) {
  echo"<script>location='media.php?modul=absensi';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Jadwal</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="username"  placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required="">
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
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

</body>

</html

<?php

  if (isset($_POST['submit'])) {
    $user=$_POST['username'];
    $pass=md5($_POST['password']);
    $query=mysqli_query($conn, "SELECT * FROM tbl_user WHERE user_username='$user' AND user_password='$pass'");

    if (mysqli_num_rows($query)==1) {
      session_start();
      $akun = $query->fetch_assoc();

      $_SESSION['user'] = $akun;

      header('Location:media.php?modul=absensi');

    }else{
      echo"<script>alert('anda gagal login, silahkan check akun anda');</script>";
      header('Location:index.php');
    }
  }
  ?>