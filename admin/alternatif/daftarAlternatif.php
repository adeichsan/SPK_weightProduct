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
    <link rel="stylesheet" type="text/css" href="../../plugin/DataTables/media/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="../../plugin/DataTables/media/css/dataTables.bootstrap.css">
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../js/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="../../js/animate.css">

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
                        <a href="javascript:;" data-toggle="collapse" data-target="#jurusan"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Jurusan <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
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
                                <a href="tambahAlternatif.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="daftarAlternatif.php" class="glyphicon glyphicon-list"> Daftar </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#kriteria"><i class="glyphicon glyphicon-menu-hamburger"></i> Data Mata Kuliah <i style="float: right;padding-right: 30px;" class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="kriteria" class="collapse">
                            <li>
                                <a href="../kriteria/tambahKriteria.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="../kriteria/daftarKriteria.php" class="glyphicon glyphicon-list"> Daftar </a>
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
                            Data Peminatan
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li class="active>
                                <i class="glyphicon glyphicon-menu-hamburger"></i> Daftar Peminatan
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <?php
                            include '../../connect.php';
                            $query = "SELECT NAMA_PRODI, KODE_PRODI, ALTERNATIF, ID_ALTERNATIF FROM alternatif INNER JOIN prodi ON alternatif.ID_PRODI = prodi.ID_PRODI";
                            $result = mysqli_query($koneksi, $query); 
                        ?>
                        <table id="employee_data" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>NAMA JURUSAN</th>
                                    <th>PEMINATAN</th>
                                    <th style="text-align: center;">ACTION</th>
                                </tr>
                            </thead>
                                <?php  
                                    while($row = mysqli_fetch_array($result))  {  
                                    echo    '<tr>  
                                            <td>'.$row["NAMA_PRODI"].'</td>
                                            <td>'.$row["ALTERNATIF"].'</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                <a class="btn btn-default" href="editAlternatif.php?ID_ALTERNATIF='. $row['ID_ALTERNATIF'] .'">Edit</a>
                                                <a class="btn btn-danger" href="proses.php?aksi=hapusAlternatif&ID_ALTERNATIF='. $row['ID_ALTERNATIF'] .'" onClick="return confirm("Apakah Ada yakin menghapus ?")">Hapus</a></td>
                                                </div>  
                                        </tr>';  
                                  }  
                                  ?>
                        </table>
                    </div>
                </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../js/jquery.js"></script>
    <script src="../../js/sweetalert2.min.js"></script>
    <script type="text/javascript">
        function alert_show(title, words) {
         swal({
          title: title,
          html: $('<div>')
          .addClass('some-class')
          .text(words),
          animation: false,
          customClass: 'animated tada'
        })
       }
    </script>
    <?php
    if (isset($_SESSION['update']) && ($_SESSION['update'] === 'berhasil')){

        echo "<script> alert_show('Update Data', 'Berhasil !!!') </script>";
        unset($_SESSION['update']);
    }elseif (isset($_SESSION['hapus']) && ($_SESSION['hapus'] === 'berhasil')){

        echo "<script> alert_show('Delete Data', 'Berhasil !!!') </script>";
        unset($_SESSION['hapus']);
    } 
    ?>

    <script type="text/javascript" src="../../plugin/DataTables/media/js/jquery.dataTables.js"></script>

    <script>  
         $(document).ready(function(){  
              $('#employee_data').DataTable();  
         });  
     </script>
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
