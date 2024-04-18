<?php
error_reporting(0);
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
		<title>Add Staff</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	
	<body>
			<?php include"navbar.php";?><br>
			<!-- <img src="img/bg1.jpg" style="margin-left:90px;" class="sha"> -->
			
			<div id="section">
				
				<?php include"sidebar.php";?><br><br><br>
				
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				<div class="content1">
					
						<h3 style="color: black;"> Add Staff Details</h3><br>
						
					<?php
						if(isset($_POST["submit"]))
						{
							$target="staff/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							
							if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file)){

								$NAPASS = 123;
								$enc_PASSWORD=md5($NAPASS);

								$sq="insert into staff(NANAME,NAPASS,NAQUAL,NASAL,NAPNO,NAMAIL,NAADDR,NAIMG,ROLE) values('{$_POST["NANAME"]}', '{$enc_PASSWORD}','{$_POST["NAQUAL"]}','{$_POST["NASAL"]}','{$_POST["NAPNO"]}','{$_POST["NAMAIL"]}','{$_POST["NAADDR"]}','{$target_file}', '{$_POST["srole"]}')";
								if($db->query($sq))
								{
									echo "<div class='success'>Insert Success..</div>";
								}
								else
								{
									echo "<div class='error'>Insert Failed..</div>";
								}
							} else {
								echo "<div class='error'>Insert Failed..</div>";
							}
							
						}
						
					?>
					<div class="content">
					<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
				
						<div class="lbox"> 	    
						
						 <label style="color: black;">Staff Name</label><br>
					     <input type="text" name="NANAME" required class="input">
					     <br><br>
						 
						 <label style="color: black;">Staff Role</label><br>
					     <select name="srole"  required class="input">
							<option value="">Select</option>
							<option value="hr">HR Staff</option>
							<option value="cafeteria">Cafeteria Staff</option>
							<option value="front_office">Front Office Clerk</option>
							<option value="finance">Finance Staff</option>

						</select><br><br>

					     <label style="color: black;">Qualification</label><br>
					     <input type="text" name="NAQUAL" required class="input">
					     <br><br>
					     <label style="color: black;">Salary</label><br>
					     <input type="text" name="NASAL" required class="input">
					     <br><br>
		
						</div>
						
						<div class="rbox"> 
						 
						 <label style="color: black;">Phone</label><br>
					     <input type="text" name="NAPNO" required class="input">
					     <br><br>
						 <label style="color: black;">Email</label><br>
					     <input type="text" name="NAMAIL" required class="input">
					     <br><br>
						 <label style="color: black;">Address</label><br>
					     <input type="text" name="NAADDR" required class="input">
					     <br><br>
						 <label style="color: black;">Staff Image</label><br>
							<input type="file"  class="input" required name="img">
					     <button type="submit" class="btn" name="submit">Add Staff</button>
					
						</div>
					</form>
				
				</div>
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>