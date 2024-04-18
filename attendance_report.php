<?php
	include"database.php";
	session_start();
	if (isset($_SESSION["AID"])){
		$logged_user = $_SESSION["ANAME"];
	} elseif (isset($_SESSION["NAID"])) {
		$logged_user = $_SESSION["NANAME"];
	} else {
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Attendance Report</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style_reports.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
		<link
		rel="stylesheet"
		type="text/css"
		href="DataTables/jquery.dataTables.min.css"
		/>
		<link
		rel="stylesheet"
		type="text/css"
		href="DataTables/buttons.dataTables.min.css"
		/>
	</head>
	<body>
				<?php include"navbar.php";?><br>
				<!-- <img src="img/bg1.jpg" style="margin-left:90px;" class="sha"> -->
				
			<div id="section">
					<?php include"sidebar.php";?><br><br><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
					<div class="content">
					
						<h3 style="color: black;">Attendance Report</h3><br>


						<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<table style="width: 100%">
							<tr>
								<td>
									<label style="color: black;">From Date</label><br>
									
									<input type="Date" id="min" name="fromdate" required class="input2" value="<?php if(isset($_GET['fromdate'])){echo $_GET['fromdate'];} ?>">
								</td>
								<td>
									<label style="color: black;">To Date</label><br>
						   			<input type="Date" id="max" name="todate" required class="input2" value="<?php if(isset($_GET['todate'])){echo $_GET['todate'];} ?>">
								</td>


                               
							</tr>
						</table>
        
						   <button type="submit" class="btn" name="submit">Search Attendance Details</button>
						   <button type="button" class="btn" onclick="location.href='attendance_report.php'">Show All</button>
						</form>
					
					<br>
					<br>
					<br>
					<br>
				
					
					<table id="example" class="display nowrap" style="width:100%">
            
						<thead>
							<tr>
                                    <th>Date</th>
									<th>Class</th>
									<th>Student</th>
									<th>Participation</th>
							</tr>
						</thead>
  
						<tbody>
			  
						  <?php
						  	if(isset($_GET['fromdate']) && isset($_GET['todate'])){
								$s="SELECT *
								FROM attendance
								JOIN student ON attendance.STUDENT_ID = student.ID
								JOIN class ON attendance.CLASS = class.CID
								WHERE DATE BETWEEN '{$_GET["fromdate"]}' AND '{$_GET["todate"]}'";
							} else {
								$s="SELECT *
								FROM attendance
								JOIN student ON attendance.STUDENT_ID = student.ID
								JOIN class ON attendance.CLASS = class.CID";
							}
							  
							  $res=$db->query($s);
							  if($res->num_rows)
							  {
								  while($r=$res->fetch_assoc())
								  {
									$sql = "SELECT * FROM class
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID
									WHERE CID ='{$r["CID"]}'";
									$res1=$db->query($sql);
									if($res1->num_rows)
									{
										while($r2=$res1->fetch_assoc())
										{
	
						  ?>
  
						  <tr>
							  <td><?php echo $r["DATE"]; ?></td>
							  <td><?php echo "{$r2["CID"]} - {$r2["CNAME"]} {$r2["SNAME"]} - {$r2["TNAME"]}"; ?></td>
							  <td><?php echo "{$r["RNO"]} - {$r["NAME"]}" ?></td>
							  <td><?php echo "{$r["PAR"]}" ?></td>
						  </tr>
  
						  <?php
										}
									}

								}
							}
  
							?>
						</tbody>
				  </table>
				</div>
			</div>
	
			<script src="DataTables/jquery-3.5.1.js"></script>
			<script src="DataTables/jquery.dataTables.min.js"></script>
			<script src="DataTables/dataTables.buttons.min.js"></script>
			<script src="DataTables/buttons.flash.min.js"></script>
			<script src="DataTables/jszip.min.js"></script>
			<script src="DataTables/pdfmake.min.js"></script>
			<script src="DataTables/vfs_fonts.js"></script>
			<script src="DataTables/buttons.html5.min.js"></script>
			<script src="DataTables/buttons.print.min.js"></script>
			<!-- <script src="DataTables/date_range.js"></script> -->

			<script>
			$(document).ready(function () {
				$("#example").DataTable({
				// bFilter: false,
				dom: "Bfrtip",
				buttons: ["copy", "csv", "excel", "pdf", "print"],
				});
			});
			</script>
			
			<div class="footer" style="margin-top:50px;">
				<footer><p>Copyright &copy; Rajarata University of Sri Lanka. All Rights Reserved. </p></footer>
			</div>
							 
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>