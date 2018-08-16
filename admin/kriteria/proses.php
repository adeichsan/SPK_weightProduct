<?php
session_start();
if (!@$_SESSION['ID_ADMIN']) {
	echo "Admin belom login";
	return;
}
?>

<?php
include '../../connect.php';
if(isset($_POST['simpan'])){
  function nomor() {
    include "../../connect.php";
    $sql = mysqli_query($koneksi,"SELECT ID_KRITERIA FROM kriteria ORDER BY ID_KRITERIA DESC LIMIT 0,1");
    list ($no_temp) = mysqli_fetch_row($sql);

    if ($no_temp == '') {
    $no_urut = 'K01';

    } else {
    $jum = substr($no_temp,1,6);
    $jum++;
    if($jum <= 9) {
    $no_urut = 'K0' . $jum;
    } elseif ($jum <= 99) {
    $no_urut = 'K' . $jum;
    } else {
    die("Nomor urut melebih batas");        
    }
    }
    return $no_urut;
    }
  $auto = nomor();
	$id_admin = $_SESSION['ID_ADMIN'];
	$alternatif = $_POST['alternatif'];
	$kriteria = $_POST['kriteria'];
  $bobot = $_POST['bobot'];
  $sks = $_POST['sks'];
	$status = $_POST['status'];
  
	 $sql = mysqli_query($koneksi,"INSERT INTO kriteria (ID_KRITERIA,ID_ADMIN,ID_ALTERNATIF,SKS,KRITERIA,BOBOT,STATUS) VALUES ('$auto','$id_admin', '$alternatif','$sks', '$kriteria', '$bobot', '$status')");
    if ($sql) {
     $_SESSION['tambah'] = 'berhasil';
     header('location:tambahKriteria.php');
    } else {
     echo "Error: ".$sql.". ".mysqli_error($koneksi);
    }
  }
?>

<?php
  if(isset($_POST['update'])){
  $ID_KRITERIA = $_GET['ID_KRITERIA'];
  $ALTERNATIF = $_POST['alternatif'];
  $KRITERIA = $_POST['kriteria'];
  $BOBOT = $_POST['bobot'];
  $SKS = $_POST['sks'];
  $status = $_POST['status'];
  $queryupdate = mysqli_query($koneksi, "UPDATE kriteria SET ID_ALTERNATIF = '$ALTERNATIF', KRITERIA = '$KRITERIA', BOBOT = '$BOBOT', SKS = '$SKS', STATUS = '$status' WHERE ID_KRITERIA = '$ID_KRITERIA'");
  if($queryupdate){
   $_SESSION['update'] = 'berhasil';
   header('location:daftarKriteria.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
  }
  }
 ?>

<?php
if ($_GET['aksi'] == 'hapusKriteria') {
$ID_KRITERIA = $_GET['ID_KRITERIA'];
$queryhapus = mysqli_query($koneksi, "DELETE FROM kriteria WHERE  ID_KRITERIA = '$ID_KRITERIA'");
if($queryhapus){
  $_SESSION['hapus'] = 'berhasil';
  header('location:daftarKriteria.php');
 }else{
  echo "Error: ".$queryhapus.". ".mysqli_error($koneksi);
}
}
?>