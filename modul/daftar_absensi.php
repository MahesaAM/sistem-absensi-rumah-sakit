<?php  

if (isset($_POST['go'])) {
  $bul = $_POST['bulan'];
  $tah = $_POST['tahun'];
  $_SESSION['bulan']=$bul;
  $_SESSION['tahun']=$tah;

}

?>
<?php  
$tgl = cal_days_in_month(CAL_GREGORIAN, $_SESSION['bulan'], $_SESSION['tahun']);
$bulan = $_SESSION['bulan'];
$tahun = $_SESSION['tahun'];
?>
<?php 

if (isset($_POST['ok'])) {

  $id_absen = $_POST['id'];
  $ket = $_POST['ket'];
  $kol = "absen_".$_POST['kol'];
  $kelompok = $_POST['kelompok_id'];
  
  $NN=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_id='$id_absen' ");

  if (mysqli_num_rows($NN)==0) {
    $isi = $_POST['isi'];
    if ($_POST['recover']=='PS') {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else if ($_POST['recover']=='SS') {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else if ($_POST['recover']=='SS') {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else{
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    $P=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='P' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $S=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='S' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $M=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='M' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $N=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Pagi Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Siang Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Malam Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Pagi </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Siang </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=1) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Malam </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }
    }

  }else{
    $P=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='P' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $S=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='S' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $M=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol ='M' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
    $N=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelompok' ");
      $reco = $_POST['recover'];
    if (!empty($_POST['recover']) && $reco==$ket ) {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($N)>1) {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Pagi Semua</div>";
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Siang Semua</div>";
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Malam Semua</div>";
    }else if (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Pagi </div>";
    }else if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Siang </div>";
    }else if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Malam </div>";
    }else if (mysqli_num_rows($N)==1 && empty($_POST['recover']) ) {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }
    
}

}

?>
<?php  

if (isset($_POST['tambah_anggota'])) {
  $id_kelompok = $_POST['id_kelompok'];
  $nama_kelompok = $_POST['nama_kelompok'];
  $nama = $_POST['nama'];
  $pdk = $_POST['pdk'];
  $ppja = $_POST['ppja'];

  mysqli_query($conn, "INSERT INTO tbl_tim VALUES (NULL,'$id_kolompok','$nama','$pdk','$ppja') ");
  $id_tim = $conn->insert_id;
  mysqli_query($conn, "INSERT INTO tbl_absen (absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pa,absen_bulan,absen_tahun) VALUES ('$id_kelompok','$nama_kelompok','$id_tim','$nama','$pdk','$ppja','$bulan','$tahun') ");

}

?>
<?php  

if (isset($_POST['hapus_kelompok'])) {
  $id_kelompok = $_POST['id_kelompok'];
  mysqli_query($conn, "DELETE FROM tbl_absen WHERE absen_kelompok_id='$id_kelompok' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
}

?>

  <?php if (isset($_SESSION['bulan']) && isset($_SESSION['tahun']) ): ?>

    <a href="export.php?bulan=<?= $bulan ?>&tahun=<?= $tahun ?>" target="blank" class="btn btn-success" style="float: right;">Export Excel</a>
  <?php endif ?>
<div class="container">
<form method="post" action="">
  <div class="row">
    <form>
  <select style="width: 20%;" name="bulan" class="form-control">
    <?php if ($bulan==1): ?>
    <option value="1" selected="">Januari</option>
    <?php else: ?>
    <option value="1">Januari</option>
    <?php endif ?>
    <?php if ($bulan==2): ?>
    <option value="2" selected="">Febuari</option>
    <?php else: ?>
    <option value="2">Febuari</option>
    <?php endif ?>
    <?php if ($bulan==3): ?>
    <option value="3" selected="">Maret</option>
    <?php else: ?>
    <option value="3">Maret</option>
    <?php endif ?>
    <?php if ($bulan==4): ?>
    <option value="4" selected="">April</option>
    <?php else: ?>
    <option value="4">April</option>
    <?php endif ?>
    <?php if ($bulan==5): ?>
    <option value="5" selected="">Mei</option>
    <?php else: ?>
    <option value="5">Mei</option>
    <?php endif ?>
    <?php if ($bulan==6): ?>
    <option value="6" selected="">Juni</option>
    <?php else: ?>
    <option value="6">Juni</option>
    <?php endif ?>
    <?php if ($bulan==7): ?>
    <option value="7" selected="">Juli</option>
    <?php else: ?>
    <option value="7">Juli</option>
    <?php endif ?>
    <?php if ($bulan==8): ?>
    <option value="8" selected="">Agustus</option>
    <?php else: ?>
    <option value="8">Agustus</option>
    <?php endif ?>
    <?php if ($bulan==9): ?>
    <option value="9" selected="">September</option>
    <?php else: ?>
    <option value="9">September</option>
    <?php endif ?>
    <?php if ($bulan==10): ?>
    <option value="10" selected="">Oktober</option>
    <?php else: ?>
    <option value="10">Oktober</option>
    <?php endif ?>
    <?php if ($bulan==11): ?>
    <option value="11" selected="">November</option>
    <?php else: ?>
    <option value="11">November</option>
    <?php endif ?>
    <?php if ($bulan==12): ?>
    <option value="12" selected="">Desember</option>
    <?php else: ?>
    <option value="12">Desember</option>
    <?php endif ?>
  </select>
  <select style="width: 20%;" name="tahun" class="form-control">
    <?php  
    $ta= mysqli_query($conn, "SELECT absen_tahun FROM tbl_absen GROUP BY absen_tahun ");
    while ($r=mysqli_fetch_assoc($ta)) : ?>
      <?php if ($r['absen_tahun']==$tahun): ?>
        <option value="<?php echo $r['absen_tahun'] ?>" selected ><?php echo $r['absen_tahun'] ?></option>
      <?php else: ?>
        <option value="<?php echo $r['absen_tahun'] ?>" ><?php echo $r['absen_tahun'] ?></option>
      <?php endif ?>
     <?php endwhile; ?>   
  </select>
  <button style="margin-left: 10px;" name="go" class="btn btn-success">GO</button>
</form>
</div>
</form>
</div>
<br>
<br>
<?php  

if ($bulan==1) {
  $ti = "Januari";
}elseif ($bulan==2) {
  $ti = "Febuari";
}elseif ($bulan==3) {
  $ti = "Maret";
}elseif ($bulan==4) {
  $ti = "April";
}elseif ($bulan==5) {
  $ti = "Mei";
}elseif ($bulan==6) {
  $ti = "Juni";
}elseif ($bulan==7) {
  $ti = "Juli";
}elseif ($bulan==8) {
  $ti = "Agustus";
}elseif ($bulan==9) {
  $ti = "September";
}elseif ($bulan==10) {
  $ti = "Oktober";
}elseif ($bulan==11) {
  $ti = "November";
}elseif ($bulan==12) {
  $ti = "Desember";
}

?>
<?php if (isset($bulan) && isset($tahun) ): ?>
<?php  
$result = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_bulan='$bulan' AND absen_tahun='$tahun' ");
if ($re=mysqli_num_rows($result)==0) : ?>
<h1 style="text-align: center;">Data Tidak Ada</h1>
<?php else: ?>
  <h3 style="text-align: center;"><?php echo $ti ."/". $tahun ?></h3>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <?php $karu=mysqli_query($conn, "SELECT * FROM tbl_karu WHERE karu_bulan='$bulan' AND karu_tahun='$tahun' "); ?>
                
              <h6 class="m-0 font-weight-bold text-primary">Kepala Ruangan</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                  <thead>
                      <th style="width: 40%">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                  </thead>
                  <tbody>
                      <?php  
                    while ($r=mysqli_fetch_assoc($karu)) :
                    ?>
                    <tr>
                      <td><?php echo $r['karu_nama'] ?></td>
                      <td><?php echo $r['karu_pdk'] ?></td>
                      <td><?php echo $r['karu_pk'] ?></td>
                      <td><?php echo $r['karu_pa'] ?></td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php
$kelompok=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_bulan='$bulan' AND absen_tahun='$tahun' GROUP BY absen_kelompok_nama ");
while ($kel=mysqli_fetch_assoc($kelompok)) :
?>
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $kel['absen_kelompok_nama'] ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;" colspan="4">tim</th>
                      <th style="text-align: center;" colspan="<?php echo $tgl ?>">Tanggal</th>
                      <th style="text-align: center;" colspan="7">Jumlah Jam Kerja</th>
                    </tr>
                    <tr>
                      <th style="width: 50%;">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <?php $at = 1; while ($at<=$tgl) : ?>
                      <?php if (date('D',strtotime($at."-".$bulan."-".$tahun))=='Sun') : ?>
                        <th style="text-align: center;background-color: red;color: white;"><?php echo $at ?></th>
                      <?php elseif ($at==date('d')): ?>
                        <th style="text-align: center;background-color: yellow;"><?php echo $at ?></th>
                      <?php else: ?>
                        <th style="text-align: center;"><?php echo $at ?></th>
                      <?php endif ?>
                      <?php $at++ ?>
                      <?php endwhile; ?>
                      <th>P</th>
                      <th>S</th>
                      <th>M</th>
                      <th>CT</th>
                      <th>DL</th>
                      <th>R</th>
                      <th>JML</th>
                      <th>JAM</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  
                    $id = $kel['absen_kelompok_id'];
                    $query = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_kelompok_id='$id' ");
                    while ($r=mysqli_fetch_assoc($query)) :
                    ?>
                    <?php if ($r['absen_bulan']==$bulan && $r['absen_tahun']==$tahun ): ?>
                    <tr>
                      <td><?php echo $r['absen_tim_nama'] ?></td>
                      <td><?php echo $r['absen_tim_pdk'] ?></td>
                      <td><?php echo $r['absen_tim_pk'] ?></td>
                      <td><?php echo $r['absen_tim_pa'] ?></td>
                      <?php $P=0; ?>
                      <?php $S=0; ?>
                      <?php $M=0; ?>
                      <?php $CT=0; ?>
                      <?php $DL=0; ?>
                      <?php $R=0; ?>
                      <?php $JML=0; ?>
                      <?php $ab = 1; while ($ab<=$tgl) : ?>
                        <td style="text-align: center;">
                        <?php if ($r['absen_'.$ab]==NULL): ?>
                          <button data-toggle="modal" data-target="#a<?= $r['absen_id'] ?>b<?= $ab ?>" class="btn btn-success"><i class="fa fa-plus"></i></button>
                          <?php $_SESSION['null']=1 ?>
                        <?php elseif ($ab>=date('d') && $bulan>=date('m') && $tahun>=date('Y') ) : ?>
                          <button data-toggle="modal" data-target="#a<?= $r['absen_id'] ?>b<?= $ab ?>" class="btn btn-info"><strong><?php echo $r['absen_'.$ab] ?></strong></button>
                        <?php else: ?>
                          <button disabled="" data-toggle="modal" data-target="#a<?= $r['absen_id'] ?>b<?= $ab ?>" class="btn btn-info"><strong><?php echo $r['absen_'.$ab] ?></strong></button>
                        <?php endif ?>
                      </td>
                      
                      <?php if ($r['absen_'.$ab]=='P'): ?>
                        <?php $P+=1; ?>
                      <?php elseif ($r['absen_'.$ab]=='S'): ?>
                        <?php $S+=1; ?>
                      <?php elseif ($r['absen_'.$ab]=='M'): ?>
                        <?php $M+=1; ?>
                      <?php elseif ($r['absen_'.$ab]=='CT'): ?>
                        <?php $CT+=1; ?>
                      <?php elseif ($r['absen_'.$ab]=='DL'): ?>
                        <?php $DL+=1; ?>
                      <?php elseif ($r['absen_'.$ab]=='R'): ?>
                        <?php $R+=1; ?>
                      <?php endif ?>
                      <?php $ab++ ?>
                      <?php endwhile; ?>
                      <?php $P*=7 ?>
                      <?php $S*=7 ?>
                      <?php $M*=10 ?>
                      <?php $CT*=7 ?>
                      <?php $DL*=7 ?>
                      <?php $R*=8.5 ?>
                      <?php $JML=$P+$S+$M+$CT+$DL+$R ?>
                      <td><?php echo $P ?></td>
                      <td><?php echo $S ?></td>
                      <td><?php echo $M ?></td>
                      <td><?php echo $CT ?></td>
                      <td><?php echo $DL ?></td>
                      <td><?php echo $R ?></td>
                      <td><?php echo $JML ?></td>
                      <td><?php echo $JML-175 ?></td>
                    </tr>
                    <?php endif ?>
                    <?php $P=0; ?>
                      <?php $S=0; ?>
                      <?php $M=0; ?>
                      <?php $CT=0; ?>
                      <?php $DL=0; ?>
                      <?php $R=0; ?>
                      <?php $JML=0; ?>
                  <?php endwhile; ?>
                  <tr>
                    <th colspan="4">Jaga Pagi</th>
                    <?php 
                    $p =1; 
                    while ($p <= $tgl) :
                    $jp = "absen_".$p;
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND tim_kelompok_id='$id' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($r=mysqli_fetch_assoc($pp)) :
                    ?>
                    <th style="text-align: center;"><?php echo $r['p'] ?></th>
                  <?php endwhile; ?>
                    <?php $p++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="4">Jaga Petang</th>
                    <?php 
                    $s =1; 
                    while ($s <= $tgl) :
                    $js = "absen_".$s;
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND tim_kelompok_id='$id' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($sss=mysqli_fetch_assoc($ss)) :
                    ?>
                    <th style="text-align: center;"><?php echo $sss['s'] ?></th>
                  <?php endwhile; ?>
                    <?php $s++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="4">Jaga Malam</th>
                    <?php 
                    $m =1; 
                    while ($m <= $tgl) :
                    $jm = "absen_".$m;
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND tim_kelompok_id='$id' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($mmm=mysqli_fetch_assoc($mm)) :
                    ?>
                    <th style="text-align: center;"><?php echo $mmm['m'] ?></th>
                  <?php endwhile; ?>
                    <?php $m++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="4">Libur</th>
                    <?php 
                    $l =1; 
                    while ($l <= $tgl) :
                    $jl = "absen_".$l;
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND tim_kelompok_id='$id' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($lll=mysqli_fetch_assoc($ll)) :
                    ?>
                    <th style="text-align: center;"><?php echo $lll['l'] ?></th>
                  <?php endwhile; ?>
                    <?php $l++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="4">Cuti</th>
                    <?php 
                    $c =1; 
                    while ($c <= $tgl) :
                    $jc = "absen_".$c;
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND tim_kelompok_id='$id' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($ccc=mysqli_fetch_assoc($cc)) :
                    ?>
                    <th style="text-align: center;"><?php echo $ccc['c'] ?></th>
                  <?php endwhile; ?>
                    <?php $c++; ?>
                  <?php endwhile; ?>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php endwhile; ?>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $kel['absen_kelompok_nama'] ?></h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" cellspacing="0">
                    <tr>
                      <th colspan="3"></th>
                      <?php  
                      $t =1; 
                      while ($t <= $tgl) :
                      ?>
                        <th><?php echo $t++ ?></th>
                      <?php endwhile; ?>
                    </tr>
                    <tr>
                    <th colspan="3">Jaga Pagi</th>
                    <?php 
                    $p =1; 
                    while ($p <= $tgl) :
                    $jp = "absen_".$p;
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($r=mysqli_fetch_assoc($pp)) :
                    ?>
                    <th style="text-align: center;"><?php echo $r['p'] ?></th>
                  <?php endwhile; ?>
                    <?php $p++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="3">Jaga Petang</th>
                    <?php 
                    $s =1; 
                    while ($s <= $tgl) :
                    $js = "absen_".$s;
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($sss=mysqli_fetch_assoc($ss)) :
                    ?>
                    <th style="text-align: center;"><?php echo $sss['s'] ?></th>
                  <?php endwhile; ?>
                    <?php $s++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="3">Jaga Malam</th>
                    <?php 
                    $m =1; 
                    while ($m <= $tgl) :
                    $jm = "absen_".$m;
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($mmm=mysqli_fetch_assoc($mm)) :
                    ?>
                    <th style="text-align: center;"><?php echo $mmm['m'] ?></th>
                  <?php endwhile; ?>
                    <?php $m++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="3">Libur</th>
                    <?php 
                    $l =1; 
                    while ($l <= $tgl) :
                    $jl = "absen_".$l;
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($lll=mysqli_fetch_assoc($ll)) :
                    ?>
                    <th style="text-align: center;"><?php echo $lll['l'] ?></th>
                  <?php endwhile; ?>
                    <?php $l++; ?>
                  <?php endwhile; ?>
                  </tr>
                  <tr>
                    <th colspan="3">Cuti</th>
                    <?php 
                    $c =1; 
                    while ($c <= $tgl) :
                    $jc = "absen_".$c;
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND absen_bulan='$bulan' AND absen_tahun='$tahun' ");
                    while ($ccc=mysqli_fetch_assoc($cc)) :
                    ?>
                    <th style="text-align: center;"><?php echo $ccc['c'] ?></th>
                  <?php endwhile; ?>
                    <?php $c++; ?>
                  <?php endwhile; ?>
                  </tr>
</table>
              </div>
            </div>
          </div>
<?php endif; ?>
<?php endif; ?>

<?php  
$q = mysqli_query($conn, "SELECT * FROM tbl_absen");
while ($r=mysqli_fetch_assoc($q)) : ?>
  <?php $a = 1; while ($a<=$tgl) : ?>
  <?php $tang = "absen_".$a; ?>
  <div class="modal fade" id="a<?= $r['absen_id'] ?>b<?= $a ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="post">
        <?php  
          $kelo = $r['absen_kelompok_id'];
          $P=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $tang ='P' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelo' ");
          $S=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $tang ='S' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelo' ");
          $M=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $tang ='M' AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelo' ");
          $N=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $tang IS NULL AND absen_bulan='$bulan' AND absen_tahun='$tahun' AND absen_kelompok_id='$kelo' ");
          ?>
          
            <?php if (mysqli_num_rows($S)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=2  ) : ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Tidak Boleh Dinas Pagi Semua</h5>
            <input type="hidden" value="PS" name="recover">
            <?php elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=2  ) : ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Tidak Boleh Dinas Siang Semua</h5>
            <input type="hidden" value="SS" name="recover">
            <?php elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)==0 && mysqli_num_rows($N)<=2  ) : ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Tidak Boleh Dinas Malam Semua</h5>
            <input type="hidden" value="MS" name="recover">
            <?php elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($N)==1 ): ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Harus Ada Dinas Pagi</h5>
            <input type="hidden" value="P" name="recover">
            <?php elseif (mysqli_num_rows($S)==0 && mysqli_num_rows($N)==1 ): ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Harus Ada Dinas Siang</h5>
            <input type="hidden" value="S" name="recover">
            <?php elseif (mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ): ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-angry"></i> Harus Ada Dinas Malam</h5>
            <input type="hidden" value="M" name="recover">
            <?php else: ?>
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Keterangan</h5>
            <?php endif ?>

            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <table>
            <tr>
              <td>Nama</td>
              <td> : </td>
              <td><?php echo $r['absen_tim_nama'] ?></td>
            </tr>
            <tr>
              <td>Tanggal</td>
              <td> : </td>
              <td><?php echo $a."-".$r['absen_bulan']."-".$r['absen_tahun'] ?></td>
            </tr>
          </table>
          <br>
          
            <input type="hidden" value="<?= $r['absen_id'] ?>" name="id">
            <input type="hidden" value="<?= $a ?>" name="kol">
            <input type="hidden" value="<?= $r['absen_kelompok_id'] ?>" name="kelompok_id">
            <?php 
            $ko="absen_".$a;
            $ia=$r['absen_id'];
            $si=mysqli_query($conn, "SELECT $ko,absen_id FROM tbl_absen WHERE absen_id='$ia' "); 
            $is=mysqli_fetch_assoc($si);
            ?>
            <input type="hidden" value="<?= $is[$ko] ?>" name="isi">
          <select class="form-control" name="ket">
            <?php  
            $k = mysqli_query($conn, "SELECT * FROM tbl_keterangan");
            while ($ke=mysqli_fetch_assoc($k)) :
            ?>
            <option value="<?= $ke['keterangan_alias'] ?>" ><?php echo $ke['keterangan_alias']." - ".$ke['keterangan_nama'] ?></option>
          <?php endwhile; ?>
          </select>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-info" name="ok">OK</button>
        </form>
        </div>
      </div>
    </div>
  </div>
  <?php $a++ ?>
<?php endwhile; ?>
<?php endwhile; ?>