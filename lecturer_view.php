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
	$sql="SELECT * FROM lecturer WHERE TID={$_GET["id"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lecturer View</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!-- <img src="img/t.jpg" style="margin-left:90px;" class="sha">-->
			<div id="section">
				<?php include"sidebar.php";?><br><br><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				<div class="content1">
					
						<h3 style="color: black;">View Lecturer Details</h3><br>
						<div class="ibox">
							<img src="<?php echo $row["IMG"]; ?>" height="230" width="230">
							
						</div>
						<div class="tsbox">
						<table border="1px">
						
							<tr><th>Name </th> <td> <?php echo $row["TNAME"]; ?></td></tr>
							<tr><th>Qualification </th> <td> <?php echo $row["QUAL"]; ?></td></tr>
							<tr><th>Role </th> <td> Lecturer</td></tr>
							<tr><th>Salary </th> <td> <?php echo $row["SAL"]; ?></td></tr>
							<tr><th>Phone No </th> <td> <?php echo $row["PNO"] ?></td></tr>
							<tr><th>E - Mail </th> <td> <?php echo $row["MAIL"]; ?></td></tr>
							<tr><th>Address </th> <td> <?php echo $row["PADDR"]; ?></td></tr>
							
						</table>
						</div>
				</div>	
			</div>
			<div class="footer" style="margin-top:200px; width:100%;">
			<footer><p>Copyright &copy; Thakshilawa Higher Education Institute </p></footer>
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
			
	</body>
</html>