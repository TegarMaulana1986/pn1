<?php
include "../conn.php";
$kode_kelas   = $_POST['kode_kelas'];
$tahun_ajar   = $_POST['tahun_ajar'];
$kelas        = $_POST['kelas'];
$nama_kelas   = $_POST['nama_kelas'];
$kode_guru    = $_POST['kode_guru'];


$cekwalikelas = mysql_query("SELECT * from kelas where kode_guru='$kode_guru'")or die(mysql_error());
	if(mysql_num_rows($cekwalikelas)>=1){
		echo "<script>alert('Pelatih tersebut sudah Memiliki Kelas'); window.location = 'input-kelas.php' </script>";
	}else {
$sqlCek="SELECT * FROM kelas WHERE nama_kelas='$nama_kelas' AND tahun_ajar='$tahun_ajar'";
	$qryCek=mysql_query($sqlCek) or die ("Eror Query".mysql_error()); 
	if(mysql_num_rows($qryCek)>=1){
		$pesanError[] = "Maaf, Nama Kelas<strong> $nama_kelas </strong> dengan <strong>tahun ajaran</strong> yang sama sudah dibuat";
	} else {
    
$query = mysql_query("INSERT INTO kelas (kode_kelas, tahun_ajar, kelas, nama_kelas, kode_guru) VALUES 
                      ('$kode_kelas', '$tahun_ajar', '$kelas', '$nama_kelas', '$kode_guru')")or die(mysql_error());
if ($query){
	echo "<script>alert('Data Berhasil dimasukan!'); window.location = 'kelas.php'</script>";	
} else {
	echo "<script>alert('Data Gagal dimasukan!'); window.location = 'kelas.php'</script>";	
}
}
}
?>