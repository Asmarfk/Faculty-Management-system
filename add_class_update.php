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
		<title>Edit Class Detail</title>
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
				<div class="content1">
					
					<h3 style="color: black;"> Edit Class Details</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
							 $sq="UPDATE class SET CNAME = '{$_POST["cname"]}', SID = '{$_POST["subject"]}', TID = '{$_POST["lec"]}' WHERE CID = '{$_POST["cid"]})'";
							if($db->query($sq))
							{
								echo "<div class='success'>Insert Success..</div>";
							}
							else
							{
								echo "<div class='error'>Insert failed..</div>";
							}
						}
					?>
						

				<?php

					if(!isset($_GET['cid'])){
						echo "<script>window.open('add_class.php','_self');</script>";
					} else {
						$q="SELECT * FROM class WHERE CID =".$_GET['cid'];
						$res1=$db->query($q);
						if($res1->num_rows>0)
						{
							$i=0;
							while($r=$res1->fetch_assoc())
							{
								$i++;
								$cid = $_GET['cid'];
								$clname = $r["CNAME"];
								$sid = $r["SID"];
								$tid = $r["TID"];
								
							}	
						}
					}
					
					function addSelected ($dbval, $actval) {
						if ($dbval == $actval) {
							return "selected";
						}
					}

				?>

				
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label style="color: black;">Grade</label><br>
				<input type="text" name="cid" value="<?php echo $cid;?>" hidden>
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
									$selected = addSelected($tid, $r["TID"]);
									echo "<option value='{$r["TID"]}'".$selected.">{$r["TNAME"]}</option>";
									
								}
								
							}
						?>
					
				</select><br><br>

					<label style="color: black;">Subject </label><br>
				<select name="subject"  required class="input2" <?php $sid ?>>
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
									$selected = addSelected($sid, $r["SID"]);
									echo "<option value='{$r["SID"]}' ".$selected.">{$r["SNAME"]}</option>";
									
								}
								
							}
						?>
					
				</select>
					<br>
					<button type="submit" class="btn" name="submit">Modify Class Details</button>
				</form>
				
				
				</div>
				
				
				<div class="tbox">
					<h3 style="margin-top:30px; color: black;"> Class Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px">
						<tr>
							<th style="width:5%">S.No</th>
							<th style="width:25%">Class Name</th>
							<th style="width:25%">Lecturer Assigned</th>
							<th style="width:25%">Subject</th>
							<th style="width:10%">Update</th>
							<th style="width:10%">Delete</th>
						</tr>
						<?php
							$s="SELECT * FROM sub JOIN class ON sub.SID = class.SID JOIN lecturer ON class.TID = lecturer.TID ORDER BY `class`.`CID` DESC";
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
			</div>
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>