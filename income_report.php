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
		<link rel="stylesheet" type="text/css" href="css/style_reports.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
		<link
		rel="stylesheet"
		type="text/css"
		href="DataTables/jquery.dataTables.min.css"
		/>
		<link
		rel="stylesheet"
		type="text/css"
		href="DataTables/buttons.dataTables.min.css"
		/>
	</head>
	<body>
				<?php include"navbar.php";?><br>
				<!-- <img src="img/bg1.jpg" style="margin-left:90px;" class="sha"> -->
				
			<div id="section">
					<?php include"sidebar.php";?><br><br><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
					<div class="content">
					
						<h3 style="color: black;">Income Report</h3><br>


						<form method="get" action="<?php echo $_SERVER["PHP_SELF"];?>">
						<table style="width: 100%">
							<tr>
								<td>
									<label style="color: black;">From Date</label><br>
									
									<input type="Date" id="min" name="fromdate" required class="input2" value="<?php if(isset($_GET['fromdate'])){echo $_GET['fromdate'];} ?>">
								</td>
								<td>
									<label style="color: black;">To Date</label><br>
						   			<input type="Date" id="max" name="todate" required class="input2" value="<?php if(isset($_GET['todate'])){echo $_GET['todate'];} ?>">
								</td>
							</tr>
						</table>
        
						   <button type="submit" class="btn" name="submit">Search Cafeteria Details</button>
						   <button type="button" class="btn" onclick="location.href='income_report.php'">Show All</button>
						</form>
					
					<br>
					<br>
					<br>
					<br>
				
					
					<table id="example" class="display nowrap" style="width: 100%">
            
						<thead>
							<tr>
								<th>Date</th>
								<th>Source</th>
								<th>Income</th>
								<th>Expenses</th>
								<th>Profit</th>
							</tr>
						</thead>
  
						<tbody>
			  
						  <?php
						  	if(isset($_GET['fromdate']) && isset($_GET['todate'])){
								$s="SELECT DISTINCT(ca_date) FROM cafe WHERE ca_date BETWEEN '{$_GET["fromdate"]}' AND '{$_GET["todate"]}'";
							} else {
								$s="SELECT DISTINCT(ca_date) FROM cafe";
							}
							  
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
							  
							  if(isset($_GET['fromdate']) && isset($_GET['todate'])){
								$sql_pay="SELECT DISTINCT(pay_date) FROM payment WHERE pay_date BETWEEN '{$_GET["fromdate"]}' AND '{$_GET["todate"]}'";
							  } else {
								$sql_pay="SELECT DISTINCT(pay_date) FROM payment";
							  }

							  
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
						</tbody>
				  </table>
				</div>
			</div>
	
			<script src="DataTables/jquery-3.5.1.js"></script>
			<script src="DataTables/jquery.dataTables.min.js"></script>
			<script src="DataTables/dataTables.buttons.min.js"></script>
			<script src="DataTables/buttons.flash.min.js"></script>
			<script src="DataTables/jszip.min.js"></script>
			<script src="DataTables/pdfmake.min.js"></script>
			<script src="DataTables/vfs_fonts.js"></script>
			<script src="DataTables/buttons.html5.min.js"></script>
			<script src="DataTables/buttons.print.min.js"></script>
			<!-- <script src="DataTables/date_range.js"></script> -->

			<script>
			$(document).ready(function () {
				$("#example").DataTable({
				// bFilter: false,
				dom: "Bfrtip",
				buttons: ["copy", "csv", "excel", "pdf", "print"],
				});
			});
			</script>
			
			<div class="footer" style="margin-top:50px;">
				<footer><p>Copyright &copy; Rajarata University of Sri Lanka. All Rights Reserved. </p></footer>
			</div>
							 
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>