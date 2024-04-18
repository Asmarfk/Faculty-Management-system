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
	
	$sql="SELECT * FROM staff WHERE NAID={$_GET["id"]}";
		$res=$db->query($sql);

		if($res->num_rows>0)
		{
			$row=$res->fetch_assoc();
		}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Staff View</title>
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
					
						<h3 style="color: black;"> View Staff Details</h3><br>
						<div class="ibox">
							<img src="<?php echo $row["NAIMG"]; ?>" height="230" width="230">
							
						</div>
						<div class="tsbox">
						<table border="1px">
						
							<tr><th>Name </th> <td> <?php echo $row["NANAME"]; ?></td></tr>
							<tr><th>Qualification </th> <td> <?php echo $row["NAQUAL"]; ?></td></tr>
							<tr><th>Salary </th> <td> <?php echo $row["NASAL"]; ?></td></tr>
							<tr><th>Phone No </th> <td> <?php echo $row["NAPNO"]; ?></td></tr>
							<tr><th>E - Mail </th> <td> <?php echo $row["NAMAIL"]; ?></td></tr>
							<tr><th>Address </th> <td> <?php echo $row["NAADDR"]; ?></td></tr>
							<?php
								$role ="";
								if($row["ROLE"] == "hr"){
									$role = "Human Resource";
								} elseif ($row["ROLE"] == "front_office") {
									$role = "Front Office";
								} elseif ($row["ROLE"] == "cafeteria") {
									$role = "Cafeteria";
								} elseif ($row["ROLE"] == "finance") {
									$role = "Finance";
								}
							?>
							<tr><th>Role </th> <td> <?php echo $role; ?></td></tr>
							
						</table>
						</div>
				</div>	
			</div>
			<?php include"footer.php";?>
			
	</body>
</html>