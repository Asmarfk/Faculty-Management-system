<?php
// error_reporting(0);
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
		<title>Add Class</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
		<?php include"navbar.php";?><br>
		<!-- <img src="img/bg1.jpg" style="margin-left:90px;" class="sha"> -->
			<div id="section">
				<?php include"sidebar.php";?><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				<div class="content">
					
					<h3 style="color: black;">Add Class Details</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
							 $sq="insert into class(CNAME,SID,TID,COMM_DATE,CLASS_DAY,CLASS_TIME) 
							 values('{$_POST["cname"]}','{$_POST["subject"]}','{$_POST["lec"]}','{$_POST["commdate"]}','{$_POST["classday"]}','{$_POST["classtime"]}')";
							if($db->query($sq))
							{
								echo "<script>window.open('add_class.php?success','_self');</script>";
							}
							else
							{
								echo "<script>window.open('add_class.php?failed','_self');</script>";
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
				
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">

				<table width="100%">
					<tr>
						<td width="50%" style="text-align:left;">
							<label style="color: black;">Faculties </label><br>
							<select name="cname"  required class="input2">
									<option value="">Select</option>
									<option value="Technology">Technology</option>
									<option value="Mangment Studies">Mangment Studies</option>
									<!-- <option value="Grade 8">Grade 8</option>
									<option value="Grade 9">Grade 9</option>
									<option value="Grade 10">Grade 10</option>
									<option value="Grade 11">Grade 11</option>
									<option value="Grade 12">Grade 12</option>
									<option value="Grade 13">Grade 13</option> -->
							</select><br><br>

							<label style="color: black;">Lecturer Assigned </label><br>
							<select name="lec"  required class="input2">
									<option value="">Select</option>
								<?php
										$s="SELECT * FROM lecturer";
										$res=$db->query($s);
										if($res->num_rows>0)
										{
											$i=0;
											while($r=$res->fetch_assoc())
											{
												$i++;
												echo "<option value='{$r["TID"]}'>{$r["TNAME"]}</option>";
												
											}
											
										}
									?>
								
							</select><br><br>

								<label style="color: black;">Subject </label><br>
									<select name="subject"  required class="input2">
										<option value="">Select</option>
											<?php
												$s="SELECT * FROM sub";
												$res=$db->query($s);
												if($res->num_rows>0)
												{
													$i=0;
													while($r=$res->fetch_assoc())
													{
														$i++;
														echo "<option value='{$r["SID"]}'>{$r["SNAME"]}</option>";
														
													}
													
												}
											?>
										
									</select>
								<br><br>
						</td>
						<td style="text-align:left;">
							<label style="color: black;">Commencement Date</label><br>
							<input type="date" class="input2" name="commdate"><br><br>
							
							<label style="color: black;">Class Day</label><br>
							<select name="classday"  required class="input2">
									<option value="">Select</option>
									<option value="Monday">Monday</option>
									<option value="Tuesday">Tuesday</option>
									<option value="Wednesday">Wednesday</option>
									<option value="Thursday">Thursday</option>
									<option value="Friday">Friday</option>
									<option value="Saturday">Saturday</option>
									<option value="Sunday">Sunday</option>

							</select><br><br>
							
							<label style="color: black;">Class Time</label><br>
							<input type="time" class="input2" name="classtime"><br><br>
						</td>
					</tr>
				</table>
					
					<button type="submit" class="btn" name="submit">Add Class</button>
				</form>
				
				
				</div>
				
				
				<div class="tbox">
				
				<h3 style="margin-top:30px; color: black; text-align:center;">Student's Class Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
							<th style="width:5%">S.No</th>
							<th style="width:15%">Class Name</th>
							<th style="width:15%">Lecturer Assigned</th>
							<th style="width:15%">Subject</th>
							<th style="width:15%">Subject Fee</th>
							<th style="width:15%">Student</th>
							<th style="width:10%">Update</th>
							<th style="width:10%">Delete</th>
						</tr>
						<?php
							$s="SELECT * FROM sub 
							JOIN class ON sub.SID = class.SID 
							JOIN lecturer ON class.TID = lecturer.TID 
							ORDER BY `class`.`CID` DESC";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
										<tr>
											<td>{$r["CID"]}</td>
											<td>{$r["CNAME"]}</td>
											<td>{$r["TNAME"]}</td>
											<td>{$r["SNAME"]}</td>
											<td>{$r["SFEE"]}</td>
											<td><a href='add_class_student.php?cid={$r["CID"]}' class='btnb'>Manage Students</a></td>
											<td><a href='add_class_update.php?cid={$r["CID"]}' class='btnr'>Update</a></td>
											<td><a href='delete.php?id={$r["CID"]}' class='btnr'>Delete</a></td>
										</tr>
										";
									
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