<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
	
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Exams</title>
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
				
					<h3 style="color: black;">View Exam</h3><br>
					<form  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="lbox1">	
					
						<label style="color: black;" >Exam Date</label><br>
						<select name="edate" class="input3">
				
						<?php 
							 $sl="SELECT * FROM exam";
							$r=$db->query($sl);
								if($r->num_rows>0)
									{
										echo"<option value=''>Select</option>";
										while($ro=$r->fetch_assoc())
										{
											echo "<option value='{$ro["EDATE"]}'>{$ro["EDATE"]}</option>";
										}
									}
						?>
					
					</select>
				</div>
				<div class="rbox">
					<label style="color: black;">Class</label><br>
					<select name="cla" class="input3">
				
						<?php 
							 $sl="SELECT DISTINCT(CNAME) FROM class";
							$r=$db->query($sl);
								if($r->num_rows>0)
									{
										echo"<option value=''>Select</option>";
										while($ro=$r->fetch_assoc())
										{
											echo "<option value='{$ro["CNAME"]}'>{$ro["CNAME"]}</option>";
										}
									}
						?>
					
					</select>
					<br><br>
				</div>
					<button type="submit" class="btn" name="view">View Exam's Details</button>
				
					</form>
					<br>
					
					<div class="Output">
						<?php
							if(isset($_POST["view"]))
							{
								echo "<h3 style='color: black;'>Exam Time Table</h3><br>";
								if (!empty($_POST["edate"]) && !empty($_POST["cla"])) {
									$sql="SELECT * FROM exam WHERE EDATE='{$_POST["edate"]}' AND CLASS='{$_POST["cla"]}'";
								} elseif (!empty($_POST["edate"]) ) {
									$sql="SELECT * FROM exam WHERE EDATE='{$_POST["edate"]}'";
								} elseif (!empty($_POST["cla"])) {
									$sql="SELECT * FROM exam WHERE CLASS='{$_POST["cla"]}'";
								} else {
									$sql="SELECT * FROM exam";
								}

								$re=$db->query($sql);
								if($re->num_rows>0)
								{
									echo '
										<table border="1px">
											<tr>
												<th>S.NO</th>
												<th>Date</th>
												<th>Class</th>
												<th>Subject</th>
												<th>Exam Name</th>
												<th>Exam Type</th>
												<th>Session</th>
											</tr>
											';
											
											$i=0;
											while($r=$re->fetch_assoc())
											{
												$i++;
												echo"
													<tr>
														<td>{$i}</td>
														<td>{$r["EDATE"]}</td>
														<td>{$r["CLASS"]}</td>
														<td>{$r["SUB"]}</td>
														<td>{$r["ENAME"]}</td>
														<td>{$r["ETYPE"]}</td>
														<td>{$r["SESSION"]}</td>
													
													</tr>
												
												";
												
												
												
											}
								}
								else
								{
									echo "No Record Found";
								}
								echo "</table>";
								
							}
						
						
						?>
					
					</div>
				</div>
			</div>
			<div class="footer" style="margin-top:150px; width:100%;">
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