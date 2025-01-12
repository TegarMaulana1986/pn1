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
          	<h3><i class="fa fa-angle-right"></i> Nilai &raquo; Data Nilai Siswa</h3><br /><br />
         	 <div class="row mt">
              <div class="col-lg-4">
              <form action='<?php $_SERVER['PHP_SELF']; ?>' target="_self" method="POST">
                    <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Pilih Kelas</label>
                              <div class="col-sm-10">
                                  <select name="cmbKelas" id="cmbKelas"  class="form-control" required />
                                    <option> ---- Pilih Salah Satu ---- </option>
                                    <?php
		                              $dataQry = mysql_query("SELECT * FROM kelas ORDER BY tahun_ajar");
		                              while ($dataRow = mysql_fetch_array($dataQry)) {
		                            	if ($dataRow['kode_kelas'] == $dataKelas) {
			                         	$cek = " selected";
			                             } else { $cek=""; }
			                             echo "<option value='$dataRow[kode_kelas]' $cek>$dataRow[kelas] | $dataRow[nama_kelas] ( $dataRow[tahun_ajar] )</option>";
	                                  	} 
                                    ?>
                                  </select><br />
                                  <input name="btnPilih1" type="submit" class="btn btn-sm btn-primary" value="Pilih &raquo" />
                                  <a href="nilai.php" class="btn btn-sm btn-warning"> Refresh </a>
                                  </div>
                    </div>      
                </div>
              </div>
              <br />
              <!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Siswa </h3> 
                        </div>
                        
                        <div class="panel-body">
                        <div class="text-right">
                        <!--<a href="nilai_importxls.php" class="btn btn-sm btn-success"><i class="fa fa-file"></i> Import Excel</a>&nbsp;
                        <a href="nilai_exportxls.php" class="btn btn-sm btn-primary"><i class="fa fa-file"></i> Export Excel</a>
                        -->
                        </div><br />
                        <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  
                      <tr>
                        <th>Nomor</th>
                        <th>NIS </th>
                        <th>Nama Siswa </th>
                        <th>Semester </th>
                        <th>SK 1 </th>
                        <th>SK 2 </th>
                        <th>ABSEN </th>
                        <th>UTS </th>
                        <th>UAS </th>
                        <th>Tools </th>
                      </tr>
                     <?php
                     $myQry = mysql_query("SELECT nilai.*, pelajaran.nama_pelajaran, siswa.nama_siswa, siswa.nis FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
				$filterSQL ORDER BY semester, kode_pelajaran ASC"); 
	           $nomor  = 0; 
	           while ($myData = mysql_fetch_array($myQry)) {
                $nomor++;
		          $Kode = $myData['id'];
                      
                     ?>
                      <tr>
                      <td> <?php echo $nomor; ?> </td>
		              <td> <?php echo $myData['nis']; ?> </td>
		              <td> <?php echo $myData['nama_siswa']; ?> </td>
		              <td> <?php echo $myData['semester']; ?> </td>
		              <td> <?php echo $myData['nilai_tugas1']; ?> </td>
		              <td> <?php echo $myData['nilai_tugas2']; ?> </td>
                      <td> <?php echo $myData['nilai_tugas3']; ?> </td>
		              <td> <?php echo $myData['nilai_uts']; ?> </td>
		              <td> <?php echo $myData['nilai_uas']; ?> </td>
                      <td><center><a class="btn btn-sm btn-primary tooltips" data-placement="bottom" data-original-title="Edit Nilai" href="edit-nilai.php?hal=edit-admin&kd=<?php echo $Kode;?>"><span class="glyphicon glyphicon-edit"></span></a>
                        <a class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-original-title="Hapus Nilai" href="hapus-nilai.php?hal=hapus&kd=<?php echo $Kode;?>"><span class="glyphicon glyphicon-trash"></a></center></td></tr>
                 <?php   
              } 
              ?>
                   </tbody>
                   </table>
                   </div>
                <div class="text-right">
                  <a href="input-nilai.php" class="btn btn-sm btn-warning">Input Nilai Siswa <i class="fa fa-arrow-circle-right"></i></a>
              
                </div>
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
