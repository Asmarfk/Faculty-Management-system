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
		<title>Income Report</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
		
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!-- <img src="img/bg1.jpg" style="margin-left:90px;" class="sha"> -->
			<div id="section">
				<?php include"sidebar.php";?><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
                <div class="content1">
					
					<h3 style="color: black;">Reports Details</h3>

                    <button type="submit" class="btnre" name="submit" onclick="location.href='income_report.php'">Income Report</button><br><br>
                    <button type="submit" class="btnre" name="submit" onclick="location.href='class_report.php'">Class Schedule Report</button><br><br>
					 <button type="submit" class="btnre" name="submit" onclick="location.href='attendance_report.php'">Attendance Report</button><br><br>
                    
                </div>
				<div class="footer" style="margin-top:200px; margin-left:-100px; width:1800px;">
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