<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["ID"]))
	{
		echo"<script>window.open('student_home.php?mes=Access Denied...','_self');</script>";
		
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
		<title>Students' Change Password</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["NAME"]; ?></h3><br><hr><br>
				<div class="content">
				
					<h3 style="color: black;">Change Password</h3><br>
			
					 
				
					<div class="lbox1">	
							<?php
						if(isset($_POST["submit"]))
						{
							$enc_OLD_PASSWORD=md5($_POST["opass"]);
							$enc_NEW_PASSWORD=md5($_POST["npass"]);

							$sql="select * from student where PASS='{$enc_OLD_PASSWORD}' and ID='{$_SESSION["ID"]}'";
							$result=$db->query($sql);
								if($result->num_rows>0)
								{
									if($_POST["npass"]==$_POST["cpass"])
									{
										$sql="UPDATE student SET  PASS='$enc_NEW_PASSWORD' where  ID='{$_SESSION["ID"]}'";
										$db->query($sql);
										echo"<div class='success'>Password Changed</div>";
									}
									else
									{
										echo"<div class='error'>Password is Mismatch</div>";
									}
								}
								else
								{
									echo"<div class='error'>Invalid Password</div>";
								}
						}
					
					
					
					?>
					<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<label style="color: black;">Old Password</label><br>
						<input type="text" class="input3" name="opass"><br><br>
						<label style="color: black;">New Password</label><br>
						<input type="text" class="input3" name="npass"><br><br>
						<label style="color: black;">Confirm Password</label><br>
						<input type="text" class="input3" name="cpass"><br><br>
						<button type="submit" class="btn" style="float:left" name="submit"> Change Password</button>
				
					</form>
			
					</div>
			
					
				</div>
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>