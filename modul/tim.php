<?php  
$y=mysqli_query($conn, "SELECT max(absen_tahun) AS th FROM tbl_absen ");
$th=mysqli_fetch_assoc($y);
$yy=$th['th'];
$d=mysqli_query($conn, "SELECT max(absen_bulan) AS bl FROM tbl_absen WHERE absen_tahun='$yy' ");
$bl=mysqli_fetch_assoc($d);
$dd=$bl['bl'];

if (isset($_POST['tambah_tim'])) {
  // loop data field dari inputan
  $kelompok = $_POST['nama_tim'];
  mysqli_query($conn, "INSERT INTO tbl_kelompok VALUES (NULL,'$kelompok') ");
  $id_kelompok = $conn->insert_id;
  $number = count($_POST['pilih']);

 for ($i = 0; $i<$number; $i++) {

  $pilih = $_POST['pilih'][$i];
  $kywan=mysqli_query($conn, "SELECT * FROM tbl_karyawan WHERE karyawan_id='$pilih' ");
  $r=mysqli_fetch_assoc($kywan);
  $id_karyawan = $r['karyawan_id'];
  $nama = $r['karyawan_nama'];
  $pdk = $r['karyawan_pdk'];
  $pk = $r['karyawan_pk'];
  $pa = $r['karyawan_pa'];
  $status = 0;

  mysqli_query($conn, "INSERT INTO tbl_tim VALUES (NULL,'$id_karyawan','$id_kelompok','$nama','$pdk','$pk','$pa','$status' ) ");
 }

}

?>
<?php  

if (isset($_POST['tambah_anggota'])) {
  $id_kelompok = $_POST['id_kelompok'];
  $nama_kelompok = $_POST['nama_kelompok'];
  $number = count($_POST['pilih']);

 for ($i = 0; $i<$number; $i++) {

  $pilih = $_POST['pilih'][$i];
  $kywan=mysqli_query($conn, "SELECT * FROM tbl_karyawan WHERE karyawan_id='$pilih' ");
  $r=mysqli_fetch_assoc($kywan);
  $id_karyawan = $r['karyawan_id'];
  $nama = $r['karyawan_nama'];
  $pdk = $r['karyawan_pdk'];
  $pk = $r['karyawan_pk'];
  $pa = $r['karyawan_pa'];
  $status = 0;

  mysqli_query($conn, "INSERT INTO tbl_tim VALUES (NULL,'$id_karyawan','$id_kelompok','$nama','$pdk','$pk','$pa','$status' ) ");
 }
}

?>
<?php  

if (isset($_POST['tambah_karu'])) {
  $id = $_POST['pilih'];
  $ka=mysqli_query($conn, "SELECT * FROM tbl_karyawan WHERE karyawan_id='$id' ");
  $k=mysqli_fetch_assoc($ka);
  $id_karyawan = $k['karyawan_id'];
  $nama = $k['karyawan_nama'];
  $pdk = $k['karyawan_pdk'];
  $pk = $k['karyawan_pk'];
  $pa = $k['karyawan_pa'];
  $kelo=mysqli_query($conn, "SELECT kelompok_id,kelompok_nama FROM tbl_kelompok GROUP BY kelompok_nama ");
  $ke=mysqli_fetch_assoc($kelo);
  $id_kelom = $ke['kelompok_id'];
  $kelom    = $ke['kelompok_nama'];
  $status = 0;
  mysqli_query($conn, "INSERT INTO tbl_tim VALUES (NULL,'$id','$id_kelom','$nama','$pdk','$pk','$pa','$status') ");

}

?>
<?php  

if (isset($_POST['hapus_kelompok'])) {
  $id_kolompok = $_POST['id_kolompok'];

  mysqli_query($conn, "DELETE FROM tbl_kelompok WHERE kelompok_id='$id_kolompok' ");
  mysqli_query($conn, "DELETE FROM tbl_tim WHERE tim_kelompok_id='$id_kolompok' ");
}

?>
<?php  

if (isset($_POST['hapus_anggota'])) {
  $id_tim = $_POST['id_tim'];
  mysqli_query($conn, "DELETE FROM tbl_tim WHERE tim_id='$id_tim' ");
}

?>
<?php  

if (isset($_POST['hapus_karu'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM tbl_tim WHERE tim_id='$id' ");
}

?>
<?php  

if (isset($_POST['aktifkan'])) {
  $id = $_POST['id'];
  $id_kelompok=$_POST['id_kelompok'];
  $nama_kelompok=$_POST['nama_kelompok'];
  $tim=mysqli_query($conn, "SELECT * FROM tbl_tim WHERE tim_id='$id' ");
  $t=mysqli_fetch_assoc($tim);
  $nama = $t['tim_nama'];
  $pdk = $t['tim_pdk'];
  $pk = $t['tim_pk'];
  $pa = $t['tim_pa'];
  $status = 1;
  mysqli_query($conn, "UPDATE tbl_tim SET tim_status='$status' ");
  mysqli_query($conn, "INSERT INTO tbl_absen (absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun) VALUES ('$id_kelompok','$nama_kelompok','$id','$nama','$pdk','$pk','$pa','$dd','$yy') ");
  $id_absen = $conn->insert_id;
  $tg=date('d');
  $d=1;
  while ($d <= $tg) {
    $kk="absen_".$d;
    mysqli_query($conn, "UPDATE tbl_absen SET $kk = 'L' WHERE absen_id='$id_absen'  ");
    $d++;
  }

}

?>
<?php  

if (isset($_POST['aktifkan_karu'])) {
  $nama = $_POST['nama'];
  $pdk = $_POST['pdk'];
  $pk = $_POST['pk'];
  $pa = $_POST['pa'];
  $status = 1;

  mysqli_query($conn, "INSERT INTO tbl_karu VALUES (NULL,'$nama','$pdk','$pk','$pa','$dd','$yy') ");
  mysqli_query($conn, "UPDATE tbl_tim SET tim_status='$status' ");


}

?>
<button class="btn btn-success" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah Tim</button>
<br>
<br>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <?php $karu=mysqli_query($conn, "SELECT * FROM tbl_tim WHERE tim_pa='KaRu' "); ?>
              <?php if (mysqli_num_rows($karu)==0): ?>
              <button style="float: right;" class="btn btn-info" data-toggle="modal" data-target="#karu"><i class="fa fa-plus"></i></button>
              <?php endif ?>
                
              <h6 class="m-0 font-weight-bold text-primary">Kepala Ruangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                    <?php if (mysqli_num_rows($karu)==1): ?>
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <th style="width: 40%">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <th>Status</th>
                      <th style="text-align: center;">Action</th>
                  </thead>
                  <tbody>
                      <?php  
                    while ($r=mysqli_fetch_assoc($karu)) :
                    ?>
                    <form action="" method="post" >
                    <input type="hidden" value="<?= $r['tim_nama'] ?>" name="nama">
                    <input type="hidden" value="<?= $r['tim_pdk'] ?>" name="pdk">
                    <input type="hidden" value="<?= $r['tim_pk'] ?>" name="pk">
                    <input type="hidden" value="<?= $r['tim_pa'] ?>" name="pa">
                    <tr>
                      <td><?php echo $r['tim_nama'] ?></td>
                      <td><?php echo $r['tim_pdk'] ?></td>
                      <td><?php echo $r['tim_pk'] ?></td>
                      <td><?php echo $r['tim_pa'] ?></td>
                      <td style="text-align: center; ">
                        <?php if ($r['tim_status']==1): ?>
                          <strong style="color: green;">Aktif</strong>
                        <?php else: ?>
                          <button class="btn btn-warning" name="aktifkan_karu" >Aktifkan</button>
                        <?php endif ?>
                      </td>
                    </form>
                      <td style="text-align: center;">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus_karu"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  <?php else: ?>
                    <h1 style="text-align: center;">Masukan Kepala Ruang</h1>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php  
$tim = mysqli_query($conn, "SELECT * FROM tbl_kelompok");
while ($row=mysqli_fetch_assoc($tim)) :
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <button style="float: right;" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row['kelompok_id'] ?>"><i class="fa fa-trash"></i></button>
              <button style="float: right;" class="btn btn-info"  data-toggle="modal" data-target="#tambah_anggota<?= $row['kelompok_id'] ?>"><i class="fa fa-plus"></i></button>
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['kelompok_nama'] ?></h6>
              <?php 
              $k_id = $row['kelompok_id'];
              $pjbt=mysqli_query($conn, "SELECT tim_pa,tim_kelompok_id FROM tbl_tim WHERE tim_pa='PPJA' AND tim_kelompok_id='$k_id' ");
               ?>
               <?php if (mysqli_num_rows($pjbt)==0): ?>
                 <strong style="color : red ;">Belum Ada Pejabat</strong>
               <?php endif ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="table" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th style="width: 40%">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <th>Status</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php
                  	$id = $row['kelompok_id'];  
                  	$n = 1;
                  	$q = mysqli_query($conn, "SELECT * FROM tbl_tim WHERE tim_kelompok_id='$id' ");
                  	while ( $r=mysqli_fetch_assoc($q) ) :
                  	?>

                    <?php if ($r['tim_pa']!=='KaRu'): ?>
                      <tr>
                      <td><?php echo $n++ ?></td>
                      <form action="" method="post" >
                      <input type="hidden" value="<?= $r['tim_id'] ?>" name="id">
                      <input type="hidden" value="<?= $row['kelompok_nama'] ?>" name="nama_kelompok">
                      <input type="hidden" value="<?= $row['kelompok_id'] ?>" name="id_kelompok">
                      <td><?php echo $r['tim_nama'] ?></td>
                      <td><?php echo $r['tim_pdk'] ?></td>
                      <td><?php echo $r['tim_pk'] ?></td>
                      <td><?php echo $r['tim_pa'] ?></td>
                      <td style="text-align: center; ">
                        <?php if ($r['tim_status']==1): ?>
                          <strong style="color: green;">Aktif</strong>
                        <?php else: ?>
                          <button class="btn btn-warning" name="aktifkan" >Aktifkan</button>
                        <?php endif ?>
                      </td>
                      </form>
                      <td style="text-align: center;">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus_anggota<?= $r['tim_id'] ?>"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <?php endif ?>
                    
                    <?php endwhile ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php endwhile; ?>

<div class="modal fade" id="tambah" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah TIM</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="text" class="form-control" name="nama_tim" placeholder="Nama Tim" required="" >
          <br>
        <table class="table table-bordered" id="dataTable" width="100%">
                  <thead>
                    <tr>
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
                    $id=$r['karyawan_id'];
                    $ch=mysqli_query($conn, "SELECT tim_id FROM tbl_tim WHERE tim_karyawan_id='$id' ");
                    ?>
                    <?php if (mysqli_num_rows($ch)==0): ?>
                    <?php if ($r['karyawan_pa']!=='KaRu'): ?>
                    <tr>
                      <td><?php echo $r['karyawan_nama'] ?></td>
                      <td><?php echo $r['karyawan_pdk'] ?></td>
                      <td><?php echo $r['karyawan_pk'] ?></td>
                      <td><?php echo $r['karyawan_pa'] ?></td>
                      <td style="text-align: center;">
                        <input class="form-control" value="<?php echo $r['karyawan_id'] ?>" type="checkbox" name="pilih[]" >
                      </td>
                    </tr>
                    <?php endif ?>
                    <?php endif ?>
                  <?php endwhile; ?>
                  </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		<button class="btn btn-info" name="tambah_tim" >TAMBAH TIM</button>
		</form>
      </div>
    </div>
  </div>
</div>

<?php $kel=mysqli_query($conn, "SELECT * FROM tbl_kelompok ");
while ($row=mysqli_fetch_assoc($kel)) : ?>
 <!-- Hapus-->
  <div class="modal fade" id="hapus<?= $row['kelompok_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus <strong><?= $row['kelompok_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $row['kelompok_id'] ?>" name="id_kolompok">
            <button type="submit" name="hapus_kelompok" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php $kel=mysqli_query($conn, "SELECT * FROM tbl_tim ");
while ($row=mysqli_fetch_assoc($kel)) : ?>
 <!-- Hapus-->
  <div class="modal fade" id="hapus_anggota<?= $row['tim_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus <strong><?php echo $row['tim_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $row['tim_id'] ?>" name="id_tim">
            <button type="submit" name="hapus_anggota" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>





<?php  
$ta = mysqli_query($conn, "SELECT * FROM tbl_kelompok");
while ($r=mysqli_fetch_assoc($ta)) : ?>

<div class="modal fade" id="tambah_anggota<?= $r['kelompok_id'] ?>" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Anggota</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?= $r['kelompok_id'] ?>" name="id_kelompok">
          <input type="hidden" value="<?= $r['kelompok_nama'] ?>" name="nama_kelompok">
          <br>
        <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
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
                    $id=$r['karyawan_id'];
                    $ch=mysqli_query($conn, "SELECT tim_id FROM tbl_tim WHERE tim_karyawan_id='$id' ");
                    ?>
                    <?php if (mysqli_num_rows($ch)==0): ?>
                    <?php if ($r['karyawan_pa']!=="KaRu"): ?>
                    <tr>
                      <td><?php echo $r['karyawan_nama'] ?></td>
                      <td><?php echo $r['karyawan_pdk'] ?></td>
                      <td><?php echo $r['karyawan_pk'] ?></td>
                      <td><?php echo $r['karyawan_pa'] ?></td>
                      <td style="text-align: center;">
                        <input class="form-control" value="<?php echo $r['karyawan_id'] ?>" type="checkbox" name="pilih[]" >
                      </td>
                    </tr>
                    <?php endif ?>
                    <?php endif ?>
                  <?php endwhile; ?>
                  </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="tambah_anggota" >TAMBAH</button>
    </form>
      </div>
    </div>
  </div>
</div>

<?php endwhile; ?>

<div class="modal fade" id="karu" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <input type="hidden" value="<?= $r['kelompok_id'] ?>" name="id_kelompok">
          <input type="hidden" value="<?= $r['kelompok_nama'] ?>" name="nama_kelompok">
          <br>
        <table class="table table-bordered" width="100%">
                  <thead>
                    <tr>
                      <th style="width: 40%">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <th style="text-align: center;">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; 
                    $query = mysqli_query($conn, "SELECT * FROM tbl_karyawan WHERE karyawan_pa='KaRu' ");
                    while ($r=mysqli_fetch_assoc($query)) :
                    $id=$r['karyawan_id'];
                    $ch=mysqli_query($conn, "SELECT tim_id FROM tbl_tim WHERE tim_karyawan_id='$id' ");
                    ?>
                    <?php if (mysqli_num_rows($ch)==0): ?>
                    <tr>
                      <td><?php echo $r['karyawan_nama'] ?></td>
                      <td><?php echo $r['karyawan_pdk'] ?></td>
                      <td><?php echo $r['karyawan_pk'] ?></td>
                      <td><?php echo $r['karyawan_pa'] ?></td>
                      <td style="text-align: center;">
                        <input class="form-control" value="<?php echo $r['karyawan_id'] ?>" type="radio" name="pilih" >
                      </td>
                    </tr>
                    <?php endif ?>
                  <?php endwhile; ?>
                  </tbody>
                </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button class="btn btn-info" name="tambah_karu" >TAMBAH</button>
    </form>
      </div>
    </div>
  </div>
</div>
<?php  
$kar=mysqli_query($conn, "SELECT * FROM tbl_tim WHERE tim_pa='KaRu' ");
while ($r=mysqli_fetch_assoc($kar)) : ?>
 <!-- Hapus-->
  <div class="modal fade" id="hapus_karu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="hidden" value="<?= $r['tim_id'] ?>" name="id">
            <button type="submit" name="hapus_karu" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>