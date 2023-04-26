<?php  

$y=mysqli_query($conn, "SELECT max(absen_tahun) AS th FROM tbl_absen ");
$th=mysqli_fetch_assoc($y);
$yy=$th['th'];
$d=mysqli_query($conn, "SELECT max(absen_bulan) AS bl FROM tbl_absen WHERE absen_tahun='$yy' ");
$bl=mysqli_fetch_assoc($d);
$dd=$bl['bl'];
?>
<?php  
$tgl = cal_days_in_month(CAL_GREGORIAN, $dd, $yy);
?>
<?php  

if (isset($_POST['lanjut'])) {
  $n=1;
  while ($n<=$tgl) {
    $col="absen_".$n;
    $nul=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $col IS NULL AND absen_bulan='$dd' AND absen_tahun='$yy' ");
    if (mysqli_num_rows($nul)>=1) {
      $null=1;
    }
  $n++;
  }
  if (isset($null)) {
    echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Ada Absen Yang Kosong</div>";
  }else{
    $chab=mysqli_query($conn, "SELECT absen_id FROM tbl_absen ");
   	if (mysqli_num_rows($chab)==0) {
   	$bulan = date('m');
   	$tahun = date('Y');
  $t=mysqli_query($conn, "SELECT * FROM tbl_tim");
  while ($r=mysqli_fetch_assoc($t)) {
    $id_tim = $r['tim_id'];
    $id_kelompok = $r['tim_kelompok_id'];
    $k=mysqli_query($conn, "SELECT * FROM tbl_kelompok WHERE kelompok_id='$id_kelompok' ");
    $kel=mysqli_fetch_assoc($k);
    $id_kelompok = $kel['kelompok_id'];
    $nama_kelompok = $kel['kelompok_nama'];
    $nama = $r['tim_nama'];
    $pdk = $r['tim_pdk'];
    $pk = $r['tim_pk'];
    $pa = $r['tim_pa'];
    if ($r['tim_pa']=='KaRu') {
    mysqli_query($conn, "INSERT INTO tbl_karu VALUES (NULL,'$nama','$pdk','$pk','$pa','$bulan','$tahun') ");
    }else{
    $buat=mysqli_query($conn, "INSERT INTO tbl_absen (absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun) VALUES ('$id_kelompok','$nama_kelompok','$id_tim','$nama','$pdk','$pk','$pa','$bulan','$tahun') ");
	}
  }
  $confir = 1;
   	}else{
   		if ($dd>=12) {
    $bulan = 1;
    $tahun = $yy+1;
  }else{
    $bulan = $dd+1;
    $tahun = $yy;
  }
  $t=mysqli_query($conn, "SELECT * FROM tbl_tim");
  while ($r=mysqli_fetch_assoc($t)) {
    $id_tim = $r['tim_id'];
    $id_kelompok = $r['tim_kelompok_id'];
    $k=mysqli_query($conn, "SELECT * FROM tbl_kelompok WHERE kelompok_id='$id_kelompok' ");
    $kel=mysqli_fetch_assoc($k);
    $id_kelompok = $kel['kelompok_id'];
    $nama_kelompok = $kel['kelompok_nama'];
    $nama = $r['tim_nama'];
    $pdk = $r['tim_pdk'];
    $pk = $r['tim_pk'];
    $pa = $r['tim_pa'];
    if ($r['tim_pa']=='KaRu') {
    mysqli_query($conn, "INSERT INTO tbl_karu VALUES (NULL,'$nama','$pdk','$pk','$pa','$bulan','$tahun') ");
    }else{
    $buat=mysqli_query($conn, "INSERT INTO tbl_absen (absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun) VALUES ('$id_kelompok','$nama_kelompok','$id_tim','$nama','$pdk','$pk','$pa','$bulan','$tahun') ");
	}
  }
  $confir = 1;
   	}
  }
}

?>

<?php 

if (isset($_POST['ok'])) {

  $id_absen = $_POST['id'];
  $ket = $_POST['ket'];
  $kol = "absen_".$_POST['kol'];
  $kolseb = "absen_".$_POST['kolseb'];
  $kelompok = $_POST['kelompok_id'];
  
  $NN=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_id='$id_absen' ");

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
    $P=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol ='P' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $S=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol ='S' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $M=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $N=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $MP=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kolseb ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_id='$id_absen' ");
    if (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Pagi Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Siang Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Malam Semua</div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Pagi </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)<=1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Siang </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)<=1) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Malam </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }elseif ($_POST['kol']>1 && mysqli_num_rows($MP)==1 && $ket=='P' ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Setelah Dinas Malam Tidak Boleh Dinas Pagi </div>";
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$isi' WHERE absen_id='$id_absen'  ");
    }
    }

  }else{
    $P=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol ='P' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $S=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol ='S' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $M=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_ab
      sen WHERE $kol ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $N=mysqli_query($conn, "SELECT $kol,absen_bulan,absen_tahun,absen_id FROM tbl_absen WHERE $kol IS NULL AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelompok' ");
    $MP=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE $kolseb ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_id='$id_absen' ");
      $reco = $_POST['recover'];
    if (mysqli_num_rows($MP)==1 && $ket=='P' ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Setelah Dinas Malam Tidak Boleh Dinas Pagi </div>";
    }elseif (!empty($_POST['recover']) && $reco==$ket ) {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }else if (mysqli_num_rows($N)>1) {
      mysqli_query($conn, "UPDATE tbl_absen SET  $kol ='$ket' WHERE absen_id='$id_absen'  ");
    }elseif (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Pagi Semua</div>";
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Siang Semua</div>";
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tidak Boleh Dinas Malam Semua</div>";
    }elseif (mysqli_num_rows($P)==0 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Pagi </div>";
    }elseif (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)==0 && mysqli_num_rows($M)>=1 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Siang </div>";
    }elseif (mysqli_num_rows($P)>=1 && mysqli_num_rows($S)>=1 && mysqli_num_rows($M)==0 && mysqli_num_rows($N)==1 ) {
      echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>Tolong Isikan Dengan Benar, Harus Ada Dinas Malam </div>";
    }
    
}

}

?>

<?php  

if (isset($_POST['hapus_kelompok'])) {
  $id_kelompok = $_POST['id_kelompok'];
  mysqli_query($conn, "DELETE FROM tbl_absen WHERE absen_kelompok_id='$id_kelompok' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
}

?>
<?php  

if (isset($_POST['hapus_anggota'])) {
  $id = $_POST['id'];
  mysqli_query($conn, "DELETE FROM tbl_absen WHERE absen_id='$id' ");
}

?>
<?php  

if (isset($_POST['hapus_karu'])) {
  mysqli_query($conn, "DELETE FROM tbl_karu WHERE karu_bulan='$dd' AND karu_tahun='$yy' ");
}

?>
  <a style="float: right;" href="cetak.php?bulan=<?= $dd ?>&tahun=<?= $yy ?>" target="black" class="btn btn-info"><i class="fa fa-print"></i> Export PDF</a>
  <a href="export.php?bulan=<?= $dd ?>&tahun=<?= $yy ?>" target="blank" class="btn btn-success" style="float: right;">Export Excel</a>
  <?php if ($confir==1): ?>
  <a href="" class="btn btn-success"><i class="fa fa-calendar-check"></i> Berhasil Membuat Jadwal <strong>Silahkan Klik</strong></a>
  <?php $confir = 0; ?>
  <?php else: ?>
<form action="" method="post">
  <button class="btn btn-info" name="lanjut" ><i class="fa fa-calendar-plus" ></i> Buat Jadwal Bulan Selanjutnya</button>
</form>
  <?php endif ?>
<?php  

if ($dd==1) {
  $ti = "Januari";
}elseif ($dd==2) {
  $ti = "Febuari";
}elseif ($dd==3) {
  $ti = "Maret";
}elseif ($dd==4) {
  $ti = "April";
}elseif ($dd==5) {
  $ti = "Mei";
}elseif ($dd==6) {
  $ti = "Juni";
}elseif ($dd==7) {
  $ti = "Juli";
}elseif ($dd==8) {
  $ti = "Agustus";
}elseif ($dd==9) {
  $ti = "September";
}elseif ($dd==10) {
  $ti = "Oktober";
}elseif ($dd==11) {
  $ti = "November";
}elseif ($dd==12) {
  $ti = "Desember";
}

?>
<h3 style="text-align: center;"><?php echo $ti ."/". $yy ?></h3>
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <?php $karu=mysqli_query($conn, "SELECT * FROM tbl_karu WHERE karu_bulan='$dd' AND karu_tahun='$yy' "); ?>
                
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
                      <th style="text-align: center;">Action</th>
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
                      <td style="text-align: center;">
                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus_karu"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php
$kelompok=mysqli_query($conn, "SELECT absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun FROM tbl_absen WHERE absen_bulan='$dd' AND absen_tahun='$yy' GROUP BY absen_kelompok_nama ");
while ($kel=mysqli_fetch_assoc($kelompok)) :
?>
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><?php echo $kel['absen_kelompok_nama'] ?></h6>
              <button class="btn btn-danger" style="float: right;" data-toggle="modal" data-target="#hapus_kelompok<?= $kel['absen_kelompok_id'] ?>"><i class="fa fa-times"></i></button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;" colspan="4">tim</th>
                      <th style="text-align: center;" colspan="<?php echo $tgl ?>">Tanggal</th>
                      <th style="text-align: center;" colspan="8">Jumlah Jam Kerja</th>
                    </tr>
                    <tr>
                      <th style="width: 50%;">Nama</th>
                      <th>PDK</th>
                      <th>PK</th>
                      <th>PA</th>
                      <?php $at = 1; while ($at<=$tgl) : ?>
                      <?php if (date('D',strtotime($at."-".$dd."-".$yy))=='Sun' ) : ?>
                        <th style="text-align: center;background-color: red;color: white;"><?php echo $at ?></th>
                      <?php elseif ($at==date('d') && $dd==date('m') ): ?>
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
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  
                    $id = $kel['absen_kelompok_id'];
                    $query = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_kelompok_id='$id' ");
                    while ($r=mysqli_fetch_assoc($query)) :
                    ?>
                    <?php if ($r['absen_bulan']==$dd && $r['absen_tahun']==$yy ): ?>
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
                      <?php  
                      $kolom = $r['absen_'.$ab];
                      $nul=mysqli_query($conn, "SELECT $kolom,absen_bulan,absen_tahun FROM tbl_absen WHERE $kolom = 'NULL' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                      if (mysqli_num_rows($nul)>=1) {
                        $_SESSION['null']=1;
                      }else{
                        $_SESSION['null']=0;
                      }
                      ?>
                      <?php if ($ab==date('d') && $dd==date('m') ): ?>
                        <td style="text-align: center;background-color: yellow;">
                      <?php else: ?>
                        <td style="text-align: center;">
                      <?php endif ?>
                        <?php if ($kolom==NULL): ?>
                          <button data-toggle="modal" data-target="#a<?= $r['absen_id'] ?>b<?= $ab ?>" class="btn btn-success"><i class="fa fa-plus"></i></button>
                          <?php $_SESSION['null']=1 ?>
                        <?php elseif ($ab>=date('d') && $dd>=date('m') && $yy>=date('Y') ) : ?>
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
                      <?php $PP=$P*7 ?>
                      <?php $SS=$S*7 ?>
                      <?php $MM=$M*10 ?>
                      <?php $CTT=$CT*7 ?>
                      <?php $DLL=$DL*7 ?>
                      <?php $RR=$R*8.5 ?>
                      <?php $JML=$PP+$SS+$MM+$CTT+$DLL+$RR ?>
                      <td><?php echo $PP ?></td>
                      <td><?php echo $SS ?></td>
                      <td><?php echo $MM ?></td>
                      <td><?php echo $CTT ?></td>
                      <td><?php echo $DLL ?></td>
                      <td><?php echo $RR ?></td>
                      <td><?php echo $JML ?></td>
                      <td><?php echo $JML-175 ?></td>
                      <td>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $r['absen_id'] ?>"><i class="fa fa-times"></i></button>
                      </td>
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
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
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


<?php  
$q = mysqli_query($conn, "SELECT absen_id,absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun FROM tbl_absen");
while ($r=mysqli_fetch_assoc($q)) : ?>
  <?php $b = 0; $a = 1; while ($a<=$tgl) : ?>
  <div class="modal fade" id="a<?= $r['absen_id'] ?>b<?= $a ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="post">
        <?php  
          $tang = "absen_".$a; 
          $cek =  "absen_".$b;
          $tim_id = $r['absen_tim_id'];
          $kelo = $r['absen_kelompok_id'];
          if ($a>=20) { 
           $h=20; while ($h <= $tgl) {
            $ko="absen_".$h;
            $cm=mysqli_query($conn, "SELECT $ko,absen_id FROM tbl_absen WHERE $ko = 'M' AND absen_id='$ia' ");
            $cn=mysqli_query($conn, "SELECT $ko,absen_id FROM tbl_absen WHERE $ko IS NULL AND absen_id='$ia' ");
            if (mysqli_num_rows($cm)==1) {
              $totm+=1;
            }elseif (mysqli_num_rows($cn)==1) {
              $totn+=1;
            }
            $h++;
          }
          $hn= (6-$totm);
        }
          $P=mysqli_query($conn, "SELECT $tang,absen_bulan,absen_tahun,absen_kelompok_id FROM tbl_absen WHERE $tang ='P' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelo' ");
          $S=mysqli_query($conn, "SELECT $tang,absen_bulan,absen_tahun,absen_kelompok_id FROM tbl_absen WHERE $tang ='S' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelo' ");
          $M=mysqli_query($conn, "SELECT $tang,absen_bulan,absen_tahun,absen_kelompok_id FROM tbl_absen WHERE $tang ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelo' ");
          $N=mysqli_query($conn, "SELECT $tang,absen_bulan,absen_tahun,absen_kelompok_id FROM tbl_absen WHERE $tang IS NULL AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_kelompok_id='$kelo' ");
          $MP=mysqli_query($conn, "SELECT $tang,absen_bulan,absen_tahun,absen_kelompok_id FROM tbl_absen WHERE $cek ='M' AND absen_bulan='$dd' AND absen_tahun='$yy' AND absen_tim_id='$tim_id' ");
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
            <?php elseif ($a>1 && mysqli_num_rows($MP)==1 ) : ?>
            <div style="background-color: orange;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Setelah Dinas Malam Tidak Boleh Dinas Pagi</h5>
            <input type="hidden" value="P" name="recover">
            <?php elseif ($a>=25) : ?>
            <div style="background-color: red;" class="modal-header">
            <h5 style="color: white;" class="modal-title" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Dinas Malam Anda Sejak tgl 20 Masih <?php echo $totm ?>X</h5>
            <input type="hidden" value="P" name="recover">
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
            <input type="hidden" value="<?= $b ?>" name="kolseb">
            <input type="hidden" value="<?= $r['absen_kelompok_id'] ?>" name="kelompok_id">
            <?php 
            $ko="absen_".$a;
            $ia=$r['absen_id'];
            $si=mysqli_query($conn, "SELECT $ko,absen_id FROM tbl_absen WHERE absen_id='$ia' "); 
            $is=mysqli_fetch_assoc($si);
            ?>
            <input type="hidden" value="<?= $is[$ko] ?>" name="isi">
          <?php if ($a>=20): ?>
          <strong style="color: gray;" ><i class="fa fa-info-circle"></i> Setelah Tgl 20-21 Dinas Malam Minimal 6x</strong>
          <?php endif ?>
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
  <?php $totm=0; ?>
  <?php $totn=0; ?>
  <?php $a++ ?>
  <?php $b++ ?>
<?php endwhile; ?>
<?php endwhile; ?>

<?php $kel=mysqli_query($conn, "SELECT absen_kelompok_id,absen_kelompok_nama FROM tbl_absen GROUP BY absen_kelompok_id ");
while ($row=mysqli_fetch_assoc($kel)) : ?>
 <!-- Hapus-->
  <div class="modal fade" id="hapus_kelompok<?= $row['absen_kelompok_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus Jadwal <strong><?php echo $row['absen_kelompok_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $row['absen_kelompok_id'] ?>" name="id_kelompok">
            <button type="submit" name="hapus_kelompok" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; ?>

<?php  
$que = mysqli_query($conn, "SELECT absen_id,absen_tim_nama,absen_bulan,absen_tahun FROM tbl_absen ");
while ($r=mysqli_fetch_assoc($que)) : ?>
<?php if ($r['absen_bulan']==$dd && $r['absen_tahun']==$yy ): ?>
 <!-- Hapus-->
  <div class="modal fade" id="hapus<?= $r['absen_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Hapus</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Apa Anda Yakin Akan Menghapus <strong><?php echo $r['absen_tim_nama'] ?></strong> </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form method="post" action="">
            <input type="hidden" value="<?php echo $r['absen_id'] ?>" name="id">
            <button type="submit" name="hapus_anggota" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php endwhile; ?>

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
            <button type="submit" name="hapus_karu" class="btn btn-danger">Hapus</button>
          </form>
        </div>
      </div>
    </div>
  </div>