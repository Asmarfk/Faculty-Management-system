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
		<title>Add Subjects</title>
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
					
						<h3 style="color: black;"> Income Report</h3><br>
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
						   <button type="submit" class="btn" name="submit"> Search Cafeteria Details</button>
						</form>
				
				
					</div>
				
				
				<div class="tbox" >
					<table>
						<tr>
							<th>Date</th>
							<th>Source</th>
							<th>Income</th>
							<th>Expenses</th>
							<th>Profit</th>
						</tr>
						
						<?php
							$s="SELECT DISTINCT(ca_date) FROM cafe";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								while($r=$res->fetch_assoc())
								{
									//While In While
									$sql="SELECT SUM(ca_inc) AS sum_ca_inc, 
									SUM(ca_exp) AS sum_ca_exp
									FROM cafe
									WHERE ca_date='{$r["ca_date"]}'";

									$res2=$db->query($sql);
									if($res2->num_rows>0)
									{
										while($r2=$res2->fetch_assoc())
										{
						?>

						<tr>
							<td><?php echo $r["ca_date"]?></td>
							<td>Cafeteria</td>
							<td><?php echo $r2["sum_ca_inc"]?></td>
							<td><?php echo $r2["sum_ca_exp"]?></td>
							<td><?php echo $r2["sum_ca_inc"] - $r2["sum_ca_exp"]?></td>
						</tr>

						<?php
										}
									}
								}
							}

							$sql_pay="SELECT DISTINCT(pay_date) FROM payment";
							$res_pay=$db->query($sql_pay);
							if($res_pay->num_rows>0)
							{
								while($r_pay=$res_pay->fetch_assoc())
								{
									//While In While
									$sql_pay2="SELECT SUM(amount) AS sum_class_inc
									FROM payment
									WHERE pay_date='{$r_pay["pay_date"]}'";

									$res_pay2=$db->query($sql_pay2);
									if($res_pay2->num_rows>0)
									{
										while($r_pay2=$res_pay2->fetch_assoc())
										{
									
						?>
						<tr>
							<td><?php echo $r_pay["pay_date"]; ?></td>
							<td>Class Fees</td>
							<td><?php echo $r_pay2["sum_class_inc"]; ?></td>
							<td><?php echo 0; ?></td>
							<td><?php echo $r_pay2["sum_class_inc"] - 0; ?></td>
						</tr>
						<?php
										}
									}
								}
							}

						?>
					</table>
				</div>
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>