<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["TID"]))
	{
		echo"<script>window.open('lecturer_login.php?mes=Access Denied...','_self');</script>";
		
	}	
	
	if(isset($_GET["rno"]))
	{
		$sql="select * from student where RNO='{$_GET["rno"]}'";
		$res=$db->query($sql);
		if($res->num_rows<=0)
		{
			header("location:add_mark.php?err=Invalid Register no..");
		}
		else
		{
			$rows=$res->fetch_assoc();
			$regno=$_GET["rno"];
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Thakshilawa Higher Educational Institute</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
	
			<div id="section">
				<?php include"sidebar.php";?><br>
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["TNAME"]; ?></h3><br><hr><br>
				<div class="content">
					
					<h3 style="color: black;">Add Marks</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
							$sq="insert into mark(REGNO,SUB,MARK,TERM,CLASS) values ('{$_POST["regno"]}','{$_POST["sub"]}','{$_POST["mark"]}','{$_POST["etype"]}','{$_POST["stu_class"]}')";
							if($db->query($sq))
							{
								echo "<div class='success'>Insert Success</div>";
							}
							else
							{
								echo "<div class='error'>Insert Failed</div>";
							}
							
						}
					
					
					
					?>
					
					<form method="post" action="<?php echo $_SERVER["REQUEST_URI"];?>">
						<div class="lbox">
							<label style="color: black;"> Register No </label><br>
							<input type="text" value="<?php echo $regno;?>" class="input3" name="regno" readonly><br><br>

							<label style="color: black;">Faculties</label><br>
							<select name="stu_class" class="input3" name="class">
								<?php 
									$sql="SELECT * FROM class
									JOIN lecturer ON class.TID = lecturer.TID
									JOIN sub ON class.SID = sub.SID
									JOIN student_class ON class.CID = student_class.CID
									JOIN student ON student_class.stu_id = student.ID
									WHERE student.RNO = '{$regno}'
									ORDER BY student_class.CID ASC";
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
							<label style="color: black;"> Select Term</label><br>
							<select name="etype" required class="input3">
								<option value="">Select</option>
								<option value="1st Semester">1st Semester</option>
						       <option value="2nd Semester">2nd Semester</option>
						       <option value="3rd Semester">3rd Semester</option>
							</select>
							<br><br>
						</div>
						<div class="rbox">
							
						<label style="color: black;">Subject</label><br>
							<select name="sub" required class="input3">
						
								<?php 
									 $s="SELECT *  FROM sub";
									$re=$db->query($s);
										if($re->num_rows>0)
											{
												echo"<option value=''>Select</option>";
												while($r=$re->fetch_assoc())
												{
													echo "<option value='{$r["SNAME"]}'>{$r["SNAME"]}</option>";
												}
											}
								?>
							</select>
							<br><br>
							<label style="color: black;">Mark:</label><br>
							<input class="input3" name="mark"  id="mark" type="mark" required>
							<br><br>
							<button type="submit"  class="btn" name="submit">Add Marks Details</button>
					</form>							
						</div>
						
				</div>
				
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>