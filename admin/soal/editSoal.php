<?php
include"../../checkLogin.php";
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
                                <a href="tambahSoal.php"><i class="glyphicon glyphicon-plus"></i> Tambah </a>
                            </li>
                            <li>
                                <a href="daftarSoal.php" class="glyphicon glyphicon-list"> Daftar </a>
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
                            Data Soal
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-home"></i>  <a href="../index.php">Home</a>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-menu-hamburger"></i> Data Soal
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-user"></i> Edit Soal
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                include "../../connect.php";
                $ID_SOAL = $_GET['ID_SOAL'];
                $query = mysqli_query($koneksi, "SELECT * FROM soal_tkd WHERE ID_SOAL ='{$ID_SOAL}'");
                $result = mysqli_fetch_array($query);   
                ?>

                <form role="form" enctype="multipart/form-data" method="POST" action="proses.php?ID_SOAL=<?php echo $result['ID_SOAL'] ?>">
                            <div class="form-group">
                        <label>Peminatan</label>
                            <select name="alternatif" class="form-control">
                                <option  selected="selected">Pilih Peminatan</option>
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
                                <label>Soal</label>
                                <textarea name="soal" class="tinymce" rows="3"><?php echo $result['SOAL'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
                                    <img src="<?php echo "../../images/{$result['FOTO']}" ?>" style="width: 150px;">
                                    <input class="btn btn-default" type="file" name="foto">
                            </div>
                            <div class="form-group">
                                <label>Jawaban 1</label>
                                <textarea name="jawaban1" class="form-control" rows="2"><?php echo $result['JAWABAN1'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jawaban 2</label>
                                <textarea name="jawaban2" class="form-control" rows="2"><?php echo $result['JAWABAN2'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jawaban 3</label>
                                <textarea name="jawaban3" class="form-control" rows="2"><?php echo $result['JAWABAN3'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Jawaban Benar</label>
                                <textarea name="jawabanBenar" class="form-control" rows="2"><?php echo $result['JAWABAN_BENAR'] ?></textarea>
                            </div>
                            <button name="update" type="edit" style="float: right" class="btn btn-primary">Update</button>
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

    <script type="text/javascript" src="../../css/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../../plugin/tinymce/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="../../plugin/tinymce/js/tinymce/init-tinymce.js"></script>
    
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
    <script type="text/javascript">
    function filePreview(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
            reader.onload = function (e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
            }
        reader.readAsDataURL(input.files[0]);
        }
    }

    $("#file").change(function () {
    filePreview(this);
    });
    </script>
</body>

</html>
