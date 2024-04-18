<?php
error_reporting(0);
	include"database.php";
	session_start();
	if (isset($_SESSION["AID"])){
		$logged_user = $_SESSION["ANAME"];
	} elseif (isset($_SESSION["TID"])) {
		$logged_user = $_SESSION["TNAME"];
	} else {
		echo"<script>window.open('index.php?mes=Access Denied...','_self');</script>";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Attendance</title>
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
				<div class="content">
					
						<h3 style="color: black;">Attendance Details</h3><br>
						
			<?php
			if(isset($_POST["submit"]))
			{
				$sq="insert into attendance(DATE,CLASS,STUDENT_ID,PAR) values('{$_POST["date"]}','{$_POST["stu_class"]}','{$_POST["stuno"]}','{$_POST["par"]}')";
				if($db->query($sq))
				{
					echo "<script>window.open('add_attendance.php?success','_self');</script>";   
				}
				else
				{
					echo "<script>window.open('add_attendance.php?failed','_self');</script>";  
				}	
			}
			
		?> 
			<div class="lbox">
				<?php
                    if (isset($_GET["success"])) {
                        echo "<div class='success'>Insert Success</div>";
                    } elseif (isset($_GET["failed"])){
                        echo "<div class='error'>Insert Failed</div>";
                    }
                ?>

				<form method="get" action="attendance.php">					     
						
						<label style="color: black;">Class</label><br>
						<select name="stu_class" class="input2" required>
							<?php 
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
						

					</div>
				</div>
						
						 <button type="submit" class="btn" name="attendance">Add Attendance</button>
					
					</form>
				</div>	
			</div>
            
			<?php include"footer.php";?>
			<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
				
	</body>
</html>