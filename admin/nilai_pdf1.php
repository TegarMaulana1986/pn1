<?php

session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
require('../fpdf17/fpdf.php');
require('../conn.php');


//Select the Products you want to show in your PDF file
//$result=mysql_query("SELECT * FROM daily_bbri where date like '%$periode%' ");
$kodesaya = $_GET['kd'];
$kode = $_GET['kode'];
/** $result=mysql_query("SELECT nilai.*, pelajaran.nama_pelajaran, pelajaran.kkm, siswa.nama_siswa, siswa.nis, kelas_siswa.jurusan FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
                LEFT JOIN kelas_ siswa ON nilai.kode_siswa = kelas_siswa.kode_siswa
				WHERE nilai.id = $kodesaya ORDER BY semester, kode_pelajaran ASC") or die(mysql_error());**/
                
$result=mysql_query("SELECT siswa.kode_siswa, siswa.nis, siswa.nama_siswa,
                                        nilai.semester, pelajaran.nama_pelajaran, pelajaran.kkm,
                                        nilai.nilai_tugas1, nilai.nilai_tugas2,
                                        nilai.nilai_uts, nilai.nilai_uas, nilai.keterangan,
                                        kelas_siswa.jurusan, kelas.tahun_ajar, kelas.kelas
                                        FROM siswa, nilai, pelajaran, kelas, kelas_siswa
                                        WHERE siswa.kode_siswa=nilai.kode_siswa AND
                                        nilai.kode_pelajaran=pelajaran.kode_pelajaran AND 
                                        kelas.kode_kelas=kelas_siswa.kode_kelas AND
                                        kelas_siswa.kode_siswa=siswa.kode_siswa AND
                                        siswa.kode_siswa='$kodesaya' AND nilai.semester='$kode'") or die(mysql_error());
            
//Initialize the 3 columns and the total
$column_date = "";
$column_time = "";
$column_standmeter = "";
//$column_factor = "";
//$column_total = "";
$column_nilai = "";
$column_rata = "";

//For each row, add the field to the corresponding column
$no=0;
while($row = mysql_fetch_array($result))
{ $no++;
	$kode_siswa = $row["kode_siswa"];
    $nis = $row["nis"];
    $nama = $row["nama_siswa"];
    $jurusan = $row["jurusan"];
    $semester = $row["semester"];
	$date = $no;
    $time = $row["nama_pelajaran"];
    $standmeter = $row["kkm"];
    //$factor = $row["nilai_uts"];
    //$total = $row["nilai_uas"];
    $kelas = $row["kelas"];
    $tahun = $row["tahun_ajar"];
    $ket = $row["keterangan"];
    $nilai = $row["nilai_uas"];
    $rata = $row["keterangan"];	

	$column_date = $column_date.$date."\n";
	$column_time = $column_time.$time."\n";
	$column_standmeter = $column_standmeter.$standmeter."\n";
	//$column_factor = $column_factor.$factor."\n";
	//$column_total = $column_total.$total."\n";
    $column_nilai = $column_nilai.$nilai."\n";
    $column_rata = $column_rata.$rata."\n";		

            
//mysql_close();

//Create a new PDF file
$pdf = new FPDF('P','mm',array(210,594)); //L For Landscape / P For Portrait
$pdf->AddPage();

$pdf->Image('../foto/logo.png',10,10,-175);
//$pdf->Image('../images/BBRI.png',190,10,-200);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(80);
$pdf->Cell(30,10,'SMP 34 JAKARTA',0,0,'C');
$pdf->Ln();
$pdf->Cell(80);
$pdf->Cell(30,10,'RAPORT NILAI SISWA',0,0,'C');
$pdf->Ln();

//Fields Name position
$Y_Fields_Name_position = 40;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'Kode Siswa : '.$kode_siswa,0,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'Tahun Ajaran : '.$tahun,0,0,'R',1);
$pdf->Ln();

//Field Name Position
$Y_Fields_Name_position = 48;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'NIS : '.$nis,0,0,'L',1);
$pdf->SetX(45);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'Kelas : '.$kelas,0,0,'R',1);
$pdf->Ln();

//Field Name Position
$Y_Fields_Name_position = 56;
$pdf->SetFillColor(255,255,255);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'Nama Siswa : '.$nama,0,0,'L',1);
$pdf->SetX(100);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'Semester : '.$semester,0,0,'R',1);
$pdf->Ln();

$Y_Fields_Name_position = 64;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
//$pdf->SetFont('Arial','B',10);
//$pdf->SetY($Y_Fields_Name_position);
//$pdf->SetX(5);
//$pdf->Cell(60,8,'Alamat Sekolah : Jl. Raya Rajeg - Mauk Ds. Sukamanah Kec. Sukatani',0,0,'L',1);
//$pdf->SetX(160);
//$pdf->Cell(40,8,'',0,0,'L',1);
//$pdf->SetX(85);
//$pdf->Cell(50,8,'',0,0,'C',1);
//$pdf->SetX(135);
//$pdf->Cell(25,8,'',0,0,'C',1);
//$pdf->SetX(160);
//$pdf->Cell(45,8,'Semester : '.$semester,0,0,'R',1);
$pdf->Ln();
}
//Fields Name position
$Y_Fields_Name_position = 71;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->SetX(15);
$pdf->Cell(50,8,'Mata Pelajaran',1,0,'C',1);
$pdf->SetX(65);
$pdf->Cell(60,8,'Kriteria Kelulusan Minimal (KKM)',1,0,'C',1);
$pdf->SetX(125);
$pdf->Cell(40,8,'Nilai Angka',1,0,'C',1);
$pdf->SetX(165);
$pdf->Cell(40,8,'Nilai Huruf',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 79;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,8,$column_date,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(50,8,$column_time,1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(65);
$pdf->MultiCell(60,8,$column_standmeter,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(125);
$pdf->MultiCell(40,8,$column_nilai,1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(165);
$pdf->MultiCell(40,8,$column_rata,1,'L');


//Footer Table
/** $pdf->SetFillColor(110,180,230);
$pdf->SetFont('Arial','B',12);
$pdf->SetX(5);
$pdf->Cell(40,8,'Keterangan',1,0,'C',1);
$pdf->SetX(45);
$pdf->Cell(160,8,$ket.'',1,0,'R',1);
$pdf->Ln();
$pdf->SetFillColor(110,180,230);
$pdf->Ln(10);**/

//After Footer
$Y_Fields_Name_position = 200;
$pdf->SetFillColor(110,180,230);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->SetX(15);
$pdf->Cell(160,8,'Nilai Karakter yang Dikembangkan',1,0,'C',1);
$pdf->SetX(175);
$pdf->Cell(30,8,'Nilai',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 208;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'1',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(160,10,'Sikap',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(175);
$pdf->MultiCell(30,10,'',1,'C');

$Y_Table_Position = 218;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'2',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(160,10,'Kerajinan',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(175);
$pdf->MultiCell(30,10,'',1,'C');
//Table position, under Fields Name

$Y_Table_Position = 228;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'3',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(160,10,'Kebersihan dan Kerapihan',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(175);
$pdf->MultiCell(30,10,'',1,'C');
//Table position, under Fields Nam

$Y_Fields_Name_position = 150;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name

/** Tabel Pertama **/

$Y_Fields_Name_position = 300;

//First create each Field Name
//Gray color filling each Field Name bo

$pdf->SetFillColor(110,180,230);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(200,8,'PENGEMBANGAN DIRI',1,0,'C',1);
$pdf->Ln();

$Y_Fields_Name_position = 308;
$pdf->SetFillColor(110,180,230);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(10,10,'No',1,0,'C',1);
$pdf->SetX(15);
$pdf->Cell(100,10,'Jenis Pengembangan Diri',1,0,'C',1);
$pdf->SetX(115);
$pdf->Cell(20,10,'Nilai',1,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(70,10,'Komentar',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 318;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'1',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(100,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(20,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');

$Y_Table_Position = 328;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'2',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(100,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(20,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');

$Y_Table_Position = 338;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'3',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(100,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(20,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');

$Y_Table_Position = 348;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'4',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(100,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(20,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');

$Y_Table_Position = 358;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'5',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(100,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(115);
$pdf->MultiCell(20,10,'',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');
/** Tabel Ke Dua **/

$Y_Fields_Name_position = 375;
$pdf->SetFillColor(110,180,230);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(10,8,'No',1,0,'C',1);
$pdf->SetX(15);
$pdf->Cell(120,8,'Ketidakhadiran',1,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(70,8,'Jumlah (Hari)',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 383;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'1',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(120,10,'Izin',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');

$Y_Table_Position = 393;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'2',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(120,10,'Sakit',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');
//Table position, under Fields Name

$Y_Table_Position = 403;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(10,10,'3',1,'C');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(15);
$pdf->MultiCell(120,10,'Tanpa Keterangan',1,'L');

$pdf->SetY($Y_Table_Position);
$pdf->SetX(135);
$pdf->MultiCell(70,10,'',1,'C');
//Table position, under Fields Name


/** Tabel Ketiga **/

$Y_Fields_Name_position = 420;
$pdf->SetFillColor(110,180,230);
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(200,8,'CATATAN',1,0,'C',1);
$pdf->Ln();

//Table position, under Fields Name
$Y_Table_Position = 428;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');


$Y_Table_Position = 438;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');

//Table position, under Fields Name

$Y_Table_Position = 448;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');

$Y_Table_Position = 458;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');

$Y_Table_Position = 468;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');

$Y_Table_Position = 478;

//Now show the columns
$pdf->SetFont('Arial','',10);

$pdf->SetY($Y_Table_Position);
$pdf->SetX(5);
$pdf->MultiCell(200,10,'',1,'C');
/**$mpdf->SetY(-55);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10);
$pdf->Cell(30,10,'PT. BBG',0,0,'C');
$pdf->Cell(105);
$pdf->Cell(30,10,'PT. BBRI',0,0,'C');
$pdf->Ln(20);
$pdf->Cell(10);
$pdf->Cell(30,10,'( ............................................................)',0,0,'C');
$pdf->Cell(107);
$pdf->Cell(30,10,'( ............................................................)',0,0,'C');
**/
/** Footer **/
$Y_Fields_Name_position = 508;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(160);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'...........................................................................',0,0,'R',1);
$pdf->Ln();

$Y_Fields_Name_position = 520;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'Orang Tua / Wali,',0,0,'L',1);
$pdf->SetX(160);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'Guru Kelas, ',0,0,'R',1);
$pdf->Ln();

$Y_Fields_Name_position = 545;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'(...........................................)',0,0,'L',1);
$pdf->SetX(160);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'(...........................................)',0,0,'R',1);
$pdf->Ln();

$Y_Fields_Name_position = 555;
$pdf->SetFillColor(255,255,255);
//First create each Field Name
//Bold Font for Field Name
$pdf->SetFont('Arial','B',10);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(5);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(160);
$pdf->Cell(40,8,'',0,0,'L',1);
$pdf->SetX(85);
$pdf->Cell(50,8,'',0,0,'C',1);
$pdf->SetX(135);
$pdf->Cell(25,8,'',0,0,'C',1);
$pdf->SetX(160);
$pdf->Cell(45,8,'NIP.........................................',0,0,'R',1);
$pdf->Ln();

$pdf->Output();
}
?>
