<?php 
session_start();
if (empty($_SESSION['username'])){
	header('location:../login.html');	
} else {
	include "../conn.php";
    $_SESSION['nama'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">

    <title>SINIWA | Sistem Informasi Nilai Siswa</title>

    <!-- Bootstrap core CSS -->
    <link href="../admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../admin/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="../admin/assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../admin/assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="../admin/assets/css/style.css" rel="stylesheet">
    <link href="../admin/assets/css/style-responsive.css" rel="stylesheet">

    <script src="../admin/assets/js/chart-master/Chart.js"></script>
    
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
                    <li><a class="logout" href="../logout-siswa.php" onclick="return confirm('Do you want to logout?');">Logout</a></li>
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
              
              	  <p class="centered"><a href="#"><img src="../admin/<?php echo $_SESSION['gambar']?>" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">
                    Selamat Datang,<br />
                    <?php
              echo $_SESSION['nama'];
               ?></h5>
              	  	<?php
$timeout = 10; // Set timeout minutes
$logout_redirect_url = "../login.html"; // Set logout URL

$timeout = $timeout * 60; // Converts minutes to seconds
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Ups, your session was spent!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?>
<?php } ?>
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-book"></i>
                          <span>Nilai Raport</span>
                      </a>
                  </li>

                  <!--<li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span>Confimation & Tracking</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="payment.php">Payment Confirmation</a></li>
                          <li><a  href="destination.php">Destination Order</a></li>
                          <li><a  href="order-tracking.php">Order Tracking</a></li>
                      </ul>
                  </li>
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
                  <div class="border-head">
                  <h3>&raquo; DATA NILAI RAPORT SISWA</h3>
                      </div>
              
                      <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> Nilai Raport Siswa : <?php echo $_SESSION['nama']; ?> </h3> 
                        </div>
                        <div class="panel-body">
                        <center><h3>DATA NILAI SEMESTER SISWA</h3></center>
                           <center><h3>Nilai Raport</h3></center>
                    <?php
                    $siswa = $_SESSION['kode'];
                    
                    $tampil=mysql_query("SELECT siswa.kode_siswa, siswa.nis, siswa.nama_siswa,
                                        nilai.semester, pelajaran.nama_pelajaran,
                                        nilai.nilai_tugas1, nilai.nilai_tugas2, nilai.nilai_tugas3,
                                        nilai.nilai_uts, nilai.nilai_uas, nilai.keterangan, kelas_siswa.jurusan
                                        FROM siswa, nilai, pelajaran, kelas_siswa
                                        WHERE siswa.kode_siswa=nilai.kode_siswa AND
                                        nilai.kode_pelajaran=pelajaran.kode_pelajaran AND 
                                        kelas_siswa.kode_siswa=siswa.kode_siswa AND
                                        siswa.kode_siswa='$siswa'") or die(mysql_error());
                    ?>
                    <?php while($data=mysql_fetch_array($tampil))
                    { ?>
                    <table width="500">
                    <tr>
                        <td width="100">Kode Siswa</td> <td>:</td> <td><?php echo $data['kode_siswa']; ?></td> 
                    </tr>
                    <br />
                    <tr>
                        <td width="100">Nis</td> <td>:</td> <td><?php echo $data['nis']; ?></td>
                    </tr>
                    <br />
                    <tr>
                        <td width="100">Nama Siswa</td> <td>:</td> <td><?php echo $data['nama_siswa']; ?></td>
                    </tr>
                    <tr>
                        <td width="100">Jurusan</td> <td>:</td> <td><?php echo $data['jurusan']; ?></td>
                    </tr>
                    <tr>
                        <td width="100">Semester</td> <td>:</td> <td><?php echo $data['semester']; ?></td>
                    </tr>
                    </table><br />
                  <div class="table-responsive">
                  <table class="table table-responsive table-bordered table-hover table-striped tablesorter">
                        <th><center>Mata Pelajaran</center></th>
                        <th><center>Tugas 1 </center></th>
                        <th><center>Tugas 2 </center></th>
                        <th><center>Absen</center></th>
                        <th><center>UTS </center></th>
                        <th><center>UAS</center></th>
                        <th><center>Total Nilai</center></th>
                        <th><center>Nilai Rata - Rata</center></th>
                        
                      </tr>
                     
                    <tr>
                    <td><?php echo $data['nama_pelajaran']; ?></a></td>
                    <td><center><?php echo $data['nilai_tugas1']; ?></center></td>
                    <td><center><?php echo $data['nilai_tugas2'];?></center></td>
                    <td><center><?php echo $data['nilai_tugas3'];?></center></td>
                    <td><center><?php echo $data['nilai_uts'];?></center></td>
                    <td><center><?php echo $data['nilai_uas'];?></center></td>
                    <td><center><?php $total = $data['nilai_tugas1'] + $data['nilai_tugas2'] + $data['nilai_tugas3'] + $data['nilai_uts'] + $data['nilai_uas'];
                                      $rata = $total / 5; 
                                      echo $total; ?></center></td>
                    <td><center><?php echo $rata;?></center></td>
                    </tr>
                    <tr>
                    <td>Keterangan</td>
                    <td colspan="7"><strong><?php echo $data['keterangan']; ?></strong></td>
                    </tr>
                    </table>
                    <?php }
                    ?>
                <div class="text-right">
                  <a class="btn btn-sm btn-warning tooltips" data-placement="bottom" data-original-title="Print Nilai" href="cetak.php"><span class="glyphicon glyphicon-print"></span></a>
                  </div>
              </div> 
              </div>
              
                  
                  </div>
                  <!-- /col-lg-9 END SECTION MIDDLE -->
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
              </div><!--/row -->
          </section>
      </section>
      
<?php include "../admin/footer.php"; ?>
      <!--main content end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../admin/assets/js/jquery.js"></script>
    <script src="../admin/assets/js/jquery-1.8.3.min.js"></script>
    <script src="../admin/assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../admin/assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../admin/assets/js/jquery.scrollTo.min.js"></script>
    <script src="../admin/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../admin/assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="../admin/assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../admin/assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../admin/assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../admin/assets/js/sparkline-chart.js"></script>    
	<script src="../admin/assets/js/zabuto_calendar.js"></script>	
	
	<script type="text/javascript">
        $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Selamat Datang,',
            // (string | mandatory) the text inside the notification
            text:di SIAK AL-ISHLAH  <a href="" target="_blank" style="color:#ffd777">InAutomation</a>.',
            // (string | optional) the image to display on the left
            image: '../admin/<?php echo $_SESSION['gambar']; ?>',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: true,
            // (int | optional) the time you want it to be alive for before fading out
            time: '',
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
        });

        return false;
        });
	</script>
	
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
