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
		<title>Class Report</title>
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
					
						<h3 style="color: black;">Class Schedule Report</h3><br>


						<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<table style="width: 100%">
							<tr>
								<td>
									<label style="color: black;">Grade</label><br>
									<select name="grade" class="input2">
										<option value="">Select</option>
										<option value="Grade 6">Grade 6</option>
										<option value="Grade 7">Grade 7</option>
										<option value="Grade 8">Grade 8</option>
										<option value="Grade 9">Grade 9</option>
										<option value="Grade 10">Grade 10</option>
										<option value="Grade 11">Grade 11</option>
										<option value="Grade 12">Grade 12</option>
										<option value="Grade 13">Grade 13</option>
									</select>
								</td>

								<td>
									<label style="color: black;">Class Day</label><br>
									<select name="classday" class="input2">
										<option value="">Select</option>
										<option value="Monday">Monday</option>
										<option value="Tuesday">Tuesday</option>
										<option value="Wednesday">Wednesday</option>
										<option value="Thursday">Thursday</option>
										<option value="Friday">Friday</option>
										<option value="Saturday">Saturday</option>
										<option value="Sunday">Sunday</option>
									</select>
								</td>
							</tr>
						</table>
					
						   <button type="submit" class="btn" name="submit">Search Class Details</button>
						   <button type="button" class="btn" onclick="location.href='class_report.php'">Show All</button>
						</form>
					
					<br>
					<br>
					<br>
					<br>
					<br><br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
		
				
				</div>

				<table id="example" class="display nowrap" style="width: 100%; ">
            
			<thead>
				<tr>
					<th>Class ID</th>
					<th>Grade</th>
					<th>Subject</th>
					<th>Lecturer</th>
					<th>Commencement</th>
					<th>Class Day</th>
					<th>Class Time</th>
					<th>Total Students</th>
				</tr>
			</thead>

			<tbody>
  
			  <?php
				  if(!empty($_GET['grade']) && !empty($_GET['classday'])){
					$s="SELECT * 
					FROM class
					JOIN lecturer ON class.TID = lecturer.TID
					JOIN sub ON class.SID = sub.SID
					WHERE CNAME = '{$_GET["grade"]}' AND CLASS_DAY = '{$_GET["classday"]}'";
				} else if (!empty($_GET['grade'])){
					$s="SELECT * 
					FROM class
					JOIN lecturer ON class.TID = lecturer.TID
					JOIN sub ON class.SID = sub.SID
					WHERE CNAME = '{$_GET["grade"]}'";
				} else if (!empty($_GET['classday'])){ 
					$s="SELECT * 
					FROM class
					JOIN lecturer ON class.TID = lecturer.TID
					JOIN sub ON class.SID = sub.SID
					WHERE CLASS_DAY = '{$_GET["classday"]}'";
				} else {
					$s="SELECT * 
					FROM class
					JOIN lecturer ON class.TID = lecturer.TID
					JOIN sub ON class.SID = sub.SID";
				}

				  
				$res=$db->query($s);
				if($res->num_rows>0)
				{
					while($r=$res->fetch_assoc())
					{
					$commencement = $r["COMM_DATE"];
					date_default_timezone_set('Asia/Colombo');
					$today = date("Y-m-d"); 
					if ($today<$commencement){
						$commencement = "Commences on ".$r["COMM_DATE"];
					} else if ($today==$commencement){
						$commencement = "Commences today";
					} else if ($today>$commencement) {
						$commencement = "Commenced";
					}
						 
			?>

			  <tr>
				  <td><?php echo $r["CID"] ?></td>
				  <td><?php echo $r["CNAME"] ?></td>
				  <td><?php echo $r["SNAME"] ?></td>
				  <td><?php echo $r["TNAME"] ?></td>
				  <td><?php echo $commencement ?></td>
				  <td><?php echo $r["CLASS_DAY"] ?></td>
				  <td><?php echo $r["CLASS_TIME"] ?></td>
				  <?php
					  $sql = "SELECT COUNT(stu_id) AS stu_count FROM student_class WHERE CID={$r["CID"]}";
					 $res1=$db->query($sql);
					 if($res1->num_rows>0)
					 {
						$r2=$res1->fetch_assoc()
				  ?>
				  <td><?php echo $r2["stu_count"] ?></td>
				  <?php } ?>
			  </tr>

			  <?php
					  }
				  }
				?>
			</tbody>
	  </table>
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