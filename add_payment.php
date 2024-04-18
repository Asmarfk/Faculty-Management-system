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
		<title>Add Payment</title>
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
					
						<h3 style="color: black;"> Payment Details</h3><br>

						
						<form method="post" action="payment.php">
                        
						<label style="color: black;">Class</label><br>
						<select name="stu_class_sent" class="input2" required>
							<?php 
								$class_id = "";
								if(isset($_POST['stu_class_sent'])){
									$class_id = $_POST['stu_class_sent'];
								}

								$sql="SELECT * FROM class
								JOIN lecturer ON class.TID = lecturer.TID
								JOIN sub ON class.SID = sub.SID
								ORDER BY CID ASC";
								$re=$db->query($sql);
								if($re->num_rows>0)
								{
								echo"<option value=''>Select</option>";
								while($r=$re->fetch_assoc())
								{
								echo "<option value='{$r["CID"]}'>{$r["CID"]} - {$r["CNAME"]} {$r["SNAME"]} - {$r["TNAME"]}</option>";
								}
								}
							?>
						</select>
                           <br><br>
						   
						   <button type="submit" class="btn" name="class_val_sent">Make Payment</button>
						</form>
				
				
					</div>
				
				
			</div>


			<div class="tbox" >
					<h3 style="margin-top:30px; color: black;"> Payment Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					?>

					<?php
						if (isset($_GET["success"])) {
							echo "<div class='success'>Payment Success</div>";
						} elseif (isset($_GET["failed"])){
							echo "<div class='error'>Payment Failed</div>";
						}
               		 ?>
					<table border="1px" >
						<tr>
							<th>P.Id</th>
                            <th>Class</th>
							<th>Student RNO</th>
                            <th>Payment Date</th>
                            <th>Payment Time</th>
							<th>Month</th>
                            <th>Year</th>
							<th>Amount</th>
                            <th>Payment Method</th>
                            <th>Delete</th>
						</tr>
						<?php
							$s="select * from payment
							JOIN student ON payment.stu_id = student.ID";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
								
									echo "
										<tr>
                                        <td>{$r["pay_id"]}</td>
                                        <td>{$r["class_id"]}</td>
                                        <td>{$r["RNO"]}</td>
                                        <td>{$r["pay_date"]}</td>
                                        <td>{$r["pay_time"]}</td>
                                        <td>{$r["month"]}</td>
                                        <td>{$r["year"]}</td>
                                        <td>{$r["amount"]}</td>
                                        <td>{$r["pay_method"]}</td>
										<td><a href='payment_delete.php?id={$r["pay_id"]}'class='btnr'>Delete</a></td>
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
	
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>