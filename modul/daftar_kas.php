<?php  

if (isset($_POST['go'])) {
  $tah = $_POST['tahun'];
  $_SESSION['tahun']=$tah;

}

?>
<?php  
$yy = $_SESSION['tahun']; 
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

<form action="" method="post">
   <a href="export_kas.php?tahun=<?= $yy ?>" target="blank" class="btn btn-success" style="float: right;">Export Excel</a>
  <div class="container">
  	<div class="row">
  	<select style="width: 20%;" name="tahun" class="form-control">
    <?php  
    $ta= mysqli_query($conn, "SELECT kas_tahun FROM tbl_kas GROUP BY kas_tahun ");
    while ($r=mysqli_fetch_assoc($ta)) : ?>
      <?php if ($r['kas_tahun']==$yy): ?>
      	<option value="<?php echo $r['kas_tahun'] ?>" selected ><?php echo $r['kas_tahun'] ?></option>
      	<?php else: ?>
      	<option value="<?php echo $r['kas_tahun'] ?>" ><?php echo $r['kas_tahun'] ?></option>
      <?php endif ?>
     <?php endwhile; ?>   
  </select>
  <button style="margin-left: 10px;" name="go" class="btn btn-success">GO</button>
  </div>
  </div>
</form>
<br>
<br>

<?php if (isset($yy)): ?>
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
<?php endif ?>

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
          <input type="number" min="1" value="<?php echo $r['kas_'.$m] ?>" class="form-control" name="kas">
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