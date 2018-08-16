<?php
include '../../checkLogin.php';
include '../../connect.php';
$id_mhs = $_SESSION['ID_MHS'];
$id_soal = $_SESSION['sedang_ngerjakan_soal'];
$bantu = gmdate("Y-m-d h:i", time()+60*60*7);

function nomor() {
	include '../../connect.php';
  $sql = mysqli_query($koneksi,"SELECT ID_HASIL FROM `hasiltkd` ORDER BY ID_HASIL DESC LIMIT 0,1");
  list ($no_temp) = mysqli_fetch_row($sql);

  if ($no_temp == '') {
  $no_urut = 'TKD001';
  } else {
  $jum = substr($no_temp,3,5);
  $jum++;
  if($jum <= 9) {
      $no_urut = 'TKD00' . $jum;
  } elseif ($jum <= 99) {
      $no_urut = 'TKD0' . $jum;
  } elseif ($jum <= 999) {
      $no_urut = 'TKD' . $jum;
  } else {
      die("Nomor urut melebih batas");        
  }
  }
  return $no_urut;
  }

if (@$_POST['aksi'] === 'njawab') {
	# simpan jawaban ke sesi
	
	$jawaban_sebelumnya = $_SESSION['jawaban_sebelumnya'];
	$jawaban_sebelumnya .= @$_POST['jawaban'];
	$_SESSION['jawaban_sebelumnya'] = $jawaban_sebelumnya;
	$_SESSION['progress_soal'] = $_SESSION['progress_soal'] + 1;

	if ($_SESSION['progress_soal'] > 10 || @$_POST['waktu_habis'] === '1') {
			$jawaban = explode(",", $_SESSION['jawaban_sebelumnya']);
			$idSoal = explode(",", preg_replace("/[\(\)]/", "", $_SESSION['id_soal_yang_sudah_dirandom']));
			
			echo "ID ALTERNATIF: {$_SESSION['sedang_ngerjakan_soal']}<br>";
			
			var_dump($jawaban);
			echo "<hr>";
			var_dump($idSoal);
			echo "<hr>"; 
			$skor = 0;
			for ($i=0; $i < count($jawaban); $i++) { 
				$jawabanYangDipih = $jawaban[$i]; 
				$idSoalYangDipilih = $idSoal[$i];

				$query = mysqli_query($koneksi, "select JAWABAN_BENAR from soal_tkd where id_soal='{$idSoalYangDipilih}'");
				$nilai = mysqli_fetch_array($query);

				if ($nilai['JAWABAN_BENAR'] == $jawabanYangDipih) {
						$skor += 5;
						echo "bener";
						echo "bgt : $nilai[JAWABAN_BENAR]<br>";	
						echo "Skor: $skor<br>";
						echo "jawabanku : $jawabanYangDipih<br>";
				}
				else{
					echo "<hr>";
					echo "salah <br>";
					echo "fix : $nilai[JAWABAN_BENAR]<br>";	
					echo "jawabanku : $jawabanYangDipih<br>";
					echo "<hr>";
				}
				
			}
			$idAuto = nomor();
			$sql = mysqli_query($koneksi,"INSERT INTO `hasiltkd`(ID_HASIL,ID_MHS, ID_ALTERNATIF, HASIL, TANGGAL) VALUES ('$idAuto','$id_mhs','$id_soal','$skor','$bantu')") ;
				if ($sql) {
				 header('location:quiz.php');
				} else {
				 echo "Error: ".$sql.". ".mysqli_error($koneksi);
				}

			$_SESSION['jawaban_sebelumnya'] = "";
			$_SESSION['progress_soal'] = null;
		} else {
			$_SESSION['jawaban_sebelumnya'] = $_SESSION['jawaban_sebelumnya'] . ',';
			header("location: soal.php?id={$_POST['id_alternatif']}&soal={$_SESSION['progress_soal']}");
		}

	// var_dump($_SESSION);
	
}