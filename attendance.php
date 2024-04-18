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
					
						<h3 style="color: black;"> Attendance Details</h3><br>
						
			<?php
			if(isset($_POST["submit"]))
			{
				$sq="insert into attendance(DATE,CLASS,STUDENT_ID,PAR) values('{$_POST["date"]}','{$_POST["stu_class"]}','{$_POST["stuno"]}','{$_POST["par"]}')";
				echo $sq;
				if($db->query($sq))
				{
					echo "<script>window.open('attendance.php?stu_class={$_POST["stu_class"]}&attendance&success','_self');</script>";   
				}
				else
				{
					echo "<script>window.open('attendance.php?stu_class={$_POST["stu_class"]}&attendance&success','_self');</script>";   
				}	
			}
			
		?> 

				<?php
                    if (isset($_GET["success"])) {
                        echo "<div class='success'>Insert Success</div>";
                    } elseif (isset($_GET["failed"])){
                        echo "<div class='error'>Insert Failed</div>";
                    }
                ?>
			<div class="lbox">

					 <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					 <label style="color: black;">Class</label><br>
						 <select name="stu_class" class="input2" readonly>
							<?php
								$stu_class = "";
								if(isset($_GET['attendance']) && isset($_GET['stu_class'])){
									$stu_class = $_GET['stu_class'];
								}
							
								$sql="SELECT * FROM class
								JOIN lecturer ON class.TID = lecturer.TID
								JOIN sub ON class.SID = sub.SID
								WHERE CID = '{$stu_class}'";
								$re=$db->query($sql);
								if($re->num_rows>0)
								{
								while($r=$re->fetch_assoc())
								{
								echo "<option value='{$r["CID"]}'>{$r["CID"]} - {$r["CNAME"]} {$r["SNAME"]} - {$r["TNAME"]}</option>";
								}
								}
							?>
						 </select>
						 <input type="text" name="stu_class" value='<?php echo $_GET['stu_class'];?>' hidden>
						 <br><br>

					 <label style="color: black;" value="">Date</label><br>
					 <input type="date" class="input2" name="date" required>
						
					<br><br>
						
				
						</div>
						 <div class="rbox">	

						<label style="color: black;">Student ID</label><br>
						 <select name="stuno" class="input2" required>
							<?php 
								if(isset($_GET['attendance']) && isset($_GET['stu_class'])){
									$sql="SELECT * FROM `student_class`
									JOIN student ON student_class.stu_id = student.ID
									WHERE CID={$_GET['stu_class']}";
								} else {
									$sql="";
								}
								$re=$db->query($sql);
								if($re->num_rows>0)
								{
								echo"<option value=''>Select</option>";
								while($r=$re->fetch_assoc())
								{
								echo "<option value='{$r["stu_id"]}'>{$r["RNO"]} - {$r["NAME"]} {$r["FNAME"]}</option>";
								}
								}
							?>
						 </select><br><br>		

						 
                        <label style="color: black;">Participation</label><br>
					     	<select name="par"  required class="input2">
								<option value="">Select</option>
								<option value="Present">Present</option>
								<option value="Absence">Absence</option>
							</select><br><br> 
							
					</div>
				</div>
						
						 <button type="submit" class="btn" name="submit">Add Attendance</button>
					
					</form>
				</div>	
			</div>
            
			<div class="footer" style="margin-top:120px; width:100%;">
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
			<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
				
	</body>
</html>