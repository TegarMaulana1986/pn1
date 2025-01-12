<?php
include "../conn.php";
$kode_pelajaran = $_POST['kode_pelajaran'];
$nama_pelajaran = $_POST['nama_pelajaran'];
$kkm = $_POST['kkm'];
$keterangan     = $_POST['keterangan'];

$query = mysql_query("UPDATE pelajaran SET nama_pelajaran='$nama_pelajaran', kkm='$kkm', keterangan='$keterangan' WHERE kode_pelajaran='$kode_pelajaran'")or die(mysql_error());
if ($query){
header('location:pelajaran.php');	
} else {
	echo "gagal";
    }
?>