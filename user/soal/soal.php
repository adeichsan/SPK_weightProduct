
<?php
include '../../checkLogin.php';
include "../../connect.php";
$ID_MHS = $_SESSION['ID_MHS'];
$ID_PRODI = $_SESSION['ID_PRODI'];
$query = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE ID_MHS = '$ID_MHS' and ID_PRODI = '$ID_PRODI'");
$result = mysqli_fetch_array($query);
$ambil_Id =$_GET['id'];
$bantuWaktu = 5000;

# PROGRESS SOAL
if (!isset($_SESSION['progress_soal'])) {
    $_SESSION['progress_soal'] = 1;
    $_SESSION['jawaban_sebelumnya'] = "";
    $_SESSION['sedang_ngerjakan_soal'] = $_GET['id'];
    $_SESSION['start_ngerjakan'] = (new DateTime(null, new DateTimeZone('Asia/Jakarta')))->getTimestamp();
}

# apakah masih soal yang sama? kalau nggak, direset dari awal
if (@$_SESSION['sedang_ngerjakan_soal'] != @$_GET['id']) {
    $_SESSION['progress_soal'] = 1;
    $_SESSION['jawaban_sebelumnya'] = "";
    $_SESSION['sedang_ngerjakan_soal'] = $_GET['id'];
    $_SESSION['start_ngerjakan'] = (new DateTime(null, new DateTimeZone('Asia/Jakarta')))->getTimestamp();
}

# apakah sudah di page yang benar?
if ($_SESSION['progress_soal'] != @$_GET['soal']) {
    header("location: ?id={$_GET['id']}&soal={$_SESSION['progress_soal']}");
    // die();
}

if (!@$_GET['soal']) {
    $querySoal = mysqli_query($koneksi,"SELECT * FROM soal_tkd WHERE ID_ALTERNATIF = '{$ambil_Id}' ORDER BY RAND() LIMIT 0,10");
    $resultSoal = [];
    $id_soal_yang_sudah_dirandom = [];
    while ($row = mysqli_fetch_object($querySoal)) {
        array_push($resultSoal, $row);
        array_push($id_soal_yang_sudah_dirandom, $row->ID_SOAL);
    }
} else {
    $resultSoal = [];
    foreach (explode(",", $_SESSION['id_soal_yang_sudah_dirandom']) as $key => $idSoal) {
        $querySoal = mysqli_query($koneksi, "SELECT * FROM soal_tkd WHERE ID_SOAL = {$idSoal}");
        $resultSoal[] = mysqli_fetch_object($querySoal);
    }
}

if (!@$_GET['soal']) {
    $id_soal_yang_sudah_dirandom = implode(",", $id_soal_yang_sudah_dirandom);
    $_SESSION['id_soal_yang_sudah_dirandom'] = "{$id_soal_yang_sudah_dirandom}";
}

$idSoal = isset($_GET['soal']) ? ((int) $_GET['soal']) : 1;

if ($idSoal > 10) {
    header("location: ?id={$_GET['id']}&soal=10");
} elseif ($idSoal < 1) {
    header("location: ?id={$_GET['id']}&soal=1");
}
$soal = $resultSoal[$idSoal - 1];
?>
<!-- 
idRandomSoal = <?php echo @$_SESSION['id_soal_yang_sudah_dirandom']?>
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/logo.png">
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="../../assets/User/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS USER -->
    <link href="../../assets/User/css/style.css" rel="stylesheet">
    <link href="../../assets/User/css/style-tambahan.css" rel="stylesheet">
    <!-- You can change the theme colors from here RED-->
    <link href="../../assets/User/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- link to magiczoom.css file -->
        <link href="../../plugin/magiczoom.css" rel="stylesheet" type="text/css" media="screen"/>
        <!-- link to magiczoom.js file -->
        <script src="../../plugin/magiczoom.js" type="text/javascript"></script>
    <!-- HTML5 Shim and Respond.js IE8 usupport of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="fix-header fix-sidebar card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="../index.php">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../../assets/logo.png" width="33px" height="34px" alt="homepage" class="dark-logo" />
                            
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                            <!-- dark Logo text -->
                            <label style="font-size: x-small;">SPK PEMINATAN MATA KULIAH PILIHAN</label>
                        </span>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
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
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
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
                                <a href='quiz.php' class='waves-effect'><i class='fa fa-edit m-r-10' aria-hidden='true'></i>Tes Kemampuan</a>
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
                                        <a href='../spk/peminatanSPK.php' class='waves-effect'><i class='fa fa-book m-r-10' aria-hidden='true'></i>Perhitungan Metode</a>
                                        </li>";
                            }
                        ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Tes Kemampuan</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                            <li class="breadcrumb-item active">Tes Kemampuan</li>
                        </ol>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->

                <div class="row">
                    <div class="col-lg-5 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-block">
                                <center> 
                                    <?php if (!@$soal->FOTO) { ?>
                                        <img src="../../assets/placeholder.png" style="height: 250px;"/>
                                    <?php } else { ?>
                                        <a href="../../images/<?php echo $soal->FOTO ?>" class="MagicZoom" rel="zoom-id:zoom;opacity-reverse:true; "><img src="../../images/<?php echo $soal->FOTO ?>" style="height: 250px;"/></a>
                                    <?php } ?>
                                    <h4 class="card-title m-t-10"></h4>
                                </center>
                                    <!-- <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="" data-toggle="modal" data-target="#myModal1"><i class="icon-picture"></i> <font class="font-medium">Edit</font></a></div>
                                    </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- col-lg-12 col-xlg-9 col-md-7 -->
                    <div class="col-lg-7 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-block">
                                <h2 id="time-left"></h2>
                                <div class="page-titles" style="text-align: center">
                                    <ul class="paginationku modal-5">
                                        <li><a  class="<?php echo $idSoal === 1 ? 'aksi' : ''?>">1</a></li>
                                        <li><a  class="<?php echo $idSoal === 2 ? 'aksi' : ''?>">2</a></li>
                                        <li><a  class="<?php echo $idSoal === 3 ? 'aksi' : ''?>">3</a></li>
                                        <li><a  class="<?php echo $idSoal === 4 ? 'aksi' : ''?>">4</a></li>
                                        <li><a  class="<?php echo $idSoal === 5 ? 'aksi' : ''?>">5</a></li>
                                        <li><a  class="<?php echo $idSoal === 6 ? 'aksi' : ''?>">6</a></li>
                                        <li><a  class="<?php echo $idSoal === 7 ? 'aksi' : ''?>">7</a></li>
                                        <li><a  class="<?php echo $idSoal === 8 ? 'aksi' : ''?>">8</a></li>
                                        <li><a  class="<?php echo $idSoal === 9 ? 'aksi' : ''?>">9</a></li>
                                        <li><a  class="<?php echo $idSoal === 10 ? 'aksi' : ''?>">10</a></li>
                                    </ul>
                                </div>
                                <!-- isi -->
                                <div class="row">
                                    <div class="col-lg-12 col-xlg-8 col-md-5" style="margin-bottom: 10px">
                                        <div class="Container">
                                            <h6>
                                            <?php
                                            echo $soal->SOAL;
                                            ?>
                                            </h6>
                                        </div>
                                        <div>
                                            <form id="form-jawaban" method="post" action="proses.php">
                                                <input type="hidden" name="soal" value="<?php echo $_GET['soal']?>">
                                                <input type="hidden" name="aksi" value="njawab">
                                                <input type="hidden" name="id_alternatif" value="<?php echo $_GET['id'] ?>">
                                                <li style="list-style: none;"> A.
                                                <input type="radio" name="jawaban" value="1" > <?php echo htmlentities($soal->JAWABAN1); ?>
                                                </li>    
                                                <li style="list-style: none;"> B.
                                                <input type="radio" name="jawaban" value="2" > <?php echo htmlentities($soal->JAWABAN2); ?> </li>
                                                    
                                                <li style="list-style: none;"> C.
                                                <input type="radio" name="jawaban" value="3" > <?php echo htmlentities($soal->JAWABAN3); ?>        
                                                </li>
                                                <input type="hidden" name="waktu_habis" value="0">
                                            </form>
                                            
                                        </div>
                                    </div> 
                                </div>             
                                <!-- footer -->
                                <ul class="pager" style="">

                                    <?php if ($idSoal < 10) {?>
                                    <!-- <li class="lanjut"><a href="?id=<?php echo $_GET['id'] ?>&soal=<?php echo $idSoal + 1?>">Next</a></li> -->
                                    <li class="lanjut">
                                        <button id="btn-lanjut" type="submit" form="form-jawaban" class="btn btn-primary disabled" style="float: right;margin: 10px;">Next</button>
                                    </li>
                                    <?php } else {?>
                                    <li class="lanjut">
                                        <button id="btn-lanjut" type="submit" form="form-jawaban" class="btn btn-primary disabled" style="float: right;margin: 10px;">Finish</button>
                                    </li>
                                    <?php }?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- Column -->
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © 2017 by Fauziah Alifa D3 Manajemen Informatika
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="../../assets/User/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../../assets/User/plugins/bootstrap/js/tether.min.js"></script>
    <script src="../../assets/User/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../../assets/User/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../../assets/User/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="../../assets/User/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="../../assets/User/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="../../assets/User/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- Flot Charts JavaScript -->
    <script src="../../assets/User/plugins/flot/jquery.flot.js"></script>
    <script src="../../assets/User/plugins/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
    <script src="../../assets/User/js/flot-data.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="../../assets/User/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script type="text/javascript">
        $('[name=jawaban]').change(function () {
            if ($(this).val()) {
                $('#btn-lanjut').removeClass('disabled')
            }
        })

        var timeFromServer = new Date(<?php echo $_SESSION['start_ngerjakan'] ?> * 1000)

        function runDifferent () {
            var currentTime = new Date()
            var differentinSec = Math.floor((currentTime - timeFromServer) / 1000)
            var waktuNgerjakanMaksimal = 180
            var timeLeft = waktuNgerjakanMaksimal - differentinSec
            
            console.log(timeLeft)
            $('#time-left').html(timeLeft + ' detik')

            if (timeLeft < 1) {
                $('[name=waktu_habis]').val(1)
                $('#form-jawaban').submit()
            }
        }

        runDifferent()
        setInterval(runDifferent, 1000)
    </script>
</body>

</html>