<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../index.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">
 <?php include "head.php"; ?>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <?php include "header.php"; ?>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="<?php echo $_SESSION['gambar']; ?>" class="img-circle" width="60" style="border: 3px solid white;"/></a></p>
              	  <h5 class="centered">
              <?php
              echo $_SESSION['fullname'];
               ?></h5>
              	  	<?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../index.php"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Session Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<?php } ?>
              	  	
                  <?php include 'menu.php'; ?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php
      $dataKelas 		= isset($_POST['cmbKelas']) ? $_POST['cmbKelas'] : '';
      $dataPelajaran 	= isset($_POST['cmbPelajaran']) ? $_POST['cmbPelajaran'] : '';
      $dataSemester	= isset($_POST['cmbSemester']) ? $_POST['cmbSemester'] : '';

# Filter Data Nilai berdasarkan Combo yang dipilih
$filterSQL	= "";
if(isset($_POST['btnPilih1'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas'";
}
elseif(isset($_POST['btnPilih2'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran'";
}
elseif(isset($_POST['btnPilih3'])) {
	$filterSQL = " WHERE nilai.kode_kelas = '$dataKelas' AND nilai.kode_pelajaran = '$dataPelajaran' AND nilai.semester = '$dataSemester'";
}
else {
	$filterSQL = "";
}
      ?>
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Nilai &raquo; Import Nilai Siswa</h3><br /><br />
          	
              <!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Import Nilai Siswa </h3> 
                        </div>
                        
                        <div class="panel-body">
                        <div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4>Pastikan Extensi File Excel yang digunakan excel 2003 (.xls) untuk format excel anda bisa download  <a href="nilai.xls">di sini</a></h4></div>
                        <?php
//koneksi ke database, username,password  dan namadatabase menyesuaikan 
//mysql_connect('localhost', 'username', 'password');
//mysql_select_db('namadatabase');
 
//memanggil file excel_reader
require "excel_reader.php";
 
//jika tombol import ditekan
if(isset($_POST['submit'])){
 
    $target = basename($_FILES['filepegawaiall']['name']) ;
    move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
    
    $data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);
    
//    menghitung jumlah baris file xls
    $baris = $data->rowcount($sheet_index=0);
    
//    jika kosongkan data dicentang jalankan kode berikut
    $drop = isset( $_POST["drop"] ) ? $_POST["drop"] : 0 ;
    if($drop == 1){
//             kosongkan tabel pegawai
             $truncate ="TRUNCATE TABLE nilai";
             mysql_query($truncate);
    };
    
//    import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
    for ($i=2; $i<=$baris; $i++)
    {
//       membaca data (kolom ke-1 sd terakhir)
      $id            = $data->val($i, 1);
      $semester      = $data->val($i, 2);
      $kode_pelajaran= $data->val($i, 3);
      $kode_guru     = $data->val($i, 4);
      $kode_kelas    = $data->val($i, 5);
      $kode_siswa    = $data->val($i, 6);
      $nilai_tugas1  = $data->val($i, 7);
      $nilai_tugas2  = $data->val($i, 8);
      $nilai_tugas3  = $data->val($i, 9);
      $nilai_tugas4  = $data->val($i, 10);
      $nilai_tugas5  = $data->val($i, 11);
      $nilai_tugas6  = $data->val($i, 12);
      $nilai_tugas7  = $data->val($i, 13);
      $nilai_tugas8  = $data->val($i, 14);
      $nilai_tugas9  = $data->val($i, 15);
      $nilai_tugas10  = $data->val($i, 16);
      $nilai_tugas11  = $data->val($i, 17);
      $nilai_tugas12  = $data->val($i, 18);
      $nilai_tugas13  = $data->val($i, 19);
      $nilai_uts      = $data->val($i, 20);
      $nilai_uas      = $data->val($i, 21);
      $keterangan     = $data->val($i, 22);      
 
//      setelah data dibaca, masukkan ke tabel pegawai sql
      $query = "INSERT INTO nilai (semester, kode_pelajaran, kode_guru, kode_kelas, kode_siswa, nilai_tugas1, nilai_tugas2, nilai_tugas3, nilai_tugas4, nilai_tugas5, nilai_tugas6, nilai_tugas7, nilai_tugas8, nilai_tugas9, nilai_tugas10, nilai_tugas11, nilai_tugas12, nilai_tugas13, nilai_uts, nilai_uas, keterangan) VALUES 
                      ('$semester', '$kode_pelajaran', '$kode_guru', '$kode_kelas', '$kode_siswa', '$nilai_tugas1', '$nilai_tugas2', '$nilai_tugas3', '$nilai_tugas4', '$nilai_tugas5', '$nilai_tugas6', '$nilai_tugas7', '$nilai_tugas8', '$nilai_tugas9', '$nilai_tugas10', '$nilai_tugas11', '$nilai_tugas12', '$nilai_tugas13', '$nilai_uts', '$nilai_uas', '$keterangan')";
      $hasil = mysql_query($query);
    }
    
    if(!$hasil){
//          jika import gagal
          die(mysql_error());
      }else{
//          jika impor berhasil
          echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Data berhasil di import</div>';
    }
    
//    hapus file xls yang udah dibaca
    unlink($_FILES['filepegawaiall']['name']);
}
 
?>
 
<form name="myForm" id="myForm" onSubmit="return validateForm()" action="nilai_importxls.php" method="post" enctype="multipart/form-data">
    <input type="file" id="filepegawaiall" class="form-control" name="filepegawaiall" required /><br />
    <input type="submit" name="submit" class="brn btn-sm btn-success" value="Import" /><br/>
    <label><input type="checkbox" name="drop" value="1" /> <u>Kosongkan tabel sql terlebih dahulu.</u> </label>
</form>
 
<script type="text/javascript">
//    validasi form (hanya file .xls yang diijinkan)
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>
                        
              </div> 
              </div>
            </div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
          	
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <?php include "footer.php"; ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
