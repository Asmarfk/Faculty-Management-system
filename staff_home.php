<?php
error_reporting(0);
	include"database.php";
	session_start();
	if(!isset($_SESSION["NAID"]))
	{
		echo"<script>window.open('staff_login.php?mes=Access Denied...','_self');</script>";
		
	}	
	
	
	$sql="SELECT * FROM staff WHERE NAID={$_SESSION["NAID"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Staff's Home</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["NANAME"]; ?></h3><br><hr><br>
				<div class="content">
				
					<h3 style="color: black;">Update Profile</h3><br>
					<div class="lbox1">
					<?php
						if(isset($_POST["submit"]))
						{
							$target="staff/";
							$target_file=$target.basename($_FILES["NAIMG"]["name"]);
							
							if ($_FILES["NAIMG"]["size"]>0) {
								if(move_uploaded_file($_FILES['NAIMG']['tmp_name'],$target_file))
								{
									$sql="update staff set NAPNO='{$_POST["NAPNO"]}',NAMAIL='{$_POST["NAMAIL"]}',NAADDR='{$_POST["NAADDR"]}',NAIMG='{$target_file}'where NAID={$_SESSION["NAID"]}";
									$db->query($sql);
									echo"<script>window.open('staff_home.php?image','_self');</script>";
								}
							} else {
								$sql="update staff set NAPNO='{$_POST["NAPNO"]}',NAMAIL='{$_POST["NAMAIL"]}',NAADDR='{$_POST["NAADDR"]}' where NAID={$_SESSION["NAID"]}";
								$db->query($sql);
								echo"<script>window.open('staff_home.php?success','_self');</script>";
							}
						}
					
					?>
					
					
					
					
						
					<form  enctype="multipart/form-data" role="form"  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
							<label style="color: black;">  Phone No</label><br>
							<input type="text" maxlength="10" required class="input3" name="NAPNO" value="<?php echo $row["NAPNO"] ?>"><br><br>
							<label style="color: black;">  E - mail</label><br>
							<input type="email"  class="input3" required name="NAMAIL" value="<?php echo $row["NAMAIL"] ?>"><br><br>
							<label style="color: black;">  Address</label><br>
							<textarea rows="5" name="NAADDR" ><?php echo $row["NAADDR"] ?></textarea><br><br>
							<label style="color: black;"> Image</label><br>
							<input type="file"  class="input3" name="NAIMG"><br><br>
						<button type="submit" class="btn" name="submit">Update Profile Details</button>
						</form>
					</div>
					
					
					
					
					<div class="rbox1">
					<h3 style="color: black;"> Profile</h3><br>
						<table border="1px">
							<tr><td colspan="2"><img src="<?php echo $row["NAIMG"] ?>" height="100" width="100" alt="upload Pending"></td></tr>
							<tr><th>Name </th> <td><?php echo $row["NANAME"] ?> </td></tr>
							<tr><th>Qualification </th> <td><?php echo $row["NAQUAL"] ?>  </td></tr>
							<tr><th>Salary </th> <td> <?php echo $row["NASAL"] ?>  </td></tr>
							<tr><th>Phone No </th> <td> <?php echo $row["NAPNO"] ?> </td></tr>
							<tr><th>E - mail </th> <td> <?php echo $row["NAMAIL"] ?> </td></tr>
							<tr><th>Address </th> <td> <?php echo $row["NAADDR"] ?> </td></tr>
						</table>
					</div>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>