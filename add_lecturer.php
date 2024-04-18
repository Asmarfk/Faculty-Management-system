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
		<title>Add Lecturer</title>
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
					
						<h3 style="color: black;">Add Lecturer Details</h3>
						
					<?php
						if(isset($_POST["submit"]))
						{
							$target="lecturer/";
							$target_file=$target.basename($_FILES["img"]["name"]);
							
							if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file)){

								$TPASS = 123;
								$enc_PASSWORD=md5($TPASS);

								$sq="insert into lecturer(TNAME,TPASS,QUAL,SAL,PNO,MAIL,PADDR,IMG) values('{$_POST["sname"]}',md5($TPASS),'{$_POST["qual"]}','{$_POST["sal"]}','{$_POST["pno"]}','{$_POST["mail"]}','{$_POST["addr"]}','{$target_file}')";
								if($db->query($sq))
								{
									echo "<div class='success'>Insert Success..</div>";
								}
								else
								{
									echo "<div class='error'>Insert Failed..</div>";
								}
							}else {
								echo "<div class='error'>Insert Failed ing..</div>";
							}
							
							
						}
						
					?>
					<div class="content">
					<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
						
						<div class="lbox">  
					  
					     <label style="color: black;">Lecturer Name</label><br>
					     <input type="text" name="sname" required class="input">
					     <br><br>
					     <label style="color: black;">Qualification</label><br>
					     <input type="text" name="qual" required class="input">
					     <br><br>
					     <label style="color: black;">Salary</label><br>
					     <input type="text" name="sal" required class="input">
						
						 <br><br>
						 <label style="color: black;">Lecturer's Image</label><br>
						 <input type="file"  class="input3" required name="img">

						 </div>
			 			
						 <div class="rbox">   
					   
						 <label style="color: black;">Phone</label><br>
					     <input type="tel" name="pno" required class="input" 
						 pattern="[0-9]{10}">
					     <br><br>
						 <label style="color: black;">Email</label><br>
					     <input type="text" name="mail" required class="input">
					     <br><br>
						 <label style="color: black;">Address</label><br>
					     <input type="text" name="addr" required class="input">
						
						<button type="submit" class="btn" name="submit">Add Lecturer</button>
						 
						</div>
				
					</form>
				
					</div>
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>