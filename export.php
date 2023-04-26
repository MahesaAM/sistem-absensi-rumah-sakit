<?php  

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=jadwal.xls");
include 'koneksi.php';
?>

<?php  
$dd = $_GET['bulan'];
$yy = $_GET['tahun'];
$tgl = cal_days_in_month(CAL_GREGORIAN, $dd, $yy);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$kelompok=mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_bulan='$dd' AND absen_tahun='$yy' GROUP BY absen_kelompok_nama ");
while ($kel=mysqli_fetch_assoc($kelompok)) :
?>

                <table border="1" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="text-align: center;" colspan="3"><?php echo $kel['absen_kelompok_nama'] ?></th>
                      <th style="text-align: center;" colspan="<?php echo $tgl ?>">Tanggal</th>
                      <th style="text-align: center;" colspan="7">Jumlah Jam Kerja</th>
                    </tr>
                    <tr>
                      <th style="width: 50%;">Nama</th>
                      <th>PDK</th>
                      <th>PA</th>
                      <?php $at = 1; while ($at<=$tgl) : ?>
                          <th style="text-align: center;"><?php echo $at ?></th>
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
                    <?php if ($r['absen_bulan']==$dd && $r['absen_tahun']==$yy ): ?>
                    <tr>
                      <td><?php echo $r['absen_tim_nama'] ?></td>
                      <td><?php echo $r['absen_tim_pdk'] ?></td>
                      <td><?php echo $r['absen_tim_pa'] ?></td>
                      <?php $P=0; ?>
                      <?php $S=0; ?>
                      <?php $M=0; ?>
                      <?php $CT=0; ?>
                      <?php $DL=0; ?>
                      <?php $R=0; ?>
                      <?php $JML=0; ?>
                      <?php $ab = 1; while ($ab<=$tgl) : ?>
                        <td style="text-align: center;"><?php echo $r['absen_'.$ab] ?></td>
                      
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
                      <td><?php echo $JML-174 ?></td>
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
                    <th colspan="3">Jaga Pagi</th>
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
                    <th colspan="3">Jaga Petang</th>
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
                    <th colspan="3">Jaga Malam</th>
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
                    <th colspan="3">Libur</th>
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
                    <th colspan="3">Cuti</th>
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
<?php endwhile; ?>
<table border="1" cellspacing="0">
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
</body>
</html>