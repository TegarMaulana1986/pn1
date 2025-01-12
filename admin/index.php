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
              
              	  <p class="centered"><a href="#"><img src="<?php echo $_SESSION['gambar']; ?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                   
                  	<div class="row mtbox">
                    
                    <?php $tampil=mysql_query("select * from guru order by kode_guru desc");
                        $total=mysql_num_rows($tampil);
                    ?>
                  		<div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                  			<div class="box1">
                                <h3><a href="guru.php" class="btn btn-lg btn-danger">Pelatih</a></h3>
					  			<span class="glyphicon glyphicon-list-alt"></span>
					  			<h3><?php echo "$total"; ?></h3>
                  			</div>
					  			<p>Memiliki <?php echo "$total"; ?> Orang Pelatih </p>
                  		</div>
                        
                        <?php $tampil=mysql_query("select * from siswa order by kode_siswa desc");
                        $total_siswa=mysql_num_rows($tampil);
                    ?>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
                                <h3><a href="siswa.php" class="btn btn-lg btn-primary">Siswa</a></h3>
					  			<span class="glyphicon glyphicon-user"></span>
					  			<h3><?php echo "$total_siswa"; ?></h3>
                  			</div>
					  			<p>memiliki  <?php echo "$total_siswa"; ?> Orang Siswa</p>
                  		</div>
                        <?php $tampil=mysql_query("select * from pelajaran order by kode_pelajaran desc");
                        $total_pelajaran=mysql_num_rows($tampil);
                    ?>
                  		<div class="col-md-2 col-sm-2 box0">
                  			<div class="box1">
                                <h3><a href="pelajaran.php" class="btn btn-lg btn-info">Materi</a></h3>
					  			<span class="glyphicon glyphicon-book"></span>
					  			<h3><?php echo "$total_pelajaran"; ?></h3>
                  			</div>
					  			<p>memiliki <?php echo "$total_pelajaran"; ?> Materi</p>
                  		</div>
                        <?php $tampil=mysql_query("select * from kelas order by kode_kelas desc");
                        $total_kelas=mysql_num_rows($tampil);
                    ?>
                  		<div class="col-md-4 col-sm-2 box0">
                  			<div class="box1">
                                <h3><a href="kelas.php" class="btn btn-lg btn-warning">Kelas & Tingkatan</a></h3>
					  			<span class="glyphicon glyphicon-home"></span>
					  			<h3><?php echo "$total_kelas"; ?></h3>
                  			</div>
					  			<p>memiliki <?php echo "$total_kelas"; ?> Kelas & Tingkatan</p>
                  		</div>
                        <?php $tampil=mysql_query("select * from user order by user_id desc");
                        $total_admin=mysql_num_rows($tampil);
                    ?>
                  		<div class="col-md-3 col-sm-2 box0">
                  			<div class="box1">
                                <h3><a href="admin.php" class="btn btn-lg btn-success">Admin</a></h3>
					  			<span class="glyphicon glyphicon-lock"></span>
					  			<h3><?php echo "$total_admin"; ?></h3>
                  			</div>
					  			<p>memiliki <?php echo "$total_admin"; ?> Orang Admin</p>
                  		</div>
                  	
                  	</div><!-- /row mt -->	
                    				
                    <div class="row">
						<!-- Info Data siswa Terbaru -->
					<div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Data Siswa Baru</h3> 
                        </div>
                        <div class="panel-body">
                        <div class="table-responsive">
                    <?php
                    $tampil=mysql_query("select * from siswa order by kode_siswa desc limit 1");
                    ?>
                  <table class="table table-bordered table-hover table-striped tablesorter">
                  
                      <tr>
                        <th>Nama Siswa <i class="fa fa-sort"></i></th>
                        <th>Jenis Kelamin <i class="fa fa-sort"></i></th>
                        <th>Alamat <i class="fa fa-sort"></i></th>
                        <th>Telepon <i class="fa fa-sort"></i></th>
                      </tr>
                     <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <tr>
                    <td><i class="fa fa-user"></i> <?php echo $data['nama_siswa']; ?></td>
                    <td><?php echo $data['kelamin'];?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td><?php echo $data['no_telepon'];?></td>
                    <?php   
              }
              ?>
                   </tbody>
                   
                   </table>
                   </div>
              </div> 
              </div>
            </div><!-- col-lg-12-->
                                        		
					</div><!-- /row -->
					
					<div class="row mt">
                      <!--CUSTOM CHART START -->
                      <div class="border-head">
                          
                      </div>
                      
					</div><!-- /row -->	
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
						<h3>DATA PELATIH</h3>
                                        
                        <?php
                        $tampil=mysql_query("select * from guru order by kode_guru desc limit 5");
                        while($data=mysql_fetch_array($tampil))
                    {
                        ?>
                      <!-- First Action -->
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>NO :<?php echo $data['nip']; ?></muted><br/>
                      		   <a href="#">Nama Pelatih : <?php echo $data['nama_guru']; ?>  </a> <br/> Jenis Kelamin : <?php echo $data['kelamin']; ?><br/>
                      		</p>
                      	</div>
                      </div>
                      <?php } ?>

                        
                      
                  </div><!-- /col-lg-3 -->
              </div><!--/row -->
          </section>
      </section>

      <!--main content end-->
      <!--footer start-->
      <?php include "footer.php"; ?>
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
	<script src="assets/js/zabuto_calendar.js"></script>	
	
		
	<script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
  

  </body>
</html>
