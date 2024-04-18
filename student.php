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
		<title>View Students</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!--<img src="img/bg1.jpg" style="margin-left:90px;" class="sha">	--><br><br>
			<div id="section">
			<?php include"sidebar.php";?><br><br><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				<div class="content">
				<?php
                    if (isset($_GET["success"])) {
                        echo "<div class='success'>{$_GET["mes"]}</div>";
                    } elseif (isset($_GET["failed"])){
                        echo "<div class='error'>{$_GET["mes"]}</div>";
                    }
                ?>
				<h3 style="color: black;">View Student's Details</h3><br>
					<form  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="lbox1">	
						<label style="color: black;">Student R.No</label><br>
						<input type="text" name="rno" class="input3">
					<br><br>
						
				</div>
				<div class="rbox">
					<label style="color: black;">Student's Name</label><br>
					<select name="sname" class="input3">
				
						<?php 
							$sql="SELECT DISTINCT (NAME) FROM student ORDER BY NAME ASC";
							$re=$db->query($sql);
							if($re->num_rows>0)
							{
								echo"<option value=''>Select</option>";
								while($r=$re->fetch_assoc())
								{
									echo "<option value='{$r["NAME"]}'>{$r["NAME"]}</option>";
								}
							}
						?>
					
					</select>
					
				</div>
				
				</div>
				<button type="submit" class="btn" name="view"> View Student Details</button>
				</form>
				
					<br>
					<br>
					
		
					<div class="Output">
						<?php
							if(true)
							{
								echo "<h3 style='margin-top:400px; color:black;'>Student's Details</h3><br>";
								if(!empty($_POST['rno']) && !empty($_POST['sname'])) {
									$sql = "SELECT * FROM student WHERE RNO LIKE '{$_POST["rno"]}' AND NAME LIKE '{$_POST["sname"]}'";
								} else if(!empty($_POST['rno'])) {
									$sql = "SELECT * FROM student WHERE RNO LIKE '{$_POST["rno"]}'";
								} else if(!empty($_POST['sname'])) {
									$sql = "SELECT * FROM student WHERE NAME LIKE '{$_POST["sname"]}'";
								} else {
									$sql = "SELECT * FROM student";
								}
								
								$re=$db->query($sql);
								if($re->num_rows>0)
								{
									echo '
										<table border="1px">
										<tr>
											<th>S.No</th>
											<th>Roll No</th>
											<th>Name</th>
											<th>Father Name</th>
											<th style="width:100px">DOB</th>
											<th>Gender</th>
											<th>Phone</th>
											<th>Mail</th>
											<th>Address</th>
											<th>Image</th>
											<th>Update</th>
											<th>Delete</th>
										</tr>
									
									
									';
									$i=0;
									while($r=$re->fetch_assoc())
									{
										$i++;
										echo "
										<tr>
											<td>{$i}</td>
											<td>{$r["RNO"]}</td>
											<td>{$r["NAME"]}</td>
											<td>{$r["FNAME"]}</td>
											<td style='width:100px;'>{$r["DOB"]}</td>
											<td>{$r["GEN"]}</td>
											<td>{$r["PHO"]}</td>
											<td>{$r["MAIL"]}</td>
											<td>{$r["ADDR"]}</td>
											<td><img src='{$r["SIMG"]}' height='70' width='70'></td>
											<td><a href='student_update.php?stuid={$r["ID"]}' class='btnr'>Update</a></td>
											<td><a href='student_delete.php?stuid={$r["ID"]}' class='btnr'>Delete</a></td>
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
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>