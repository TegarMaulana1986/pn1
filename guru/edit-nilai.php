<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../login-guru.php');	
} else {
	include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Penilaian Siswa">
    <meta name="author" content="">
    <meta name="keyword" content="">

    <title>Sistem Informasi Nilai Siswa</title>
    <link href='../pn1.png' rel='SHORTCUT ICON' />

    <!-- Bootstrap core CSS -->
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../admin/assets/js/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="../admin/assets/js/bootstrap-daterangepicker/daterangepicker.css" />
        
    <!-- Custom styles for this template -->
    <link href="../admin/assets/css/style.css" rel="stylesheet">
    <link href="../admin/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>SINIWA</b></a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../logout-guru.php" onclick="return confirm('Apakah anda akan keluar?');">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.html"><img src="../admin/<?php echo $_SESSION['gambar']; ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">
              <?php
              echo $_SESSION['nama'];
               ?></h5>
              	  	<?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../login-guru.php"; // Set logout URL

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
          	<h3><i class="fa fa-angle-right"></i> Nilai &raquo; Edit Nilai Siswa</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
            <?php
            $query = mysql_query("SELECT * FROM nilai WHERE id='$_GET[kd]'");
            $data  = mysql_fetch_array($query);
            ?>
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Kelas</h4>
                      <form class="form-horizontal style-form" action="update-nilai.php" method="post" name="form1" id="form1">
                       <div class="form-group">
                              <div class="col-sm-10">
                                  <input type="hidden" name="id" id="id" value="<?php echo $data['id']; ?>" class="form-control" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Semester</label>
                              <div class="col-sm-10">
                              <select name="semester" id="semester"  class="form-control" required />
                                    <option value="<?php echo $data['semester']; ?>"> <?php echo $data['semester']; ?> </option>
                                    <option value="1">1 - Ganjil</option>
                                    <option value="2">2 - Genap</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Materi</label>
                              <div class="col-sm-10">
                                  <input type="text" name="kode_pelajaran" id="kode_pelajaran" value="<?php echo $data['kode_pelajaran']; ?>" class="form-control" readonly="readonly" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Pelatih</label>
                              <div class="col-sm-10">
                                  <input type="text" name="kode_guru" id="kode_guru" value="<?php echo $data['kode_guru']; ?>" class="form-control" readonly="readonly" />
                              </div>
                          </div>
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Data Siswa</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kelas</label>
                             <div class="col-sm-10">
                                  <input type="text" name="kode_kelas" id="kode_kelas" value="<?php echo $data['kode_kelas']; ?>" class="form-control" readonly="readonly" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Siswa</label>
                             <div class="col-sm-10">
                                  <input type="text" name="kode_siswa" id="kode_siswa" value="<?php echo $data['kode_siswa']; ?>" class="form-control" readonly="readonly" />
                              </div>
                          </div>
                          <h4 class="mb"><i class="fa fa-angle-right"></i> Input Nilai</h4>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> ABSEN</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nilai_tugas1" id="nilai_tugas1" value="<?php echo $data['nilai_tugas1']; ?>" class="form-control" required="required"/>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Nilai Tugas 1</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nilai_tugas2" id="nilai_tugas2" value="<?php echo $data['nilai_tugas2']; ?>" class="form-control" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Nilai Tugas 2</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nilai_tugas3" id="nilai_tugas3" value="<?php echo $data['nilai_tugas3']; ?>" placeholder="Nilai Absen" class="form-control" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Nilai Tugas 3</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nilai_uts" id="nilai_uts" value="<?php echo $data['nilai_uts']; ?>" class="form-control" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> UKT</label>
                              <div class="col-sm-10">
                                  <input type="text" name="nilai_uas" id="nilai_uas" value="<?php echo $data['nilai_uas']; ?>" class="form-control" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"> Keterangan</label>
                              <div class="col-sm-10">
                                  <input type="text" name="keterangan" id="keterangan" value="<?php echo $data['keterangan']; ?>" class="form-control" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="nilai.php" class="btn btn-sm btn-danger">Batal </a>
                              </div>
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div><!-- /row -->
          	
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2025 &copy; TEGAR FIKRI MAULANA
              <a href="edit_nilai.php#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../admin/assets/js/jquery.js"></script>
    <script src="../admin/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../admin/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../admin/assets/js/jquery.scrollTo.min.js"></script>
    <script src="../admin/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../admin/assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="../admin/assets/js/jquery-ui-1.9.2.custom.min.js"></script>

	<!--custom switch-->
	<script src="../admin/assets/js/bootstrap-switch.js"></script>
	
	<!--custom tagsinput-->
	<script src="../admin/assets/js/jquery.tagsinput.js"></script>
	
	<!--custom checkbox & radio-->
	
	<script type="text/javascript" src="../admin/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="../admin/assets/js/bootstrap-daterangepicker/date.js"></script>
	<script type="text/javascript" src="../admin/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
	
	<script type="text/javascript" src="../admin/assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
	
	
	<script src="../admin/assets/js/form-component.js"></script>    
    
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>
