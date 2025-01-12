<?php
include("../conn.php");
 session_start();
if(empty($_SESSION)){
	header("Location: ../index.php");
}  
?>

 
			<?php
		 			 
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=nilai_exportxls.xls");
 
// Tampilkan isi table
			# fungsi ubah tanggal 
						/** function rubah_tanggal($tgl)
						 {
						 $exp = explode('-',$tgl);
						 if(count($exp) == 3)
						 {
						 $tgl = $exp[2].'-'.$exp[1].'-'.$exp[0];
						 }
						 return $tgl;
						 }
			 $plantname = $_GET['toxls'];
			 $date1	= rubah_tanggal($_GET['date1']);
			 $date2	= rubah_tanggal($_GET['date2']);**/
							 
			$sqlshow = mysql_query("SELECT * FROM nilai ORDER BY id
																  
												"); 
											//	$sql = mysqli_query($koneksi, "SELECT * FROM t_inventoryitems WHERE f_partcode='$id'");
		
			?>
	  
 
	<h3>Data Nilai Siswa</H>
	 
	<br>  
	<!-- <table>
	
			<tr>
			 <td width="0px">Plant :</td>  <td><?php //echo $plantname ?></td> 
			 <td width="0px">From : <?php //echo date("d-m-Y",strtotime($_GET['date1'])) ?></td>  
			 <td width="0px">Until : <?php //echo date("d-m-Y",strtotime($_GET['date2'])) ?></td> 
			 
		 </tr>
	</table>-->	
    <table>
	
			<tr>
			
			 <td width="0px">Tanggal : <?php echo date("d-m-Y") ?></td>  
			 
			 
		 </tr>
	</table>	
		 
		<table bordered="1">  
			<thead bgcolor="eeeeee" align="center">
			<tr bgcolor="eeeeee" >
	  
			  <th class="text-center">Id</th>
			   <th>Semester</th>
			   <th>Kode Materi</th>
			   <th class="text-right">Kode Pelatih </th>
               <th>Kode Kelas</th>
               <th>Kode Siswa</th>
               <th>SK 1</th>
               <th>SK 2</th>
               <th>SK 3</th>
               <th>SK 4</th>
               <th>SK 5</th>
               <th>SK 6</th>
               <th>SK 7</th>
               <th>SK 8</th>
               <th>SK 9</th>
               <th>SK 10</th>
               <th>SK 11</th>
               <th>SK 12</th>
               <th>SK 13</th>
               <th>SK 14</th>
               <th>UKT</th>
               <th width="500">Keterangan</th>
               
			  </tr>
			</thead>
			<tbody>
	 	
					
		</tbody>

		</div>
    </div>
</div>
   <?php
						
						//if (isset($_POST['show'])) {
							$rowshow = mysql_fetch_assoc($sqlshow);
							  
								//$nomor=0;
							while($rowshow = mysql_fetch_assoc($sqlshow)){					 
                                 //$nomor++;
								echo '<tr>';
								echo '<td>'.$rowshow['id'].'</td>';
								echo '<td>'.$rowshow['semester'].'</td>';
								//echo '<td>'.$rowshow['f_partname'].'/'.$rowshow['f_model'].'/'.$rowshow['f_maker'].'</td>';
                                echo '<td>'.$rowshow['kode_pelajaran'].'</td>';
                                echo '<td>'.$rowshow['kode_guru'].'</td>';
                                echo '<td>'.$rowshow['kode_kelas'].'</td>';
                                echo '<td>'.$rowshow['kode_siswa'].'</td>';
								echo '<td>'.$rowshow['nilai_tugas1'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas2'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas3'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas4'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas5'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas6'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas7'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas8'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas9'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas10'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas11'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas12'].'</td>';
                                echo '<td>'.$rowshow['nilai_tugas13'].'</td>';
                                echo '<td>'.$rowshow['nilai_uts'].'</td>';
                                echo '<td>'.$rowshow['nilai_uas'].'</td>';
                                echo '<td>'.$rowshow['keterangan'].'</td>';
								echo '</tr>';
							}
						 
								 
							
					//	}			//EOF IF				
					 ?>
  </table>   
 
   