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
		<title>View Marks</title>
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
				
					<h3 style="color: black;">Mark Details</h3><br>
					<form  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<div class="lbox1">	
					
						<label style="color: black;">Enter Register No</label><br>
						<input type="text" class="input3" name="rno" placeholder="EX-:S000"><br><br>
				
					<button type="submit" class="btn" name="view"> View Marks Details</button>
				
					</form>
					<br><br>
					<div class="Output">
						<?php
							if(isset($_POST["view"]))
							{
								echo "<h3 style='color: black;'> Mark Details</h3><br>";
								$sql="select * from mark where REGNO='{$_POST["rno"]}'";
								$re=$db->query($sql);
								if($re->num_rows>0)
								{
									echo'
									<table border="1px">
										<tr>
											<th>S.No</th>
											<th>Reg.No</th>
											<th>Class</th>
											<th>Term</th>
											<th>Subject</th>
											<th>Mark</th>
										</tr>
									';
									$i=0;
									while($r=$re->fetch_assoc())
									{
										$i++;
										echo "
											<tr>
												<td>{$i}</td>
												<td>{$r["REGNO"]}</td>
												<td>{$r["CLASS"]}</td>
												<td>{$r["TERM"]}</td>
												<td>{$r["SUB"]}</td>
												<td>{$r["MARK"]}</td>
											</tr>
										
										
										
										
										";
									}
								}
								else
								{
									echo "No Record Found";
								}
								echo "</table>";
							}
						
						
						?>
					
					
					</div>
				</div>
			</div>
	

			
			<div class="footer" style="margin-top:190px; margin-left:-100px; width:1800px;">
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