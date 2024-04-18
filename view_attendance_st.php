<?php
	include"database.php";
	session_start();

	if (isset($_SESSION["ID"]))
		$logged_user = $_SESSION["NAME"];

	 else {
		echo"<script>window.open('Student_login.php?mes=Access Denied...','_self');</script>";
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Students</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?>
		<!--<img src="img/bg1.jpg" style="margin-left:90px;" class="sha">	--><br>
			<div id="section">
			<?php include"sidebar.php";?><br><br>
			<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>

				<div class="content">
				<div class="lbox">
				<h3 style="color: black;">View My Attendance Details</h3><br>
					<form  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label style="color: black;">Class</label><br>
					<select name="stu_class" class="input2">
						<?php 
							$sql="SELECT * FROM class
							JOIN lecturer ON class.TID = lecturer.TID
							JOIN sub ON class.SID = sub.SID
							ORDER BY CID ASC ";
							$re=$db->query($sql);
							if($re->num_rows>0)
							{
							echo"<option value=''>Select</option>";
							while($r=$re->fetch_assoc())
							{
							echo "<option value='{$r["CID"]}'>{$r["CID"]} - {$r["CNAME"]} {$r["SNAME"]} - {$r["TNAME"]}</option>";
							}
							}
						?>
					</select>
					<br><br>
							
				</div>
				<div class="rbox">
				<br><br>
					<label style="color: black;">Date</label><br>
					<input type="date" name="date" class="input2">
						<br><br>
				</div>
					<button type="submit" class="btn" name="view"> View Attendance</button>
				
						
					</form>
					<br>
					<br>
					<br>
					<div class="Output">
						<?php
							if(isset($_POST["view"]))
							{
								
								echo "<h3 style=color:black;>Student's Attendance Details</h3><br>";
								if(!empty($_POST['stu_class']) && !empty($_POST['date'])) {

									$sql="SELECT attendance.*, CLASS.*, student.ID, student.RNO, student.NAME, student.FNAME, lecturer.TNAME, sub.SNAME
								FROM attendance
									JOIN class ON attendance.CLASS = class.CID
									JOIN student ON attendance.STUDENT_ID = student.ID
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID
									WHERE CID = '{$_POST['stu_class']}' AND DATE = '{$_POST['date']}'";

								} elseif (!empty($_POST['stu_class'])) {

									$sql="SELECT attendance.*, CLASS.*, student.ID, student.RNO, student.NAME, student.FNAME, lecturer.TNAME, sub.SNAME
								FROM attendance
									JOIN class ON attendance.CLASS = class.CID
									JOIN student ON attendance.STUDENT_ID = student.ID
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID
									WHERE CID = '{$_POST['stu_class']}'";

								} elseif (!empty($_POST['date'])) {
									$sql="SELECT attendance.*, CLASS.*, student.ID, student.RNO, student.NAME, student.FNAME, lecturer.TNAME, sub.SNAME
								FROM attendance
									JOIN class ON attendance.CLASS = class.CID
									JOIN student ON attendance.STUDENT_ID = student.ID
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID
									WHERE DATE = '{$_POST['date']}'";
								} else {
									$sql="SELECT attendance.*, CLASS.*, student.ID, student.RNO, student.NAME, student.FNAME, lecturer.TNAME, sub.SNAME
								FROM attendance
									JOIN class ON attendance.CLASS = class.CID
									JOIN student ON attendance.STUDENT_ID = student.ID
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID";
								}

								$re=$db->query($sql);
								if($re->num_rows>0)
								{ 
									echo '
										<table border="1px">
										<tr>
											<th>S.No</th>
											<th>Date</th>
											<th>Class</th>
											<th>Student</th>
											<th>Participation</th>
										</tr>
									
									
									';
									$i=0;
									while($r=$re->fetch_assoc())
									{
										$i++;
										echo "
										<tr>
											<td>{$i}</td>
											<td>{$r["DATE"]}</td>
											<td>{$r["CID"]} - {$r["CNAME"]} {$r["SNAME"]} - {$r["TNAME"]}</td>
											<td>{$r["RNO"]} - {$r["FNAME"]} {$r["NAME"]}</td>
											<td>{$r["PAR"]}</td>
										</tr>
										";
										
									}
								}
							else
							{
								echo "No record Found";
							}
								echo "</table>";
							}
						
						
						?>
					
					</div>
				</div>
				
				
			</div>
	
			<div class="footer" style="margin-top:120px; width:100%;">
			<footer><p>Copyright &copy; Rajarata University of Sri Lanka. All Rights Reserved. </p></footer>
</div>
		<script src="js/jquery.js"></script>
		 <script>
		$(document).ready(function(){
			$(".error").fadeTo(1000, 100).slideUp(1000, function(){
					$(".error").slideUp(1000);
			});
			
			$(".success").fadeTo(1000, 100).slideUp(1000, function(){
					$(".success").slideUp(1000);
			});
		});
	</script>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>