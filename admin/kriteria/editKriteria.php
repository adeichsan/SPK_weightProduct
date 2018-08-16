<?php
include '../../checkLogin.php';
?>
<?php
                  include "../../connect.php";
                  $ID_ADMIN = $_SESSION['ID_ADMIN'];
                  $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE ID_ADMIN = '$ID_ADMIN'");
                  $result = mysqli_fetch_array($query);
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
    <title>SPK MATA KULIAH PILIHAN ADMIN</title>


    <!-- Bootstrap Core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="../index.php">SPK Peminatan Mata Kuliah Mahasiswa</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $result['NAMA_ADMIN'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../user/profil.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../index.php"><i class="glyphicon glyphicon-home"></i> Home</a>
                    </li>
                    <!-- <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#admin"><i class="glyphicon glyphicon-menu-hamburger"></i> Admin <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="admin" class="collapse">
                            <li>
                                <a href="../user/tambahAdmin.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../user/daftarAdmin.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li> -->
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#jurusan"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Prodi <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="jurusan" class="collapse">
                            <li>
                                <a href="../jurusan/tambahJurusan.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../jurusan/daftarJurusan.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#alternatif"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Peminatan <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="alternatif" class="collapse">
                            <li>
                                <a href="../alternatif/tambahAlternatif.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../alternatif/daftarAlternatif.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#kriteria"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Mata Kuliah <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="kriteria" class="collapse">
                            <li>
                                <a href="tambahKriteria.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="daftarKriteria.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#soal"><i class="glyphicon glyphicon-menu-hamburger"></i> Soal <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="soal" class="collapse">
                            <li>
                                <a href="../soal/tambahSoal.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../soal/daftarSoal.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Mata Kuliah
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-menu-hamburger"></i> Data Mata Kuliah
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-file"></i> Edit Mata Kuliah
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                include "../../connect.php";
                $ID_KRITERIA = $_GET['ID_KRITERIA'];
                $query = mysqli_query($koneksi, "SELECT * FROM kriteria WHERE ID_KRITERIA ='{$ID_KRITERIA}'");
                $result = mysqli_fetch_array($query);   
                ?>

                <form role="form" action="proses.php?ID_KRITERIA=<?php echo $result['ID_KRITERIA'] ?>"" method="POST">
                    <div class="form-group">
                        <label>Peminatan</label>
                            <select name="alternatif" class="form-control">
                                <option>Pilih Peminatan</option>
                                <?php
                                    $query = mysqli_query($koneksi,"SELECT * FROM alternatif");
                                    while ($data =  mysqli_fetch_array($query) ){
                                        $selected = $data['ID_ALTERNATIF'] === $result['ID_ALTERNATIF'] ? 'selected' : '';
                                        echo "<option value='$data[ID_ALTERNATIF]' {$selected}>{$data ['ALTERNATIF']}</option>";
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="form-group">
                        <label>SKS Mata Kuliah</label>
                        <input name="sks" class="form-control" value="<?php echo $result['SKS'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Mata Kuliah</label>
                        <input name="kriteria" class="form-control" value="<?php echo $result['KRITERIA'] ?>">
                    </div>
                    <div class="form-group">
                        <label>Bobot<h5><small>* Isi angka 1 - 5 (1 - Sangat Rendah, 2 - Rendah, 3 - Sedang, 4 - Tinggi, 5 - Sangat Tinggi)</small></h5></label>
                        <input name="bobot" maxlength="1" class="form-control" value="<?php echo $result['BOBOT'] ?>">
                    </div>
                    <div class="form-group">
                                <label>Jenis Status</label>
                                <select name="status" class="form-control">
                                    <option <?php echo $result['STATUS'] === 'AKTIF' ? 'selected' : '' ?>>AKTIF</option>
                                    <option <?php echo $result['STATUS'] === 'NONAKTIF' ? 'selected' : '' ?>>NONAKTIF</option>
                                </select>
                            </div>
                        <button name="update" style="float: right" class="btn btn-primary">Update</button>
                </form>

                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../js/plugins/morris/raphael.min.js"></script>
    <script src="../../js/plugins/morris/morris.min.js"></script>
    <script src="../../js/plugins/morris/morris-data.js"></script>

    <!-- Flot Charts JavaScript -->
    <!--[if lte IE 8]><script src="js/excanvas.min.js"></script><![endif]-->
    <script src="../../js/plugins/flot/jquery.flot.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../../js/plugins/flot/flot-data.js"></script>

</body>

</html>
