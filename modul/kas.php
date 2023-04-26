<?php  
$y=mysqli_query($conn, "SELECT max(kas_tahun) AS th FROM tbl_kas ");
$th=mysqli_fetch_assoc($y);

  $yy=$th['th'];

?>
<?php  
if (isset($_POST['bayar_kas'])) {
  
  if (!empty($_POST['check'])) {
    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Anda Belum Membayar Bulan Kemarin</div>";
  }else{
    $id = $_POST['id'];
  $ko = $_POST['kolom'];
  $kolom = "kas_".$ko;
  $kas = $_POST['kas'];

  mysqli_query($conn, "UPDATE tbl_kas SET $kolom = '$kas' WHERE kas_id='$id' ");
  }

}
?>
<?php  
if (isset($_POST['lanjut'])) {

  $n=1;
  while ($n<=12) {
    $col="kas_".$n;
    $nul=mysqli_query($conn, "SELECT * FROM tbl_kas WHERE $col IS NULL AND kas_tahun='$yy' ");
    if (mysqli_num_rows($nul)>=1) {
      $null=1;
    }
  $n++;
  }

  if (isset($null)) {
    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Kas Masih Ada Yang Kosong</div>";
  }else{
    $t=mysqli_query($conn, "SELECT * FROM tbl_karyawan");
  while ($r=mysqli_fetch_assoc($t)) {
    $id_tim = $r['karyawan_id'];
    $nama = $r['karyawan_nama'];
    $pdk = $r['karyawan_pdk'];
    $pk = $r['karyawan_pk'];
    $pa = $r['karyawan_pa'];
    if ($yy=='') {
      $tahun = date('Y');
    }else{
      $tahun = $yy+1;
    }

    mysqli_query($conn, "INSERT INTO tbl_kas (kas_tim_id,kas_tim_nama,kas_tim_pdk,kas_tim_pk,kas_tim_pa,kas_tahun) VALUES ('$id_tim','$nama','$pdk','$pk','$pa','$tahun') ");

  }
  $confir=1;
  }
}
?>
  <a href="export_kas.php?tahun=<?= $yy ?>" target="blank" class="btn btn-success" style="float: right;">Export Excel</a>
<form action="" method="post">
  <?php if ($confir==1): ?>
    <a href="" class="btn btn-success"><i class="fa fa-calendar-check"></i> Berhasil Membuat <strong>Silahkan Klik</strong></a>
  <?php $confir = 0; ?>
  <?php else: ?>
    <button class="btn btn-info" name="lanjut" ><i class="fa fa-calendar-plus" ></i> Buat Kas Tahun Selanjutnya</button>
  <?php endif ?>
</form>
<br>
<br>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold">Kas <?php echo $yy ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th colspan="17" >Daftar Kas</th>
                    </tr>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <th>Januari</th>
                      <th>Febuari</th>
                      <th>Maret</th>
                      <th>April</th>
                      <th>Mei</th>
                      <th>Juni</th>
                      <th>Juli</th>
                      <th>Agustus</th>
                      <th>September</th>
                      <th>Oktober</th>
                      <th>November</th>
                      <th>Desember</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1; 
                    $kas=mysqli_query($conn, "SELECT * FROM tbl_kas WHERE kas_tahun='$yy' ");
                    while ($row=mysqli_fetch_assoc($kas)) : ?>
                    <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $row['kas_tim_nama'] ?></td>
                      <td><?php echo $row['kas_tim_pdk'] ?></td>
                      <td><?php echo $row['kas_tim_pk'] ?></td>
                      <td><?php echo $row['kas_tim_pa'] ?></td>
                      <?php 
                      $k=1; 
                      $totp=0;
                      while ($k<=12): ?>
                      <?php $b = $row['kas_'.$k]; ?>
                      <?php if ($k<date('m') && $yy<=date('Y') && $b==NULL ) : ?>
                        <td style="text-align: center;"><button data-toggle="modal" data-target="#id<?= $row['kas_id'] ?>kol<?= $k ?>" class="btn btn-warning btn-sm"><i class="fa fa-coins"></i></button></td>
                      <?php elseif ($k<date('m') && $yy<=date('Y') ) : ?>
                        <td style="text-align: center;"><button disabled="" data-toggle="modal" data-target="#id<?= $row['kas_id'] ?>kol<?= $k ?>" class="btn btn-success btn-sm"><?php echo number_format($row['kas_'.$k]); ?></button></td>
                      <?php elseif ($b==NULL): ?>
                        <td style="text-align: center;"><button data-toggle="modal" data-target="#id<?= $row['kas_id'] ?>kol<?= $k ?>" class="btn btn-warning btn-sm"><i class="fa fa-coins"></i></button></td>
                      <?php else: ?>
                        <td style="text-align: center;"><button data-toggle="modal" data-target="#id<?= $row['kas_id'] ?>kol<?= $k ?>" class="btn btn-success btn-sm"><?php echo number_format($row['kas_'.$k]); ?></button></td>
                        <?php $totp+=$row['kas_'.$k] ?>
                      <?php endif; ?>
                      <?php $k++; ?>
                    <?php endwhile; ?>
                      <th><?php echo number_format($totp) ?></th>
                    <?php $no++; ?>
                  <?php endwhile; ?>
                    </tr>
                    <tr>
                      <th colspan="5" style="text-align: center;">Total</th>
                      <?php  
                      $j=1; while ($j<=12) : 
                      $jj="kas_".$j;
                      $jjj=mysqli_query($conn, "SELECT sum($jj) AS bj FROM tbl_kas WHERE kas_tahun='$yy' ");
                      $jjjj=mysqli_fetch_assoc($jjj);
                      ?>
                      <?php if ($jjjj['bj']==NULL): ?>
                        <th>0</th>
                      <?php else: ?>
                        <th><?php echo number_format($jjjj['bj']) ?></th>
                        <?php $total+=$jjjj['bj'] ?>
                      <?php endif ?>
                      <?php $j++; ?>
                    <?php endwhile; ?>
                    <th><?php echo number_format($total) ?></th>
                    <?php $total=0; ?>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

<?php
$ka=mysqli_query($conn, "SELECT * FROM tbl_kas");
 while ($r=mysqli_fetch_assoc($ka)) : ?>
  <?php 
  $ms=0; 
  $m=1; 
  while ($m<=12) : ?>
  <?php 
  $ks = $r['kas_'.$m]; 
  $bs = $r['kas_'.$ms];
  $k_id = $r['kas_id'];
  ?>
  <div class="modal fade" id="id<?= $k_id ?>kol<?= $m ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="post">

        <?php if ($m==1 OR $bs!==NULL ) : ?>
          <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Bayar Kas</h5>
        <?php elseif ($bs==NULL): ?>
          <div style="background-color: red" class="modal-header">
          <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Anda Belum Membayar Bulan Sebelumnya</h5>
          <input type="hidden" value="bbs" name="check">
        <?php endif ?>

          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <th>Nama</th>
              <th> : </th>
              <th><?php echo $r['kas_tim_nama']; ?></th>
            </tr>
            <tr>
              <th>Bulan</th>
              <th> : </th>
              <th>
                <?php if ($m==1) {
                  echo "Januari";
                }elseif ($m==2) {
                  echo "Febuari";
                }elseif ($m==3) {
                  echo "Maret";
                }elseif ($m==4) {
                  echo "April";
                }elseif ($m==5) {
                  echo "Mei";
                }elseif ($m==6) {
                  echo "Juni";
                }elseif ($m==7) {
                  echo "Juli";
                }elseif ($m==8) {
                  echo "Agustus";
                }elseif ($m==9) {
                  echo "September";
                }elseif ($m==10) {
                  echo "Oktober";
                }elseif ($m==11) {
                  echo "November";
                }elseif ($m==12) {
                  echo "Desember";
                }

                ?>
              </th>
            </tr>
          </table>
          <input type="hidden" value="<?php echo $r['kas_id'] ?>" name="id">
          <input type="hidden" value="<?php echo $m ?>" name="kolom">
          <input type="number" min="1" value="<?php echo $r['kas_'.$m] ?>" class="form-control" name="kas" required="" >
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="bayar_kas" class="btn btn-warning">OK</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php 
  $m++;
  $ms++; 
  ?>
<?php endwhile; ?>
<?php endwhile; ?>