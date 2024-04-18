<?php
error_reporting(0);
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
		<title>Add Student</title>
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
					
						<h3 style="color: black;"> Add Student Details</h3><br>
						<?php
							if(isset($_POST["submit"]))
							{
                                
								$sq="insert into student_class(stu_id, CID) values ('{$_POST["sname"]}', '{$_POST["cid"]}')";
								if($db->query($sq))
								{
                                    echo "<script>window.open('add_class_student.php?cid={$_POST["cid"]}&success=true','_self');</script>";
									
								}
								else
								{
                                    echo "<script>window.open('add_class_student.php?cid={$_POST["cid"]}&failed','_self');</script>";
									
								}
                            }
                            
                            if(isset($_GET["success"])){
                                echo "<div class='success'>Insert Success..</div>";
                            }

                            if(isset($_GET["failed"])){
                                echo "<div class='error'>Insert Failed..</div>";
                            }
						?>
                        
                        <?php
                            if(isset($_GET["delete"])){
                                $s="DELETE FROM student_class WHERE id = {$_GET[delete]}";
                                $db->query($s);
                                echo "<script>window.open('add_class_student.php?cid={$_GET["cid"]}','_self');</script>";
                            }
                        
                        ?>
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                           <label style="color: black;">Select Student</label><br>
                           <input type="text" name="cid" value="<?php echo $_GET['cid'];?>" hidden> 
                           <select type="text" name="sname" required class="input2">
                                    <option value="">Select</option>
                                    <?php
                                        $s="SELECT * FROM student";
                                        $res=$db->query($s);
                                        if($res->num_rows>0)
                                        {
                                            $i=0;
                                            while($r=$res->fetch_assoc())
                                            {
                                                $i++;
                                                echo "<option value='{$r["ID"]}'>{$r["RNO"]} - {$r["NAME"]}</option>";
                                                
                                            }
                                            
                                        }
                                    ?>
                                
                            </select><br><br>
						   <button type="submit" class="btn" name="submit">Add Student</button>
						</form>
				
				
					</div>
				
				
				<div class="tbox" >
					<h3 style="margin-top:30px; color: black;"> Class Students</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
							<th>R.No</th>
							<th>Student Name</th>
							<th>Delete</th>
						</tr>
						<?php
							$s="SELECT * FROM student JOIN student_class ON student.ID = student_class.stu_id WHERE CID = {$_GET['cid']}";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
									echo "
										<tr>
										<td>{$r["RNO"]} </td>
										<td>{$r["FNAME"]} {$r["NAME"]}</td>
										<td><a href='add_class_student.php?delete={$r["id"]}&cid={$_GET["cid"]}' class='btnr'>Delete</a></td>
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