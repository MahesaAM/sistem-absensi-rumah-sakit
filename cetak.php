<?php

require_once __DIR__ . '/vendor/autoload.php';

include "koneksi.php";
$dd = $_GET['bulan'];
$yy = $_GET['tahun'];
$tgl = cal_days_in_month(CAL_GREGORIAN, $dd, $yy);
$html = "<!DOCTYPE html>
<html>
<head>
      <title>Cetak</title>
</head>
<body>";

$kelompok=mysqli_query($conn, "SELECT absen_kelompok_id,absen_kelompok_nama,absen_tim_id,absen_tim_nama,absen_tim_pdk,absen_tim_pk,absen_tim_pa,absen_bulan,absen_tahun FROM tbl_absen WHERE absen_bulan='$dd' AND absen_tahun='$yy' GROUP BY absen_kelompok_nama ");
while ($kel=mysqli_fetch_assoc($kelompok)) {

                $html.="<table border='1' width='100%' cellspacing='0'>";
                  $html.="<thead>";
                    $html.="<tr>";
                      $html.="<th style='text-align: center;' colspan='3'>".  $kel['absen_kelompok_nama']."</th>";
                      $html.="<th style='text-align: center;' colspan='".  $tgl ."'>Tanggal</th>";
                      $html.="<th style='text-align: center;' colspan='7'>Jumlah Jam Kerja</th>";
                      $html.="</tr>";
                      $html.="<tr>";
                      $html.="<th>Nama</th>";
                      $html.="<th>PDK</th>";
                      $html.="<th>PA</th>";
                      $at = 1; while ($at<=$tgl) :
                      $html.="<th style='text-align: center;'>".  $at ."</th>";
                      $at++;
                      endwhile;
                      $html.="<th>P</th>";
                      $html.="<th>S</th>";
                      $html.="<th>M</th>";
                      $html.="<th>CT</th>";
                      $html.="<th>DL</th>";
                      $html.="<th>R</th>";
                      $html.="<th>JML</th>";
                      $html.="<th>JAM</th>";
                      $html.="</tr>";
                      $html.="</thead>";
                      $html.="<tbody>";
                    $id = $kel['absen_kelompok_id'];
                    $query = mysqli_query($conn, "SELECT * FROM tbl_absen WHERE absen_kelompok_id='$id' ");
                    while ($r=mysqli_fetch_assoc($query)) :
                    if ($r['absen_bulan']==$dd && $r['absen_tahun']==$yy ): 
                    $html.="<tr>";
                      $html.="<td>". $r['absen_tim_nama'] ."</td>";
                      $html.="<td>". $r['absen_tim_pdk'] ."</td>";
                      $html.="<td>". $r['absen_tim_pa'] ."</td>";
                       $P=0; 
                       $S=0; 
                       $M=0; 
                       $CT=0; 
                       $DL=0; 
                       $R=0; 
                       $JML=0; 
                       $ab = 1; while ($ab<=$tgl) : 
                        $html.="<td style='text-align: center;'>".  $r['absen_'.$ab] ."</td>";
                      
                       if ($r['absen_'.$ab]=='P'): 
                         $P+=1; 
                       elseif ($r['absen_'.$ab]=='S'): 
                         $S+=1; 
                       elseif ($r['absen_'.$ab]=='M'): 
                         $M+=1; 
                       elseif ($r['absen_'.$ab]=='CT'): 
                         $CT+=1; 
                       elseif ($r['absen_'.$ab]=='DL'): 
                         $DL+=1; 
                       elseif ($r['absen_'.$ab]=='R'): 
                         $R+=1; 
                       endif; 
                       $ab++;
                       endwhile; 
                       $P*=7;
                       $S*=7; 
                       $M*=10; 
                       $CT*=7; 
                       $DL*=7; 
                       $R*=8.5; 
                       $JML=$P+$S+$M+$CT+$DL+$R; 
                      $html.="<td>".  $P ."</td>";
                      $html.="<td>".  $S ."</td>";
                      $html.="<td>".  $M ."</td>";
                      $html.="<td>".  $CT ."</td>";
                      $html.="<td>".  $DL ."</td>";
                      $html.="<td>".  $R ."</td>";
                      $html.="<td>".  $JML ."</td>";
                      $html.="<td>".  ($JML-175) ."</td>";
                      $html.="</tr>";
                     endif; 
                       $P=0; 
                       $S=0; 
                       $M=0; 
                       $CT=0; 
                       $DL=0; 
                       $R=0; 
                       $JML=0; 
                   endwhile; 
                  $html.="<tr>";
                  $html.="<th colspan='3'>Jaga Pagi</th>";
                     
                    $p =1; 
                    while ($p <= $tgl) :
                    $jp = "absen_".$p;
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($r=mysqli_fetch_assoc($pp)) :
                    
                    $html.="<th style='text-align: center;'>".  $r['p'] ."</th>";
                   endwhile; 
                     $p++; 
                   endwhile; 
                  $html.="</tr>";
                  $html.="<tr>";
                    $html.="<th colspan='3'>Jaga Petang</th>";
                     
                    $s =1; 
                    while ($s <= $tgl) :
                    $js = "absen_".$s;
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($sss=mysqli_fetch_assoc($ss)) :
                    
                    $html.="<th style='text-align: center;'>".  $sss['s'] ."</th>";
                   endwhile; 
                     $s++; 
                   endwhile; 
                  $html.="</tr>";
                  $html.="<tr>";
                    $html.="<th colspan='3'>Jaga Malam</th>";
                     
                    $m =1; 
                    while ($m <= $tgl) :
                    $jm = "absen_".$m;
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($mmm=mysqli_fetch_assoc($mm)) :
                    
                    $html.="<th style='text-align: center;'>".  $mmm['m'] ."</th>";
                   endwhile; 
                     $m++; 
                   endwhile; 
                  $html.="</tr>";
                  $html.="<tr>";
                    $html.="<th colspan='3'>Libur</th>";
                     
                    $l =1; 
                    while ($l <= $tgl) :
                    $jl = "absen_".$l;
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($lll=mysqli_fetch_assoc($ll)) :
                    
                    $html.="<th style='text-align: center;'>".  $lll['l'] ."</th>";
                   endwhile; 
                     $l++; 
                   endwhile; 
                  $html.="</tr>";
                  $html.="<tr>";
                    $html.="<th colspan='3'>Cuti</th>";
                     
                    $c =1; 
                    while ($c <= $tgl) :
                    $jc = "absen_".$c;
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND tim_kelompok_id='$id' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($ccc=mysqli_fetch_assoc($cc)) :
                    
                    $html.="<th style='text-align: center;'>".  $ccc['c'] ."</th>";
                   endwhile; 
                     $c++; 
                   endwhile; 
                  $html.="</tr>";
                  $html.="</tbody>";
                $html.="</table>";
}
$html.="<table border='1' cellspacing='0'>
                    <tr>
                      <th colspan='3'></th>";
                        
                      $t =1; 
                      while ($t <= $tgl) :
                      
                        $html.="<th>".  $t++ ."</th>";
                       endwhile; 
                    $html.="</tr>
                    <tr>
                    <th colspan='3'>Jaga Pagi</th>";
                     
                    $p =1; 
                    while ($p <= $tgl) :
                    $jp = "absen_".$p;
                    $pp = mysqli_query($conn, "SELECT count($jp) AS p FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jp = 'P' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($r=mysqli_fetch_assoc($pp)) :
                    
                    $html.="<th style='text-align: center;'>".  $r['p'] ."</th>";
                   endwhile; 
                     $p++; 
                   endwhile; 
                  $html.="</tr>
                  <tr>
                    <th colspan='3'>Jaga Petang</th>";
                     
                    $s =1; 
                    while ($s <= $tgl) :
                    $js = "absen_".$s;
                    $ss = mysqli_query($conn, "SELECT count($js) AS s FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $js = 'S' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($sss=mysqli_fetch_assoc($ss)) :
                    
                    $html.="<th style='text-align: center;'>".  $sss['s'] ."</th>";
                   endwhile; 
                     $s++; 
                   endwhile; 
                  $html.="</tr>
                  <tr>
                    <th colspan='3'>Jaga Malam</th>";
                     
                    $m =1; 
                    while ($m <= $tgl) :
                    $jm = "absen_".$m;
                    $mm = mysqli_query($conn, "SELECT count($jm) AS m FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jm = 'M' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($mmm=mysqli_fetch_assoc($mm)) :
                    
                    $html.="<th style='text-align: center;'>".  $mmm['m'] ."</th>";
                   endwhile; 
                     $m++; 
                   endwhile; 
                  $html.="</tr>
                  <tr>
                    <th colspan='3'>Libur</th>";
                     
                    $l =1; 
                    while ($l <= $tgl) :
                    $jl = "absen_".$l;
                    $ll = mysqli_query($conn, "SELECT count($jl) AS l FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jl = 'L' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($lll=mysqli_fetch_assoc($ll)) :
                    
                    $html.="<th style='text-align: center;'>".  $lll['l'] ."</th>";
                   endwhile; 
                     $l++; 
                   endwhile; 
                  $html.="</tr>
                  <tr>
                    <th colspan='3'>Cuti</th>";
                     
                    $c =1; 
                    while ($c <= $tgl) :
                    $jc = "absen_".$c;
                    $cc = mysqli_query($conn, "SELECT count($jc) AS c FROM tbl_absen JOIN tbl_tim ON tbl_absen.absen_tim_id = tbl_tim.tim_id WHERE $jc = 'CT' AND absen_bulan='$dd' AND absen_tahun='$yy' ");
                    while ($ccc=mysqli_fetch_assoc($cc)) :
                    
                    $html.="<th style='text-align: center;'>".  $ccc['c'] ."</th>";
                   endwhile; 
                     $c++; 
                   endwhile; 
                  $html.="</tr>
</table>
</body>
</html>";

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();

?>