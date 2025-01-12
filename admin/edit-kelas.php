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
              
              	  <p class="centered"><a href="profile.html"><img src="<?php echo $_SESSION['gambar']; ?>" class="img-circle" width="60"></a></p>
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
          	<h3><i class="fa fa-angle-right"></i> Kelas &raquo; Edit Kelas</h3>
          	
          	<!-- BASIC FORM ELELEMNTS -->
            <?php
            $query = mysql_query("SELECT * FROM kelas WHERE kode_kelas='$_GET[kd]'");
            $data  = mysql_fetch_array($query);
            ?>
          	<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                  	  <h4 class="mb"><i class="fa fa-angle-right"></i> Edit Kelas</h4>
                      <form class="form-horizontal style-form" action="update-kelas.php" method="post" name="form1" id="form1">
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kode Kelas</label>
                              <div class="col-sm-10">
                                  <input name="kode_kelas" type="text" id="kode_kelas" class="form-control" value="<?php echo $data['kode_kelas'];?>" autofocus="on" required="required" />
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Tahun Ajaran</label>
                              <div class="col-sm-10">
                                  <select name="tahun_ajar" id="tahun_ajar"  class="form-control" required />
                                    <option><?php echo $data['tahun_ajar'];?> </option>
                                    <option value="2018/2024">2018/2024</option>
                                    <option value="2019/2025">2019/2025</option>
                                    <option value="2020/2026">2020/2026</option>
                                    <option value="2021/2027">2021/2027</option>
                                    <option value="2022/2028">2022/2028</option>
                                    <option value="2023/2029">2023/2029</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Kelas</label>
                              <div class="col-sm-10">
                                  <select name="kelas" id="kelas"  class="form-control" required />
                                    <option> <?php echo $data['kelas'];?> </option>
                                    <option value="1-A">1-A</option>
                                    <option value="1-B">1-B</option>
                                    <option value="2-A">2-A</option>
                                    <option value="2-B">2-B</option>
                                    <option value="3-A">3-A</option>
                                    <option value="3-B">3-B</option>
                                    <option value="4-A">4-A</option>
                                    <option value="4-B">4-B</option>
                                    <option value="5-A">5-A</option>
                                    <option value="5-B">5-B</option>
                                    <option value="6-A">6-A</option>
                                    <option value="6-B">6-B</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Asal Sekolah</label>
                              <div class="col-sm-10">
                                  <select name="nama_kelas" id="nama_kelas"  class="form-control" required />
                                    <option> <?php echo $data['nama_kelas'];?> </option>
                                    <option value="SDN 01 KAPUK">SDN 01 KAPUK</option>
                                    <option value="MIZU">MI ZAHRATUL UMMAH</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Nama Pelatih</label>
                              <div class="col-sm-10">
                                  <select name="kode_guru" id="kode_guru"  class="form-control" required />
                                    <option> <?php echo $data['kode_guru'];?> </option>
                                    <?php
                                    $sql = mysql_query("SELECT * FROM guru ORDER BY kode_guru ASC");
                                    if(mysql_num_rows($sql) != 0){
                                    while($data = mysql_fetch_assoc($sql)){
                                    echo '<option value='.$data['kode_guru'].'>'.$data['nama_guru'].'</option>'; }
                                    $kode = $data['kode_guru'];
                                    }
                                    ?>
                                  </select>
                              </div>
                          </div>       
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Status Aktif</label>
                              <div class="col-sm-10">
                                    <select name="status_aktif" id="status_aktif" class="form-control" required />
                                    <option><?php echo $data['status_aktif'];?></option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                   </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label"></label>
                              <div class="col-sm-10">
                                  <input type="submit" value="Simpan" class="btn btn-sm btn-primary" />&nbsp;
	                              <a href="kelas.php" class="btn btn-sm btn-danger">Batal </a>
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
