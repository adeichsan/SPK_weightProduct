<?php
  function nomor() {
  include "../../connect.php";
  $sql = mysqli_query($koneksi,"SELECT ID_PRODI FROM prodi ORDER BY ID_PRODI DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);

  if ($no_temp == '') {
  $no_urut = 'P01';

  } else {
  $jum = substr($no_temp,1,6);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'P0' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'P' . $jum;
  } else {
      die("Nomor urut melebih batas");        
  }
  }
  return $no_urut;
  }
                   
?>

<?php
session_start();
?>
<!-- tambah data -->
<?php
include '../../connect.php';
if(isset($_POST['simpan'])){
  $auto = nomor();
  $id_admin = $_SESSION['ID_ADMIN'];
  $prodi = $_POST['prodi'];
  $kodeprodi = $_POST['kodeProdi'];
  $sql = mysqli_query($koneksi,"INSERT INTO `prodi`(`ID_PRODI`,`ID_ADMIN`, `KODE_PRODI`, `NAMA_PRODI`) VALUES ('$auto','$id_admin','$kodeprodi','$prodi')") ;
  if ($sql) {
  $_SESSION['tambah'] = 'berhasil';
  header('location:tambahJurusan.php');
  } else {
  echo "Error: ".$sql.". ".mysqli_error($koneksi);
  echo "INSERT INTO `prodi`(`ID_PRODI`,`ID_ADMIN`, `KODE_PRODI`, `NAMA_PRODI`) VALUES ('$auto','$id_admin','$kodeprodi','$prodi')";
  }
}
?>

<!-- edit -->
<?php
  if(isset($_POST['editProdi'])){
  $ID_PRODI = $_GET['ID_PRODI'];
  $NAMA_PRODI = $_POST['prodi'];
  $KODE_PRODI = $_POST['kode'];
  $queryupdate = mysqli_query($koneksi, "UPDATE prodi SET NAMA_PRODI = '$NAMA_PRODI', KODE_PRODI = '$KODE_PRODI' WHERE ID_PRODI = '$ID_PRODI'");
  if($queryupdate){
   $_SESSION['update'] = 'berhasil';
   header('location:daftarJurusan.php');
  }else{
   echo "Error: ".$queryupdate.". ".mysqli_error($koneksi);
  }
  }
 ?>

<?php
if ($_GET['aksi'] == 'hapusProdi') {
$ID_PRODI = $_GET['ID_PRODI'];
$queryhapus = mysqli_query($koneksi, "DELETE FROM prodi WHERE  ID_PRODI = '$ID_PRODI'");
if($queryhapus){
  $_SESSION['hapus'] = 'berhasil';
  header('location:daftarJurusan.php');
 }else{
  echo "Error: ".$queryhapus.". ".mysqli_error($koneksi);
}
}
?>