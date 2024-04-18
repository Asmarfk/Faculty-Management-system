<?php
error_reporting(0);
	include"database.php";
	session_start();
	if(!isset($_SESSION["NAME"]))
	{
		echo"<script>window.open('student_login.php?mes=Access Denied...','_self');</script>";
		
	}	
	
	
	$sql="SELECT * FROM student WHERE ID={$_SESSION["ID"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Student's Home</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["NAME"]; ?></h3><br><hr><br>
				<div class="content">
				
					<h3 style="color: black;">Update Profile</h3><br>
					<div class="lbox1">
					<?php
						if(isset($_POST["submit"]))
						{
							$target="student/";
							$target_file=$target.basename($_FILES["SIMG"]["name"]);
							
							if ($_FILES["SIMG"]["size"]>0) {
								if(move_uploaded_file($_FILES['SIMG']['tmp_name'],$target_file))
								{
									$sql="update student set PHO='{$_POST["PHO"]}',MAIL='{$_POST["MAIL"]}',ADDR='{$_POST["ADDR"]}',SIMG='{$target_file}'where ID={$_SESSION["ID"]}";
									$db->query($sql);
									echo"<script>window.open('student_home.php?image','_self');</script>";
								}
							} else {
								$sql="update student set PHO='{$_POST["PHO"]}',MAIL='{$_POST["MAIL"]}',ADDR='{$_POST["ADDR"]}' where ID={$_SESSION["ID"]}";
								$db->query($sql);
								echo"<script>window.open('student_home.php?success','_self');</script>";
							}
						}
					
					?>
					
					
					
					
						
					<form  enctype="multipart/form-data" role="form"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<label style="color: black;">  Phone No</label><br>
							<input type="text" maxlength="10" required class="input3" name="PHO" value="<?php echo $row["PHO"] ?>"><br><br>
							<label style="color: black;">  E - mail</label><br>
							<input type="email"  class="input3" required name="MAIL" value="<?php echo $row["MAIL"] ?>"><br><br>
							<label style="color: black;">  Address</label><br>
							<textarea rows="5" name="ADDR" ><?php echo $row["ADDR"] ?></textarea><br><br>
							<label style="color: black;"> Image</label><br>
							<input type="file"  class="input3" name="SIMG"><br><br>
						<button type="submit" class="btn" name="submit">Update Profile Details</button>
						</form>
					</div>
					
					
					
					
					<div class="rbox1">
					<h3 style="color: black;"> Profile</h3><br>
						<table border="1px">
							<tr><td colspan="2"><img src="<?php echo $row["SIMG"] ?>" height="100" width="100" alt="upload Pending"></td></tr>
							<tr><th>Name </th> <td><?php echo $row["NAME"] ?> </td></tr>
							
							<tr><th>Phone No </th> <td> <?php echo $row["PHO"] ?> </td></tr>
							<tr><th>E - mail </th> <td> <?php echo $row["MAIL"] ?> </td></tr>
							<tr><th>Address </th> <td> <?php echo $row["ADDR"] ?> </td></tr>
						</table>
					</div>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>