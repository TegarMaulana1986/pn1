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
      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> Nilai &raquo; Data Nilai Siswa</h3><br /><br />
          	<div class="row mt">
              </div>
              <br />
              <!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Cetak Nilai Siswa </h3> 
                        </div>
                        <div class="panel-body">
                        <center><h3>DATA NILAI SEMESTER SISWA</h3></center>
                           <center><h3>Nilai Raport</h3></center>
                        <div class="table-responsive">
                    <?php
                    $kodeku = $_GET['kd'];
                    /** $tampil=mysql_query("SELECT nilai.*, pelajaran.nama_pelajaran, siswa.nama_siswa, siswa.nis, kelas_siswa.jurusan FROM nilai
				LEFT JOIN pelajaran ON nilai.kode_pelajaran = pelajaran.kode_pelajaran
				LEFT JOIN siswa ON nilai.kode_siswa = siswa.kode_siswa
                LEFT JOIN kelas_siswa ON nilai.kode_siswa = kelas_siswa.kode_siswa
				WHERE nilai.id = $kodeku ORDER BY semester, kode_pelajaran ASC");**/
                
                $tampil=mysql_query("SELECT siswa.kode_siswa, siswa.nis, siswa.nama_siswa,
                                        nilai.semester, pelajaran.nama_pelajaran,
                                        nilai.nilai_tugas1, nilai.nilai_tugas2,
                                        nilai.nilai_uts, nilai.nilai_uas, nilai.keterangan,
                                        kelas_siswa.jurusan
                                        FROM siswa, nilai, pelajaran, kelas_siswa
                                        WHERE siswa.kode_siswa=nilai.kode_siswa AND
                                        nilai.kode_pelajaran=pelajaran.kode_pelajaran AND 
                                        kelas_siswa.kode_siswa=siswa.kode_siswa AND
                                        siswa.kode_siswa='$kodeku'") or die(mysql_error());
                     ?>
                 <!--<table class="table table-condensed table-hover table-striped tablesorter"> -->
                  
                     <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <table >
                    <tr>
                        <td >Kode Siswa</td>&nbsp;<td>&nbsp;:&nbsp;</td>&nbsp;<td><?php echo $data['kode_siswa']; ?></td> 
                    </tr>
                    <br />
                    <tr>
                        <td >Nis</td>&nbsp; <td>&nbsp;:&nbsp;</td>&nbsp; <td><?php echo $data['nis']; ?></td>
                    </tr>
                    <br />
                    <tr>
                        <td>Nama Siswa</td>&nbsp; <td>&nbsp;:&nbsp;</td>&nbsp; <td><?php echo $data['nama_siswa']; ?></td>
                    </tr>
                    <tr>
                        <td>Jurusan</td>&nbsp; <td>&nbsp;:&nbsp;</td>&nbsp; <td><?php echo $data['jurusan']; ?></td>
                    </tr>
                    <tr>
                        <td>Semester</td>&nbsp; <td>&nbsp;:&nbsp;</td> &nbsp;<td><?php echo $data['semester']; ?></td>
                    </tr>
                    </table><br />
                  <div class="table-responsive">
                  <table class="table table-responsive table-bordered table-hover table-striped tablesorter">
                        <th><center>Mata Pelajaran</center></th>
                        <th><center>Tugas 1 </center></th>
                        <th><center>Tugas 2 </center></th>
                        <th><center>UTS </center></th>
                        <th><center>UAS</center></th>
                        <th><center>Total Nilai</center></th>
                        <th><center>Nilai Rata - Rata</center></th>
                        
                      </tr>
                     
                    <tr>
                    <td><?php echo $data['nama_pelajaran']; ?></a></td>
                    <td><center><?php echo $data['nilai_tugas1']; ?></center></td>
                    <td><center><?php echo $data['nilai_tugas2'];?></center></td>
                    <td><center><?php echo $data['nilai_uts'];?></center></td>
                    <td><center><?php echo $data['nilai_uas'];?></center></td>
                    <td><center><?php $total = $data['nilai_tugas1'] + $data['nilai_tugas2'] + $data['nilai_uts'] + $data['nilai_uas'];
                                      $rata = $total / 4; 
                                      echo $total; ?></center></td>
                    <td><center><?php echo $rata;?></center></td>
                    </tr>
                    <tr>
                    <td>Keterangan</td>
                    <td colspan="6"><strong><?php echo $data['keterangan']; ?></strong></td>
                    </tr>
                    </table>
                    <?php } ?>
                   <!--<div class="text-Left">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala Sekolah,
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Diterima Oleh,
                  <br />
                  <br />
                  <br />
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hakko Bio Richard, A.Md Kom&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $data['nama_siswa']; ?>
                   </div> -->
                <div class="text-right">
                  <a class="btn btn-sm btn-danger tooltips" data-placement="bottom" data-original-title="Print Nilai" href="nilai_pdf.php?hal=edit-admin&kd=<?php echo $kodeku;?>"><span class="glyphicon glyphicon-print"></span></a>
              
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
