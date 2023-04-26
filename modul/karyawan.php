<?php  

if (isset($_POST['tambah_anggota'])) {
  $nama = $_POST['nama'];
  
  if ($_POST['pdk']=="kosong") {
    $pdk = $_POST['pdk_baru'];
  }elseif (empty($_POST['pdk_baru'])) {
    $pdk = $_POST['pdk'];
  }elseif ($_POST['pdk']!=="kosong" AND !empty($_POST['pdk_baru']) ) {
    $pdk = $_POST['pdk_baru'];
  }
  if ($_POST['pk']=="kosong") {
    $pk = $_POST['pk_baru'];
  }elseif (empty($_POST['pk_baru'])) {
    $pk = $_POST['pk'];
  }elseif ($_POST['pk']!=="kosong" AND !empty($_POST['pk_baru']) ) {
    $pk = $_POST['pk_baru'];
  }
  if ($_POST['pa']=="kosong") {
    $pa = $_POST['pa_baru'];
  }elseif (empty($_POST['pa_baru'])) {
    $pa = $_POST['pa'];
  }elseif ($_POST['pa']!=="kosong" AND !empty($_POST['pa_baru']) ) {
    $pa = $_POST['pa_baru'];
  }

  mysqli_query($conn, "INSERT INTO tbl_karyawan VALUES (NULL,'$nama','$pdk','$pk','$pa') ");
}

?>
<?php  

if (isset($_POST['edit_anggota'])) {
  $id_karyawan = $_POST['id'];
  $nama = $_POST['nama'];
  
  if ($_POST['pdk']=="kosong") {
    $pdk = $_POST['pdk_baru'];
  }elseif (empty($_POST['pdk_baru'])) {
    $pdk = $_POST['pdk'];
  }elseif ($_POST['pdk']!=="kosong" AND !empty($_POST['pdk_baru']) ) {
    $pdk = $_POST['pdk_baru'];
  }

  if ($_POST['pk']=="kosong") {
    $pk = $_POST['pk_baru'];
  }elseif (empty($_POST['pk_baru'])) {
    $pk = $_POST['pk'];
  }elseif ($_POST['pk']!=="kosong" AND !empty($_POST['pk_baru']) ) {
    $pk = $_POST['pk_baru'];
  }

  if ($_POST['pa']=="kosong") {
    $pa = $_POST['pa_baru'];
  }elseif (empty($_POST['pa_baru'])) {
    $pa = $_POST['pa'];
  }elseif ($_POST['pa']!=="kosong" AND !empty($_POST['pa_baru']) ) {
    $pa = $_POST['pa_baru'];
  }

  mysqli_query($conn, "UPDATE tbl_karyawan SET karyawan_nama='$nama', karyawan_pdk='$pdk', karyawan_pk='$pk', karyawan_pa='$pa' WHERE karyawan_id='$id_karyawan' ");
  mysqli_query($conn, "UPDATE tbl_tim SET tim_nama='$nama', tim_pdk='$pdk', tim_pk='$pk', tim_pa='$pa' WHERE tim_id='$id_karyawan' ");
  mysqli_query($conn, "UPDATE tbl_absen SET absen_tim_nama='$nama', absen_tim_pdk='$pdk', absen_tim_pk='$pk', absen_tim_pa='$pa' WHERE absen_tim_id='$id_karyawan' ");
}

?>
<?php  

if (isset($_POST['hapus'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM tbl_karyawan WHERE karyawan_id='$id' ");
}


?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <button style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah Karyawan</button>
              <h6 class="m-0 font-weight-bold text-primary">Daftar Karyawan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th style="width: 40%">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 
                    $query = mysqli_query($conn, "SELECT * FROM tbl_karyawan");
                    while ($r=mysqli_fetch_assoc($query)) :
                    ?>
                    <tr>
                      <td><?php echo $no++ ?></td>
                      <td><?php echo $r['karyawan_nama'] ?></td>
                      <td><?php echo $r['karyawan_pdk'] ?></td>
                      <td><?php echo $r['karyawan_pk'] ?></td>
                      <td><?php echo $r['karyawan_pa'] ?></td>
                      <td style="text-align: center;">
                        <button class="btn btn-info" data-toggle="modal" data-target="#edit_anggota<?= $r['karyawan_id'] ?>"><i class="fa fa-pen"></i></button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $r['karyawan_id'] ?>"><i class="fa fa-trash"></i></button>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Karyawan</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <?php  
      $PDK=mysqli_query($conn, "SELECT * FROM tbl_pdk");
      $PK=mysqli_query($conn, "SELECT * FROM tbl_pk");
      $PA=mysqli_query($conn, "SELECT * FROM tbl_pa");
      ?>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?php echo $r['kelompok_id'] ?>" name="id_kelompok">
          <input type="hidden" value="<?php echo $r['kelompok_nama'] ?>" name="nama_kelompok">
          <div class="form-groub">
  <br>
  <input type="text" name="nama" class="form-control" placeholder="Nama" required="" >
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pdk">
        <option value="kosong">Pilih PDK</option>
        <?php while ($atr=mysqli_fetch_assoc($PDK)) : ?>
          <option value="<?php echo $atr['pdk_nama'] ; ?>" ><?php echo $atr['pdk_nama'] ; ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pdk_baru" class="form-control" placeholder="Data Baru Untuk PDK" >
    </div>
  </div>
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pk" >
        <option value="kosong">Pilih PK</option>
        <?php while ($atr=mysqli_fetch_assoc($PK)) : ?>
          <option value="<?php echo $atr['pk_nama'] ; ?>"><?php echo $atr['pk_nama'] ; ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pk_baru" class="form-control" placeholder="Data Baru Untuk PK" >
    </div>
  </div>
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pa" >
        <option value="kosong">Pilih PA</option>
        <?php while ($atr=mysqli_fetch_assoc($PA)) : ?>
          <option value="<?php echo $atr['pa_nama'] ; ?>"><?php echo $atr['pa_nama'] ; ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pa_baru" class="form-control" placeholder="Data Baru Untuk PA" >
    </div>
  </div>
</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="tambah_anggota" >Tambah Anggota</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php  
$h=mysqli_query($conn, "SELECT * FROM tbl_karyawan ");
while ($r=mysqli_fetch_assoc($h)) :
?>
<div class="modal fade" id="hapus<?= $r['karyawan_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus <strong><?php echo $r['karyawan_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $r['karyawan_id'] ?>" name="id">
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>

<?php  
$edit = mysqli_query($conn, "SELECT * FROM tbl_karyawan ");
while ($r=mysqli_fetch_assoc($edit)) :
?>
<div class="modal fade" id="edit_anggota<?= $r['karyawan_id'] ?>" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <?php  
      $PDK=mysqli_query($conn, "SELECT * FROM tbl_pdk");
      $PK=mysqli_query($conn, "SELECT * FROM tbl_pk");
      $PA=mysqli_query($conn, "SELECT * FROM tbl_pa");
      ?>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?php echo $r['karyawan_id'] ?>" name="id">
          <div class="form-groub">
  <br>
  <input type="text" name="nama" class="form-control" value="<?php echo $r['karyawan_nama'] ?>" placeholder="Nama" >
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pdk">
        <option value="kosong">Pilih PDK</option>
        <?php while ($atr=mysqli_fetch_assoc($PDK)) : ?>
          <?php if ($r['karyawan_pdk']==$atr['pdk_nama']): ?>
          <option value="<?php echo $atr['pdk_nama'] ; ?>" selected ><?php echo $atr['pdk_nama'] ; ?></option>
          <?php else: ?>
          <option value="<?php echo $atr['pdk_nama'] ; ?>" ><?php echo $atr['pdk_nama'] ; ?></option>
          <?php endif ?>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pdk_baru" class="form-control" placeholder="Data Baru Untuk PDK" >
    </div>
  </div>
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pk" >
        <option value="kosong">Pilih PK</option>
        <?php while ($atr=mysqli_fetch_assoc($PK)) : ?>
          <?php if ($r['karyawan_pk']==$atr['pk_nama']): ?>
          <option value="<?php echo $atr['pk_nama'] ; ?>" selected ><?php echo $atr['pk_nama'] ; ?></option>
          <?php else: ?>
          <option value="<?php echo $atr['pk_nama'] ; ?>" ><?php echo $atr['pk_nama'] ; ?></option>
          <?php endif ?>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pk_baru" class="form-control" placeholder="Data Baru Untuk PK" >
    </div>
  </div>
</div>
<div class="form-groub">
  <br>
  <div class="row">
    <div class="col-md-5">
      <select class="form-control" name="pa" >
        <option value="kosong">Pilih PA</option>
        <?php while ($atr=mysqli_fetch_assoc($PA)) : ?>
          <?php if ($r['karyawan_pa']==$atr['pa_nama']): ?>
          <option value="<?php echo $atr['pa_nama'] ; ?>" selected ><?php echo $atr['pa_nama'] ; ?></option>
          <?php else: ?>
          <option value="<?php echo $atr['pa_nama'] ; ?>" ><?php echo $atr['pa_nama'] ; ?></option>
          <?php endif ?>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="col-md-5">
      <input type="text" name="pa_baru" class="form-control" placeholder="Data Baru Untuk PA" >
    </div>
  </div>
</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="edit_anggota" >Edit Anggota</button>
    </form>
      </div>
    </div>
  </div>
</div>
<?php endwhile; ?>