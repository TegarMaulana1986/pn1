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
          	<h3><i class="fa fa-angle-right"></i> Laporan &raquo; Data Kelas</h3><br /><br />
          	<div class="row mt">
              <div class="col-lg-4">
              <form action='laporan-kelas.php' method="POST">
          
	       <input type='text' class="form-control" style="margin-bottom: 4px;" name='qcari' placeholder='Cari berdasarkan Kode Kelas atau Kelas' required /> 
           <input type='submit' value='Cari Data' class="btn btn-sm btn-primary" /> <a href='laporan-kelas.php' class="btn btn-sm btn-success" >Refresh</i></a>
          	</div>
              </div>
              <br />
              <!-- BASIC FORM ELELEMNTS -->
          	<div class="row mt">
          		<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-book"></i> Data Kelas </h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                    <?php
                    $query1="SELECT kelas.*, guru.nama_guru FROM kelas
				LEFT JOIN guru ON kelas.kode_guru = guru.kode_guru
				WHERE kelas.kode_guru = guru.kode_guru ORDER BY kode_kelas ASC";
                    
                    if(isset($_POST['qcari'])){
	               $qcari=$_POST['qcari'];
	               $query1="SELECT kelas.*, guru.nama_guru FROM kelas
				LEFT JOIN guru ON kelas.kode_guru = guru.kode_guru 
	               where kelas.kode_kelas like '%$qcari%'
	               or kelas.kelas like '%$qcari%'  ";
                    }
                    $tampil=mysql_query($query1) or die(mysql_error());
                    ?>
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  
                      <tr>
                        <th>Kode Kelas <i class="fa fa-sort"></i></th>
                        <th>Tahun Ajaran <i class="fa fa-sort"></i></th>
                        <th>Kelas <i class="fa fa-sort"></i></th>
                        <th>Nama Kelas <i class="fa fa-sort"></i></th>
                        <th>Wali Kelas <i class="fa fa-sort"></i></th>
                        <th>Status <i class="fa fa-sort"></i></th>
                      </tr>
                     <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <tr>
                    <td><?php echo $data['kode_kelas']; ?></td>
                    <td><?php echo $data['tahun_ajar'];?></td>
                    <td><?php echo $data['kelas'];?></td>
                    <td><?php echo $data['nama_kelas']; ?></td>
                    <td><?php echo $data['nama_guru'];?></td>
                    <td><?php echo $data['status_aktif'];?></td>
                    <?php   
              } 
              ?>
                   </tbody>
                   </table>
                   </div>
                <div class="text-right">
                  <a href="kelas_pdf.php" class="btn btn-sm btn-warning">Cetak  <i class="fa fa-print"></i></a>
              
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
