<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('lecturer_login.php?mes=Access Denied...','_self');</script>";
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title style="color: black;">View Students</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
			<div id="section">
			<?php include"sidebar.php";?><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><br><hr><br>
				<div class="content">
					
						<h3 style="color: black;">View Student's Details</h3><br>
					
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
							<th>R. No</th>
							<th>Name</th>
							<th>Father Name</th>
							<th>DOB</th>
							<th>Gender</th>
							<th>Phone</th>
							<th>Mail</th>
							<th>Address</th>
							<th>Image</th>
							<!-- <th>Update</th> -->
							<!-- <th>Delete</th> -->
						</tr>
						<?php
							$TID = $_SESSION['TID'];

							$sl="SELECT DISTINCT(student.ID) FROM lecturer
							JOIN class ON lecturer.TID = class.TID
							JOIN student_class ON class.CID = student_class.CID
							JOIN student ON student_class.stu_id = student.ID
							WHERE lecturer.TID = {$TID}
							ORDER BY student.ID ASC";
							$r=$db->query($sl);
							if($r->num_rows>0)
							{
								while($ro=$r->fetch_assoc())
								{
									$sql="SELECT student.*, class.* FROM lecturer 
									JOIN class ON lecturer.TID = lecturer.TID 
									JOIN student_class ON class.CID = student_class.CID 
									JOIN student ON student_class.stu_id = student.id 
									WHERE student.ID = {$ro['ID']}";
									
									$row=$db->query($sql);
									if($row->num_rows>0)
									{
										$ro1=$row->fetch_assoc();
											echo "
										<tr>
											<td>{$ro1["RNO"]}</td>
											<td>{$ro1["NAME"]}</td>
											<td>{$ro1["FNAME"]}</td>
											<td>{$ro1["DOB"]}</td>
											<td>{$ro1["GEN"]}</td>
											<td>{$ro1["PHO"]}</td>
											<td>{$ro1["MAIL"]}</td>
											<td>{$ro1["ADDR"]}</td>
											<td><img src='{$ro1["SIMG"]}' height='70' width='70'></td>
											<!--td><a href='student_update.php?id={$ro1["ID"]}' class='btnr'>Update</a><td-->
											<!--td><a href='student_delete.php?id={$ro1["ID"]}' class='btnr'>Delete</a><td-->
										</tr>
									
										";
										
									} else {
										echo "No Record Found";
									}
								}
							}
						
						?>
						
					</table>
				
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>