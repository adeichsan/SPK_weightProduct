<?php
session_start();
if (!@isset($_SESSION['ID_MHS']) && !@isset($_SESSION['ID_ADMIN'])) {
	header('location:http://localhost/TugasAkhir/index.php');
}
?>