<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('lecturer_login.php?mes=Access Denied...','_self');</script>";
	}	
	
	
	$sql="SELECT * FROM lecturer WHERE TID={$_SESSION["TID"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lecturer's Home</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text"style="color: black;">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><br><hr><br>
				<div class="content">
				
					<h3 style="color: black;">Update Profile</h3><br>
					<div class="lbox1">
					<?php
						if(isset($_POST["submit"]))
						{
							$target="staff/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							
							
							if ($_FILES["img"]["size"]>0) {
								if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
								{
									$sql="update lecturer set PNO='{$_POST["pno"]}',MAIL='{$_POST["mail"]}',PADDR='{$_POST["addr"]}',IMG='{$target_file}'where TID={$_SESSION["TID"]}";
									$db->query($sql);
									echo"<script>window.open('lecturer_home.php?success','_self');</script>";
								}
							} else {
								$sql="update lecturer set PNO='{$_POST["pno"]}',MAIL='{$_POST["mail"]}',PADDR='{$_POST["addr"]}' where TID={$_SESSION["TID"]}";
								$db->query($sql);
								echo"<script>window.open('lecturer_home.php?success','_self');</script>";
							}
							
						}
						
						if (isset($_GET['success'])){
							echo "<div class='success'>Update Success</div>";
						}
					
					?>
					
					
						
					<form  enctype="multipart/form-data" role="form"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<label style="color: black;">  Phone No</label><br>
							<input type="text" maxlength="10" required class="input3" name="pno" value="<?php echo $row["PNO"] ?>"><br><br>
							<label style="color: black;">  E - Mail</label><br>
							<input type="email"  class="input3" required name="mail" value="<?php echo $row["MAIL"] ?>"><br><br>
							<label style="color: black;" >  Address</label><br>
							<textarea rows="5" name="addr"><?php echo $row["PADDR"] ?></textarea><br><br>
							<label style="color: black;"> Image</label><br>
							<input type="file"  class="input3" name="img"><br><br>
						<button type="submit" class="btn" name="submit">Update Profile Details</button>
						</form>
					</div>
					
					
					
					
					<div class="rbox1">
					<h3 style="color: black;"> Profile</h3><br>
						<table border="1px">
							<tr><td colspan="2"><img src="<?php echo $row["IMG"] ?>" height="100" width="100" alt="upload Pending"></td></tr>
							<tr><th>Name </th> <td><?php echo $row["TNAME"] ?> </td></tr>
							<tr><th>Qualification </th> <td><?php echo $row["QUAL"] ?>  </td></tr>
							<tr><th>Salary </th> <td> <?php echo $row["SAL"] ?>  </td></tr>
							<tr><th>Phone No </th> <td> <?php echo $row["PNO"] ?> </td></tr>
							<tr><th>E - Mail </th> <td> <?php echo $row["MAIL"] ?> </td></tr>
							<tr><th>Address </th> <td> <?php echo $row["PADDR"] ?> </td></tr>
						</table>
					</div>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>