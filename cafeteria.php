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
		<title>Cafeteria</title>
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
					
						<h3 style="color: black;"> Cafeteria Revenue</h3><br>
						<?php
							if(isset($_POST["submit"]))
							{
								$sq="insert into cafe(ca_date,ca_inc,ca_exp) values ('{$_POST["date"]}','{$_POST["income"]}','{$_POST["expense"]}')";
								if($db->query($sq))
								{
									echo "<div class='success'>Insert Success..</div>";
								}
								else
								{
									echo "<div class='error'>Insert Failed..</div>";
								}
							}
						?>
						
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                        <label style="color: black;">Date</label><br>
						   <input type="Date" name="date" required class="input">
						   <br><br>
                        <label style="color: black;">Income Amount</label><br>
						   <input type="number" name="income" required class="input">
						   <br><br>
						   <label style="color: black;">Expenditure Amount</label><br>
						   <input type="number" name="expense" required class="input">
						   <button type="submit" class="btn" name="submit"> Add Cafeteria Details</button>
						</form>
				
				
					</div>
				
				
				<div class="tbox" >
					<h3 style="margin-top:30px; color: black;">Cafeteria Revenue</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
							<th>Date</th>
							<th>Income Amount</th>
							<th>Expenditure Amount</th>
							<th>Delete</th>
						</tr>
						<?php
							$s="select * from cafe";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
								
									echo "
										<tr>
										<td>{$r["ca_date"]}</td>
                                        <td>{$r["ca_inc"]}</td>
                                        <td>{$r["ca_exp"]}</td>
										<td><a href='cafeteria_delete.php?id={$r["caid"]}' class='btnr'>Delete</a></td>
										</tr>
									
									";
									
								}
								
							}
							else
							{
								echo "No Records Found";
							}
						?>
						
					</table>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>