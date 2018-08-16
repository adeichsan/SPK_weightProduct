<?php
session_start();
if (!@$_SESSION['ID_ADMIN']) {
	echo "Admin belom login";
	return;
}
?>

<?php
include '../../connect.php';
if (isset($_POST['simpan'])) {
  $id_admin = $_SESSION['ID_ADMIN'];
  $ID_ALTERNATIF = $_POST['alternatif'];
  $SOAL = $_POST['soal'];
  $JAWABAN1 = $_POST['jawaban1'];
  $JAWABAN2 = $_POST['jawaban2'];
  $JAWABAN3 = $_POST['jawaban3'];
  $JAWABAN_BENAR = $_POST['jawabanBenar'];
  $FOTO = @$_FILES['foto']['name'];
  $ukuran_file = @$_FILES['foto']['size'];
  $tipe_file = @$_FILES['foto']['type'];
  $tmp_file = @$_FILES['foto']['tmp_name'];
  $path = "../../images/".$FOTO;

    $tanpafoto1 = "INSERT INTO soal_tkd(ID_ALTERNATIF,ID_ADMIN,SOAL,JAWABAN1,JAWABAN2,JAWABAN3,JAWABAN_BENAR) VALUES('$ID_ALTERNATIF','$id_admin','$SOAL','$JAWABAN1','$JAWABAN2','$JAWABAN3','$JAWABAN_BENAR') ";
    
  if (strlen($FOTO) < 1) {
    $aksi = mysqli_query($koneksi, $tanpafoto1);
    if($aksi){
  $_SESSION['tambah'] = 'berhasil';
     header('location:tambahSoal.php');
    }else{
     echo "Error: ".$aksi.". ".mysqli_error($koneksi);
    }  
  }else if (strlen($FOTO) && $tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
    if($ukuran_file <= 1000000){ 
      if(move_uploaded_file($tmp_file, $path)){
        $query = "INSERT INTO soal_tkd(ID_ALTERNATIF,ID_ADMIN,SOAL,JAWABAN1,JAWABAN2,JAWABAN3,JAWABAN_BENAR,FOTO) VALUES('$ID_ALTERNATIF','$id_admin','$SOAL','$JAWABAN1','$JAWABAN2','$JAWABAN3','$JAWABAN_BENAR','$FOTO') ";
        echo "$query";
        $sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        if($sql){
  $_SESSION['tambah'] = 'berhasil';
         header('location:tambahSoal.php');
          // header("location: admin.php"); // Redirectke halaman index.php
        }else{
          // Jika Gagal, Lakukan :
          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
          // echo "<br><a href='form.php'>Kembali Ke Form</a>";
        }
      }else{
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        // echo "<br><a href='form.php'>Kembali Ke Form</a>";
      }
    }else{
      // Jika ukuran file lebih dari 1MB, lakukan :
      echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
      // echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
    echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    // echo "<br><a href='form.php'>Kembali Ke Form</a>";
  }   
}
?>

<!-- edit -->

<?php
if (isset($_POST['update'])) {
  $ID_SOAL = $_GET['ID_SOAL'];
  $id_admin = $_SESSION['ID_ADMIN'];
  $ID_ALTERNATIF = $_POST['alternatif'];
  $SOAL = $_POST['soal'];
  $JAWABAN1 = $_POST['jawaban1'];
  $JAWABAN2 = $_POST['jawaban2'];
  $JAWABAN3 = $_POST['jawaban3'];
  $JAWABAN_BENAR = $_POST['jawabanBenar'];
  $FOTO = @$_FILES['foto']['name'];
  $ukuran_file = @$_FILES['foto']['size'];
  $tipe_file = @$_FILES['foto']['type'];
  $tmp_file = @$_FILES['foto']['tmp_name'];

  $path = "../../images/".$FOTO;

    $tanpafoto = "UPDATE soal_tkd SET ID_ADMIN = '$id_admin', SOAL = '$SOAL', JAWABAN1= '$JAWABAN1',JAWABAN2 = '$JAWABAN2', JAWABAN3= '$JAWABAN3', JAWABAN_BENAR= '$JAWABAN_BENAR' WHERE ID_SOAL = '$ID_SOAL'";
  if (strlen($FOTO) < 1) {
    $aksi = mysqli_query($koneksi, $tanpafoto);
    if($aksi){
     $_SESSION['update'] = 'berhasil';
     header('location:daftarSoal.php');
    }else{
     echo "Error: ".$aksi.". ".mysqli_error($koneksi);
    }  
  }else if (strlen($FOTO) && $tipe_file == "image/jpeg" || $tipe_file == "image/png"){ 
    if($ukuran_file <= 1000000){ 
      if(move_uploaded_file($tmp_file, $path)){
        $query = "UPDATE soal_tkd SET ID_ADMIN = '$id_admin',FOTO = '$FOTO', SOAL = '$SOAL', JAWABAN1= '$JAWABAN1',JAWABAN2 = '$JAWABAN2', JAWABAN3= '$JAWABAN3', JAWABAN_BENAR= '$JAWABAN_BENAR' WHERE ID_SOAL = '$ID_SOAL'";
        $sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
        if($sql){
         $_SESSION['update'] = 'berhasil';
         header('location:daftarSoal.php');
          // header("location: admin.php"); // Redirectke halaman index.php
        }else{
          // Jika Gagal, Lakukan :
          echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
          // echo "<br><a href='form.php'>Kembali Ke Form</a>";
        }
      }else{
        // Jika gambar gagal diupload, Lakukan :
        echo "Maaf, Gambar gagal untuk diupload.";
        // echo "<br><a href='form.php'>Kembali Ke Form</a>";
      }
    }else{
      // Jika ukuran file lebih dari 1MB, lakukan :
      echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
      // echo "<br><a href='form.php'>Kembali Ke Form</a>";
    }
  }else{
    // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
    echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
    // echo "<br><a href='form.php'>Kembali Ke Form</a>";
  }   
}
?>


<?php
if ($_GET['aksi'] == 'hapusSoal') {
  $ID_SOAL = $_GET['ID_SOAL'];
  $queryambil =  "SELECT * FROM soal_tkd WHERE  ID_SOAL = $ID_SOAL";
  $select= mysqli_query($koneksi,$queryambil);

  $result = mysqli_fetch_array($select);
  echo $result['FOTO'];
  if (is_file("../../images/".$result ['FOTO'])) {
    unlink("../../images/".$result ['FOTO']);
  }
  $queryhapus = mysqli_query($koneksi, "DELETE FROM soal_tkd WHERE  ID_SOAL = '$ID_SOAL'");
  if($queryhapus){
  $_SESSION['hapus'] = 'berhasil';
    header('location:daftarSoal.php');
  }else{
    echo "Error: ".$queryhapus.". ".mysqli_error($koneksi);
  }
}
?>