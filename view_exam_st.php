<?php
	include"database.php";
	session_start();
	if (isset($_SESSION["ID"])){
		$logged_user = $_SESSION["NAME"];
	} elseif (isset($_SESSION["NID"])) {
		$logged_user = $_SESSION["NNAME"];
	} else {
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Exam</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
			<?php include"navbar.php";?><br>
			
			<!--img src="img/bg1.jpg" style="margin-left:90px;" class="sha"-->
			
			<div id="section">
				
					<?php include"sidebar.php";?><br><br><br>
					
					<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
					
				<div class="content">
					
						<h3 style="color: black;">View Exam Time Table Details</h3><br>
						
						<?php
							if(isset($_GET["mes"]))
								{
									echo"<div class='error'>{$_GET["mes"]}</div>";	
								}
					
						?>
						
						<table border="1px">
							<tr>
								<th>S.No</th>
								<th>Class </th>
								<th>Subject</th>
								<th>Exam Name</th>
								<th>Term</th>
								<th>Date</th>
								<th>Session</th>
								<th>Update</th>
								<th>Delete</th>
								
							</tr>
							<?php
								$s="select * from exam";
								$res=$db->query($s);
								if($res->num_rows>0)
								{
									$i=0;
									while($r=$res->fetch_assoc())
									{
										$i++;
										echo "
											<tr>
												<td>{$i}</td>
												<td>{$r["CLASS"]}</td>
												<td>{$r["SUB"]}</td>
												<td>{$r["ENAME"]}</td>
												<td>{$r["ETYPE"]}</td>
												<td>{$r["EDATE"]}</td>
												<td>{$r["SESSION"]}</td>
												<td><a href='exam_update.php?id={$r["EID"]}' class='btnr'>Update</a></td>
												<td><a href='exam_delete.php?id={$r["EID"]}' class='btnr'>Delete</a></td>
											</tr>
										
										
										
										";
										
									}
								}
								else
								{
									echo "No Record Found";
								}
							
							
							
							?>
						
						
						
						
						
						
						
						
						
						</table>
				
				</div>
				
				
			</div>
	
			<div class="footer" style="margin-top:200px; margin-left:-100px; width:1800px;">
				<footer><p>Copyright &copy; Rajarata University of Sri Lanka. All Rights Reserved. </p></footer>
			</div>

			<br><br>
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