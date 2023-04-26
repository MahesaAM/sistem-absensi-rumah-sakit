<?php  

if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  mysqli_query($conn, "INSERT INTO tbl_user VALUES (NULL,'$nama','$username','$password') ");
}

?>
<?php  

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = md5($_POST['password']);

  if (empty($password)) {
    $query = mysqli_query($conn, "UPDATE tbl_user SET user_nama = '$nama' , user_username = '$username' , user_password = '$password' WHERE user_id = '$id' ");
  }else{
    $query = mysqli_query($conn, "UPDATE tbl_user SET user_nama = '$nama' , user_username = '$username'  WHERE user_id = '$id' ");
  }

}

?>
<?php  

if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM tbl_user WHERE user_id='$id' ");
}

?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <button style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah User</button>
              <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th style="width: 40%">Nama</th>
                      <th>Usernama</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 
                    $query = mysqli_query($conn, "SELECT * FROM tbl_user");
                    while ($r=mysqli_fetch_assoc($query)) :
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $r['user_nama'] ?></td>
                      <td><?php echo $r['user_username'] ?></td>
                      <td style="text-align: center;">
                      	<button class="btn btn-info" data-toggle="modal" data-target="#edit<?= $r['user_id'] ?>"><i class="fa fa-pen"></i></button>
                      	<button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $r['user_id'] ?>"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<div class="modal fade" id="tambah" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota Untuk <?= $r['kelompok_nama'] ?></h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-groub">
            <label>Nama :</label>
            <input type="text" name="nama" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Username :</label>
            <input type="text" name="username" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Password :</label>
            <input type="password" name="password" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="tambah" >Tambah Anggota</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php  
$e=mysqli_query($conn, "SELECT * FROM tbl_user ");
while ($r=mysqli_fetch_assoc($e)) :
?>
<div class="modal fade" id="edit<?= $r['user_id'] ?>" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?php echo $r['user_id'] ?>" name="id">
          <div class="form-groub">
            <label>Nama :</label>
            <input type="text" name="nama" value="<?php echo $r['user_nama'] ?>" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Username :</label>
            <input type="text" name="username" value="<?php echo $r['user_username'] ?>" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Password :</label>
            <input type="password" name="password" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="edit" >Edit Anggota</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>

<?php  
$h=mysqli_query($conn, "SELECT * FROM tbl_user ");
while ($r=mysqli_fetch_assoc($h)) :
?>
<div class="modal fade" id="hapus<?= $r['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus <strong><?php echo $r['user_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $r['user_id'] ?>" name="id">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>