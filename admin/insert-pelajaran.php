<?php
include "../conn.php";
$kode_pelajaran = $_POST['kode_pelajaran'];
$nama_pelajaran = $_POST['nama_pelajaran'];
$kkm            = $_POST['kkm'];
$keterangan     = $_POST['keterangan'];

#    $ceknis = mysql_query("SELECT * FROM pelajaran where nama_pelajaran=$nama_pelajaran")or die(mysql_error());
#   if (mysql_num_rows($ceknis)>=1) {
#        echo "<script>alert('Nama Pelajaran Sudah di Input'); window.location = 'input-siswa.php' </script>";
#        die();
#  }

$query = mysql_query("INSERT INTO pelajaran (kode_pelajaran, nama_pelajaran, kkm, keterangan) VALUES 
                      ('$kode_pelajaran', '$nama_pelajaran', '$kkm', '$keterangan')")or die(mysql_error());
if ($query){
	echo "<script>alert('Data Berhasil dimasukan!'); window.location = 'pelajaran.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dimasukan!'); window.location = 'pelajaran.php'</script>";	
}
?>