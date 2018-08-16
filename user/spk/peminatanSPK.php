<?php
include '../../checkLogin.php';
?>
<?php 
function nomor() {
include '../../connect.php';
  $sql = mysqli_query($koneksi,"SELECT ID_PEMINATAN FROM hasilpeminatan ORDER BY ID_PEMINATAN DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);

  if ($no_temp == '') {
  $no_urut = 'HSLP0001';

  } else {
  $jum = substr($no_temp,4,7);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'HSLP000' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'HSLP00' . $jum;
  } elseif ($jum <= 999) {
      $no_urut = 'HSLP0' . $jum;
  } else {
      die("Nomor urut melebih batas");        
  }
  }
  return $no_urut;
}
                include "../../connect.php";
                $ID_MHS = $_SESSION['ID_MHS'];  
                $ID_PRODI = $_SESSION['ID_PRODI'];
                $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE ID_MHS = '$ID_MHS' and ID_PRODI = '$ID_PRODI'");
                $result = mysqli_fetch_array($query);
                $hasilJ = 1 ; 
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/logo.png">
    <title>SPK Peminatan Mata Kuliah Pilihan</title>
    <link href="../../assets/User/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/User/css/style.css" rel="stylesheet">
    <link href="../../assets/User/css/colors/blue.css" id="theme" rel="stylesheet">

    <style type="text/css">
        .rumus {
            text-align: center;
        }

        .rumus .garis {
            border-top: 1px solid rgba(0, 0, 0, 0.3);
        }

        .hasil {
            font-weight: bolder;
            color: rgb(200, 80, 80);
        }
        .card-title-color{
            color: #d80202;
        }
        @media print {
          body * {
            visibility: hidden;
          }
          #print *{
            visibility: visible;
          }
          #print {
            position: absolute;
            left: 0;
            top: -40px;
            margin: 30px;
            margin-left: -200px
          }
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border">
    
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">
                        <b>
                            <img src="../../assets/logo.png" width="33px" height="34px" alt="homepage" class="dark-logo" />
                        </b>
                        <span>
                            <label style="font-size: x-small;">SPK PEMINATAN MATA KULIAH PILIHAN</label>
                        </span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                    </ul>
                    <ul class="navbar-nav my-lg-0">
            <ul class="nav navbar-right top-nav">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i style="padding-right: inherit;" class="fa fa-user"></i><?php echo $result['NAMA_DEPAN'] ?> <?php echo $result['NAMA_BELAKANG'] ?>
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <li style="margin-bottom: 10px;margin-left: 10px;">
                    <a href="../mhs/profil.php"><i style="padding-right: inherit;" class="fa fa-fw fa-user"></i> Profile</a>
                  </li>
                  <li style="margin-bottom: 10px;margin-left: 10px;">
                    <a href="../logout.php"><i style="padding-right: inherit;" class="fa fa-fw fa-power-off"></i> Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
        </header>
        
        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="../index.php" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Home</a>
                        </li>
                        <li>
                            <a href="../mhs/tambahNilai.php" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Tambah Nilai</a>
                        </li>
                        <?php
                            $query = mysqli_query($koneksi,"SELECT count(*) as jumlah FROM nilai_mk WHERE ID_MHS = '$ID_MHS'");
                            $result = mysqli_fetch_array($query);
                            $nilai = $result['jumlah'];
                            if ( $result["jumlah"] > 0 ) {        
                                echo "<li>
                                <a href='../soal/quiz.php' class='waves-effect'><i class='fa fa-edit m-r-10' aria-hidden='true'></i>Tes Kemampuan</a>
                                </li>";
                            }
                        ?>
                        <?php
                            $query = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM hasiltkd WHERE ID_MHS = '$ID_MHS'");
                            $result = mysqli_fetch_array($query);
                            $b = $result['jumlah'];
                            $query1 = mysqli_query($koneksi, "SELECT COUNT(*) as alternatif FROM alternatif WHERE ID_PRODI = '$ID_PRODI'");
                            $result = mysqli_fetch_array($query1);
                            $a = $result['alternatif'];
                            if ($a === $b) {            
                                echo "<li>
                                        <a href='peminatanSPK.php' class='waves-effect'><i class='fa fa-book m-r-10' aria-hidden='true'></i>Perhitungan Metode</a>
                                        </li>";
                            }
                        ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Perhitungan Metode</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Perhitungan Metode</li>
                        </ol>
                    </div>
                    <div class="col-md-6 col-4 align-self-center">
                        <a href="#" onclick="window.print()" class="btn pull-right btn-success">Download PDF</a>
                    </div>
                </div>
                <div id="print">
                
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card" style="background: content-box;">
                            <div class="card-block">
                                <table>
                                <tr>
                                    <?php
                                    $ID_MHS = $_SESSION['ID_MHS'];  
                                    $query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE ID_MHS = '$ID_MHS'");
                                    $result = mysqli_fetch_array($query);
                                    ?>
                                    <td style="padding-left: 10px;">
                                        <small style="text-transform:uppercase;"><h4 style="font-family: Arial;margin-left: -30px;" ><?php echo $result['NAMA_DEPAN'] ?> <?php echo $result['NAMA_BELAKANG'] ?></h4></small>
                                        <h3>
                                            <small style="margin-left: -30px;" class="text-muted"><?php echo $result['NIM_MHS'] ?></small>
                                        </h3>
                                    </td>
                                </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-7 col-xlg-7 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <small><h4 class="card-title">Nilai Mata Kuliah</h4></small>
                                <div class="table-responsive m-t-40">
                                    <?php
                                    include '../../connect.php';
                                    $query = "SELECT alternatif.ALTERNATIF, kriteria.KRITERIA, nilai_mk.GRADE, nilai_mk.NILAI FROM mahasiswa INNER JOIN nilai_mk on mahasiswa.ID_MHS = nilai_mk.ID_MHS INNER JOIN kriteria on kriteria.ID_KRITERIA = nilai_mk.ID_KRITERIA INNER JOIN alternatif on alternatif.ID_ALTERNATIF=kriteria.ID_ALTERNATIF inner join prodi on prodi.ID_PRODI = alternatif.ID_PRODI WHERE mahasiswa.ID_MHS = '$ID_MHS' and prodi.ID_PRODI = '$ID_PRODI'";
                                    $result = mysqli_query($koneksi, $query); 
                                    ?>
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Peminatan</th>
                                                <th>Mata Kuliah</th>
                                                <th>Grade</th>
                                                <th>Nilai</th>
                    
                                            </tr>
                                        </thead>
                                            <?php  
                                                while($row = mysqli_fetch_array($result))  {  
                                                    echo    '<tr>  
                                                        <td>'.$row["ALTERNATIF"].'</td>  
                                                        <td>'.$row["KRITERIA"].'</td>
                                                        <td>'.$row["GRADE"].'</td>      
                                                        <td>'.$row["NILAI"].'</td>      
                                                    </tr>';  
                                                }  
                                            ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-xlg-5 col-md-5" id="nilai-kontainer">
                        <div class="card">
                            <div class="card-block">
                                <small><h4 class="card-title">Nilai Tes Kemampuan</h4></small>
                                <div class="table-responsive m-t-40">
                                    <?php
                                    include '../../connect.php';
                                    $query = "SELECT alternatif.ALTERNATIF, hasiltkd.HASIL FROM hasiltkd INNER JOIN mahasiswa on mahasiswa.ID_MHS = hasiltkd.ID_MHS INNER JOIN alternatif on alternatif.ID_ALTERNATIF = hasiltkd.ID_ALTERNATIF INNER join prodi on prodi.ID_PRODI = alternatif.ID_PRODI WHERE mahasiswa.ID_MHS = '$ID_MHS' and prodi.ID_PRODI = '$ID_PRODI'";
                                    $result = mysqli_query($koneksi, $query); 
                                    ?>
                                    <table class="table stylish-table">
                                        <thead>
                                            <tr>
                                                <th>Peminatan</th>
                                                <th>Hasil</th>
                                            </tr>
                                        </thead>
                                            <?php  
                                                while($row = mysqli_fetch_array($result))  {  
                                                    echo    '<tr>  
                                                        <td>'.$row["ALTERNATIF"].'</td>  
                                                        <td>'.$row["HASIL"].'</td>      
                                                    </tr>';  
                                                }  
                                            ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                </div>
                </div>

                <!-- Perbaikan Bobot -->
                
                <div class="row">
                <?php
                    $perbaikanBobot = mysqli_query($koneksi,"SELECT * from alternatif where ID_PRODI = '$ID_PRODI'");
                    $semuaHasilBobot = [];
                    while ($perbaikan = mysqli_fetch_object($perbaikanBobot)) {
                    $bobot = [];
                    $jumlahBobot = 0;
                    $hasilBobot = [];
                ?>
                        <div class="col-lg-6 col-xlg-6 col-md-6">
                            <div class="card" style="background-color: #00b0d4;">
                                <div class="card-block" style="color: azure;">
                                    <small>
                                        <h4 class="card-title" style="color: azure;">
                                            <?php echo "Perbaikan Bobot ".$perbaikan->ALTERNATIF; ?>    
                                        </h4>
                                    </small>
                                        <?php
                                            $nilaiBobot = mysqli_query($koneksi,"SELECT BOBOT from KRITERIA WHERE ID_ALTERNATIF='{$perbaikan->ID_ALTERNATIF}'");
                                            while($row = mysqli_fetch_array($nilaiBobot))  {  
                                                $bobot[] = $row['BOBOT'];
                                                $jumlahBobot += ((int) $row['BOBOT']);
                                            }
                                                for ($i = 0; $i < count($bobot); $i++) {
                                        ?>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <?php
                                                            echo "W" . ($i + 1) . " = ";
                                                        ?>
                                                    </div>
                                                        <div class="col-md-5">
                                                            <div class="rumus">
                                                                <?php echo "$bobot[$i]" ?>
                                                                <div class="garis"></div>
                                                                <?php
                                                                for ($j = 0; $j < count($bobot); $j++) {
                                                                    echo $bobot[$j];
                                                                    if ($j < count($bobot) - 1) {
                                                                        echo " + ";
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                            <div class="col-md-5">
                                                                <div class="hasil" style="color: azure;">
                                                                    <?php
                                                                    $hasilBobot[] = $bobot[$i] / $jumlahBobot;
                                                                    ?>
                                                                    = <span><?php echo $bobot[$i] / $jumlahBobot; ?></span>
                                                                </div>
                                                            </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                </div>
                            </div>
                        </div>
                <?php
                        $semuaHasilBobot[] = $hasilBobot;
                    }
                ?>
                </div>

                <!-- menggitung S -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card" style="background-color: lavender;">
                            <div class="card-block"  style="color: #d80202;">
                <?php
                include '../../connect.php';
                $alternatif_rows = mysqli_query($koneksi,"SELECT * from alternatif where ID_PRODI = '$ID_PRODI'");
                $indexHasilBobot = 0;
                $listSemuaNilaiS = [];
                while ($alternatif = mysqli_fetch_object($alternatif_rows)) {
                $hasiltkd = mysqli_query($koneksi,"SELECT HASIL FROM `hasiltkd` WHERE ID_ALTERNATIF = '{$alternatif->ID_ALTERNATIF}' && ID_MHS= '$ID_MHS'");
                $rowsTKD = mysqli_fetch_array($hasiltkd);
                $hasilTKD = $rowsTKD['HASIL'];
                $nilaiMK = mysqli_query($koneksi,"SELECT * from nilai_mk where ID_ALTERNATIF = '{$alternatif->ID_ALTERNATIF}' && ID_MHS = '$ID_MHS'");
                $nilai_MK = [];
                $hasilPangkat = [];
                $hasil = 1;
                ?>
                                <small><h4 class="card-title-color" >Menghitung S <small><?php echo $alternatif->ALTERNATIF; ?></small></h4></small>
                                    <?php  
                                        while($row = mysqli_fetch_array($nilaiMK))  {  
                                            $nilai_MK[] = $row['NILAI'];
                                        }
                                            echo "S<small>$alternatif->ALTERNATIF </small> = ";
                                                        for ($j = 0; $j < count($nilai_MK); $j++) {
                                                            $hasilPangkat[] = pow($nilai_MK[$j], $semuaHasilBobot[$indexHasilBobot][$j]);
                                                            echo "(" . $nilai_MK[$j] . "<sup>" .  $semuaHasilBobot[$indexHasilBobot][$j] . "</sup>)";
                                                            if ($j < count($nilai_MK) - 1) {
                                                                echo " x ";
                                                            }
                                                        }

                                            echo " x ({$hasilTKD}<sup>{$semuaHasilBobot[$indexHasilBobot][4]}</sup>)";

                                            $hasilPangkat[] = pow($hasilTKD, $semuaHasilBobot[$indexHasilBobot][4]);

                                            for ($k = 0; $k < count($hasilPangkat); $k++) {
                                                $hasil *= $hasilPangkat[$k];
                                            }
                                            echo " = " . $hasil;
                                            echo "<hr>";
                                        ?>
                <?php
                    $indexHasilBobot++;
                    $listSemuaNilaiS[] = $hasil;
                }
                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- menggitung V -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block">
                                <?php
                                include '../../connect.php';
                                $alternatif_rows = mysqli_query($koneksi,"SELECT * from alternatif where ID_PRODI = '$ID_PRODI'");
                                $indexHasilS = 0;
                                $sum = 0; 
                                    for ($i=0; $i < count($listSemuaNilaiS); $i++) {
                                    $sum += $listSemuaNilaiS[$i];
                                    }

                                $hasilV = []; 
                                while ($alternatif = mysqli_fetch_object($alternatif_rows)) {
                                ?>
                                <small><h4 class="card-title">Menghitung V <small><?php echo $alternatif->ALTERNATIF ?></small></h4></small>
                                    <div class="row">
                                        <div class='col-md-2'>
                                            V<small><?php echo $alternatif->ALTERNATIF ?></small> = 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="rumus">
                                                <?php echo $listSemuaNilaiS[$indexHasilS] ?>
                                                <div class="garis"></div>
                                                    <?php 
                                                    for ($i=0; $i < count($listSemuaNilaiS) ; $i++) { 
                                                            echo  $listSemuaNilaiS[$i];
                                                        if ($i < count($listSemuaNilaiS) - 1) {
                                                                    echo " + ";
                                                                }
                                                    }
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="hasil">
                                            <?php $hasil = $listSemuaNilaiS[$indexHasilS] / $sum; 

                                            $hasilV[] = [
                                                'alternatif' => $alternatif,
                                                'nilai_v' => $hasil
                                            ];
                                            ?>
                                            = <span><?php echo $hasil ?></span>
                                            </div>
                                        </div>
                                    </div>    
                                        <?php    
                                    $indexHasilS++;        
                                }
                                    ?>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- hasil peminatan -->
                    <div class="card" id="hasil-perhitungan">
                        <div class="card-block">
                            <small>
                                <h4 class="hasil card-title">Hasil Peminatan</h4>
                            </small>
                <?php 
                    # CARI NILAI YANG TERBESAR
                    $nilaiTerbesar = -100000;
                    $alternatifTerbesar = null;

                    foreach ($hasilV as $row) {
                        if ($row['nilai_v'] > $nilaiTerbesar) {
                            $nilaiTerbesar = $row['nilai_v'];
                            $alternatifTerbesar = (object) $row;
                        }
                    }
                ?>
                <hr>
                <h5><?php echo "Peminatan SPK yang di sarankan adalah : ". $alternatifTerbesar->alternatif->ALTERNATIF; ?> <br></h5>
                <hr style="color: red;">
                <h5><?php echo "Dengan nilai akhir tertinggi adalah : ". $alternatifTerbesar->nilai_v; ?></h5>
                <?php 
                include '../../connect.php';
                $peminatan = $alternatifTerbesar->alternatif->ALTERNATIF;
                $idAuto = nomor();
                $querydelete = mysqli_query($koneksi,"DELETE FROM `hasilpeminatan` WHERE ID_MHS='$ID_MHS'");
                $query = mysqli_query($koneksi,"INSERT INTO `hasilpeminatan`(`ID_PEMINATAN`,`ID_MHS`, `HASILPEMINATAN`) VALUES ('$idAuto','$ID_MHS','$peminatan')");
                $queryselect = mysqli_query($koneksi,"SELECT ID_PEMINATAN FROM `hasilpeminatan` WHERE ID_MHS = '$ID_MHS'");
                $result = mysqli_fetch_array($queryselect);
                $row = $result['ID_PEMINATAN'];
                $queryup = mysqli_query($koneksi,"UPDATE `mahasiswa` SET `ID_PEMINATAN` = '$row' WHERE `mahasiswa`.`ID_MHS` = '$ID_MHS';");
                ?>
                        </div>
                    </div>
            </div>
        </div>
            </div>
            <footer class="footer text-center">
                © 2017 by Fauziah Alifa D3 Manajemen Informatika
            </footer>
        </div>
    </div>
    <script src="../../assets/User/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/User/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/User/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../../assets/User/js/jquery.slimscroll.js"></script>
    <script src="../../assets/User/js/waves.js"></script>
    <script src="../../assets/User/js/sidebarmenu.js"></script>
    <script src="../../assets/User/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="../../assets/User/js/custom.min.js"></script>
    <script src="../../assets/User/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/User/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../assets/User/js/flot-data.js"></script>
    <script src="../../assets/User/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">
        kontainer = $('#nilai-kontainer')
        hasil = $('#hasil-perhitungan')
        kontainer.append(hasil)
    </script>
</body>

</html>
