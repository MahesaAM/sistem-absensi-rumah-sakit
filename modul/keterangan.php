<?php  

if (isset($_POST['tambah'])) {
  $nama = $_POST['nama'];
  $alias = $_POST['alias'];

  mysqli_query($conn, "INSERT INTO tbl_keterangan VALUES (NULL,'$nama','$alias') ");
}

?>
<?php  

if (isset($_POST['edit'])) {
  $id = $_POST['id'];
  $nama = $_POST['nama'];
  $alias = $_POST['alias'];
  mysqli_query($conn, "UPDATE tbl_keterangan SET keterangan_nama='$nama', keterangan_alias='$alias' WHERE keterangan_id='$id' ");
}

?>
<?php  

if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM tbl_keterangan WHERE keterangan_id='$id' ");
}

?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <button style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah Keterangan</button>
              <h6 class="m-0 font-weight-bold text-primary">Daftar Keterangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th style="width: 40%">Alias</th>
                      <th>Keterangan</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 
                    $query = mysqli_query($conn, "SELECT * FROM tbl_keterangan");
                    while ($r=mysqli_fetch_assoc($query)) :
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $r['keterangan_alias'] ?></td>
                      <td><?php echo $r['keterangan_nama'] ?></td>
                      <td style="text-align: center;">
                      	<button class="btn btn-info" data-toggle="modal" data-target="#edit<?= $r['keterangan_id'] ?>"><i class="fa fa-pen"></i></button>
                      	<button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $r['keterangan_id'] ?>"><i class="fa fa-trash"></i></button>
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
            <label>Keterangan :</label>
            <input type="text" name="nama" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Nama Alias :</label>
            <input type="text" name="alias" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="tambah" >Tambah Keterangan</button>
    </form>
      </div>
    </div>
  </div>
</div>
<?php 
$e = mysqli_query($conn, "SELECT * FROM tbl_keterangan");
while ($r=mysqli_fetch_assoc($e)) : ?>

<div class="modal fade" id="edit<?= $r['keterangan_id'] ?>" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?php echo $r['keterangan_id'] ?>" name="id">
          <div class="form-groub">
            <label>Keterangan :</label>
            <input type="text" name="nama" value="<?php echo $r['keterangan_nama'] ?>" class="form-control" required="">
          </div>
          <div class="form-groub">
            <label>Nama Alias :</label>
            <input type="text" name="alias" value="<?php echo $r['keterangan_alias'] ?>" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="edit" >Tambah Keterangan</button>
    </form>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>

<?php  
$h=mysqli_query($conn, "SELECT * FROM tbl_keterangan ");
while ($r=mysqli_fetch_assoc($h)) :
?>
<div class="modal fade" id="hapus<?= $r['keterangan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus ?</strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $r['keterangan_id'] ?>" name="id">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>