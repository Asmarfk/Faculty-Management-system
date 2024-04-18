<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('lecturer_login.php?mes=Access Denied...','_self');</script>";
		
	}	
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title style="color: black;">Handled Class</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><br><hr><br>
				<div class="content">
				
					
					<div class="rbox1">
					<h3 style="color: black;"> My Classes</h3><br>
						<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
							<th>C.No</th>
							<th>CID</th>
							<th>Class Name</th>
							<th>Subject</th>
 						</tr>
						<?php
							$tid = $_SESSION["TID"];
							$s="SELECT * FROM sub JOIN class ON sub.SID = class.SID JOIN lecturer ON class.TID = lecturer.TID WHERE lecturer.TID = {$tid}";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo"
									<tr>
										<td>{$i}</td>
										<td>{$r["CID"]}</td>
										<td>{$r["CNAME"]}</td>
										<td>{$r["SNAME"]}</td>
									</tr>
									
									";
								}
							}
						
						
						
						?>
						
						</table>
					</div>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>