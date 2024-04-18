<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
		
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Student Management System</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
			<?php include"navbar.php";?><br>
			
			<!-- <img src="img/2.jpg" style="margin-left:90px; height: 300px; width: 1200px;" class="sha"> -->
			
				<div id="section">
				
					<?php include"sidebar.php";?><br><br><br>
					
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
					
				<div class="content1">
					
						<h3 style="color: black;"> Change Password</h3><br>
						<?php
							if(isset($_POST["submit"]))
							{
								$enc_OLD_PASSWORD=md5($_POST["opass"]);
								$enc_NEW_PASSWORD=md5($_POST["npass"]);

								$sql="select * from admin where APASS='{$enc_OLD_PASSWORD}' and AID='{$_SESSION["AID"]}'";
								$result=$db->query($sql);
								if($result->num_rows>0)
								{
									if($_POST["npass"]==$_POST["cpass"])
									{
										$s="update admin SET APASS='{$enc_NEW_PASSWORD}' where AID='{$_SESSION["AID"]}'";
										$db->query($s);
										echo "<div class='success'>Password Changed</div>";
									}
									else
									{
										echo "<div class='error'>Password Mismatch</div>";
									}
								}
								else
								{
									echo "<div class='error'>Invalid Password</div>";
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
			<?php include"footer.php";?>
		
	</body>
</html>