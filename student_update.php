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
	</head>
	<body>
		<?php include"navbar.php";?><br>
		
			<div id="section">
				<?php include"sidebar.php";?><br><br><br>
				<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				<div class="content">
					
						<h3 style="color: black;">Update Student's Details</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
                            $edate=$_POST["da"].'-'.$_POST["mo"].'-'.$_POST["ye"];
							$target="student/";
                            if ($_FILES["img"]["size"]>0) { 
                                $target_file=$target.basename($_FILES["img"]["name"]);
                                if(move_uploaded_file($_FILES['img']['tmp_name'],$target_file))
                                {
                                    $sq="UPDATE `student` SET `NAME`='{$_POST["name"]}',`FNAME`='{$_POST["fname"]}',`DOB`='{$edate}',`GEN`='{$_POST["gen"]}',`PHO`='{$_POST["pho"]}',`MAIL`='{$_POST["email"]}',`ADDR`='{$_POST["addr"]}',`SIMG`='{$target_file}' WHERE ID = '{$_POST["stuid"]}'";
                                    
                                    if($db->query($sq))
                                    {
                                        echo "<script>window.open('student.php?success','_self');</script>"; 
                                    }
                                    else
                                    {
                                        echo "<script>window.open('student.php?failed','_self');</script>"; 
                                    }
                                }
                            } else {
                                $sq="UPDATE `student` SET `NAME`='{$_POST["name"]}',`FNAME`='{$_POST["fname"]}',`DOB`='{$edate}',`GEN`='{$_POST["gen"]}',`PHO`='{$_POST["pho"]}',`MAIL`='{$_POST["email"]}',`ADDR`='{$_POST["addr"]}' WHERE ID = '{$_POST["stuid"]}'";
                                // echo $sq;
                                // exit();
                                if($db->query($sq))
                                {
                                    echo "<script>window.open('student.php?success&mes=Update Success','_self');</script>"; 
                                }
                                else
                                {
                                    echo "<script>window.open('student.php?failed&mes=Update Failed','_self');</script>"; 
                                }
                            }

                            
							
							
						}

					?>
			
				<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
				<div class="lbox">
                        <?php
                            if (isset($_GET["success"])) {
                                echo "<div class='success'>Insert Success</div>";
                            } elseif (isset($_GET["failed"])){
                                echo "<div class='error'>Insert Failed</div>";
                            }
                        ?>

						<?php
                            if(isset($_GET['stuid'])){
                                $stuid=$_GET['stuid'];
                            } else {
                                echo"<script>window.open('student.php','_self');</script>";
                            }

							
							$sql="SELECT * FROM student WHERE ID = '{$stuid}'";
							$res=$db->query($sql);
							if($res->num_rows>0)
							{
								$row1=$res->fetch_assoc();
								$rno = $row1['RNO'];
								$sname = $row1['NAME'];
								$fname = $row1['FNAME'];
                                $dob = $row1['DOB'];
                                $pno = $row1['PHO'];
                                $day = explode("-",$dob)[0];
                                $month = explode("-",$dob)[1];
                                $year = explode("-",$dob)[2];
								$gender = $row1['GEN'];
								$email = $row1['MAIL'];
								$addr = $row1['ADDR'];
                                $rno = $row1['RNO'];
                                
                                function addSelected ($dbval, $actval) {
                                    if ($dbval == $actval) {
                                        return "selected";
                                    }
                                }
							}						
						?>
                    <input type="text" name="stuid" value="<?php echo $stuid; ?>" hidden>
					<label style="color: black;"> ID</label><br>
					<input type="text" class="input3" name="rno" value="<?php echo $rno;?>" readonly  ><br><br>
					<label style="color: black;"> Student Name</label><br>
					<input type="text" class="input3" name="name" value="<?php echo $sname;?>"><br><br>
					<label style="color: black;"> Father's Name</label><br>
					<input type="text" class="input3" name="fname" value="<?php echo $fname;?>"><br><br>
				
						
					<label style="color: black;">  Date of Birth</label><br>
					<select name="da" class="input5">
						<option value="">Date</option>
						<option value="1" <?php echo addSelected($day, "1") ?>>1 </option>
						<option value="2" <?php echo addSelected($day, "2") ?>>2 </option>
						<option value="3" <?php echo addSelected($day, "3") ?>>3 </option>
						<option value="4" <?php echo addSelected($day, "4") ?>>4 </option>
						<option value="5" <?php echo addSelected($day, "5") ?>>5 </option>
						<option value="6" <?php echo addSelected($day, "6") ?>>6 </option>
						<option value="7" <?php echo addSelected($day, "7") ?>>7 </option>
						<option value="8" <?php echo addSelected($day, "8") ?>>8 </option>
						<option value="9"<?php echo addSelected($day, "9") ?> >9 </option>
						<option value="10"<?php echo addSelected($day, "10") ?> >10</option>
						<option value="11"<?php echo addSelected($day, "11") ?> >11</option>
						<option value="12"<?php echo addSelected($day, "12") ?> >12</option>
						<option value="13" <?php echo addSelected($day, "13") ?>>13</option>
						<option value="14"<?php echo addSelected($day, "14") ?>>14</option>
						<option value="15"<?php echo addSelected($day, "15") ?>>15</option>
						<option value="16" <?php echo addSelected($day, "16") ?>>16</option>
						<option value="17" <?php echo addSelected($day, "17") ?> >17</option>
						<option value="18" <?php echo addSelected($day, "18") ?>>18</option>
						<option value="19" <?php echo addSelected($day, "19") ?> > 19</option>
						<option value="20"<?php echo addSelected($day, "20") ?>>20</option>
						<option value="21" <?php echo addSelected($day, "21") ?>>21</option>
						<option value="22" <?php echo addSelected($day, "22") ?>>22</option>
						<option value="23" <?php echo addSelected($day, "23") ?>>23</option>
						<option value="24" <?php echo addSelected($day, "24") ?>>24</option>
						<option value="25" <?php echo addSelected($day, "25") ?>>25</option>
						<option value="26" <?php echo addSelected($day, "26") ?>>26</option>
						<option value="27"<?php echo addSelected($day, "27") ?> >27</option>
						<option value="28"<?php echo addSelected($day, "28") ?> >28</option>
						<option value="29" <?php echo addSelected($day, "29") ?>>29</option>
						<option value="30" <?php echo addSelected($day, "30") ?>>30</option>
						<option value="31" <?php echo addSelected($day, "31") ?>>31</option>
					</select>
					<select name="mo" class="input5">
						<option> Month</option>
						<option value="01" <?php echo addSelected($month, "01") ?>>Jan</option>
						<option value="02" <?php echo addSelected($month, "02") ?>>Feb</option>
						<option value="03" <?php echo addSelected($month, "03") ?>>Mar</option>
						<option value="04" <?php echo addSelected($month, "04") ?>>Apr</option>
						<option value="05" <?php echo addSelected($month, "05") ?>>May</option>
						<option value="06" <?php echo addSelected($month, "06") ?>>Jun</option>
						<option value="07" <?php echo addSelected($month, "07") ?>>Jul</option>
						<option value="08" <?php echo addSelected($month, "08") ?>>Aug</option>
						<option value="09" <?php echo addSelected($month, "09") ?>>Sep</option>
						<option value="10" <?php echo addSelected($month, "10") ?>>Oct</option>
						<option value="11" <?php echo addSelected($month, "11") ?>>Nov</option>
						<option value="12" <?php echo addSelected($month, "12") ?>>Dec</option>
					</select>
					<select name="ye" class="input5">
						<option value="">Select Year</option>
						<option value="2025" <?php echo addSelected($year, "2025") ?>>2025</option>
						<option value="2024" <?php echo addSelected($year, "2024") ?>>2024</option>
						<option value="2023" <?php echo addSelected($year, "2023") ?>>2023</option>
						<option value="2022" <?php echo addSelected($year, "2022") ?>>2022</option>
						<option value="2021" <?php echo addSelected($year, "2021") ?>>2021</option>
						<option value="2020" <?php echo addSelected($year, "2020") ?>>2020</option>
						<option value="2019" <?php echo addSelected($year, "2019") ?>>2019</option>
						<option value="2018" <?php echo addSelected($year, "2018") ?>>2018</option>
						<option value="2017" <?php echo addSelected($year, "2017") ?>>2017</option>
						<option value="2016" <?php echo addSelected($year, "2016") ?>>2016</option>
						<option value="2015" <?php echo addSelected($year, "2015") ?>>2015</option>
						<option value="2014" <?php echo addSelected($year, "2014") ?>>2014</option>
						<option value="2013" <?php echo addSelected($year, "2013") ?>>2013</option>
						<option value="2012" <?php echo addSelected($year, "2012") ?>>2012</option>
						<option value="2011" <?php echo addSelected($year, "2011") ?>>2011</option>
						<option value="2010" <?php echo addSelected($year, "2010") ?>>2010</option>
						<option value="2009" <?php echo addSelected($year, "2009") ?>>2009</option>
						<option value="2008" <?php echo addSelected($year, "2008") ?>>2008</option>
						<option value="2007" <?php echo addSelected($year, "2007") ?>>2007</option>
						<option value="2006" <?php echo addSelected($year, "2006") ?>>2006</option>
						<option value="2005" <?php echo addSelected($year, "2005") ?>>2005</option>
						<option value="2004" <?php echo addSelected($year, "2004") ?>>2004</option>
						<option value="2003" <?php echo addSelected($year, "2003") ?>>2003</option>
						<option value="2002" <?php echo addSelected($year, "2002") ?>>2002</option>
						<option value="2001" <?php echo addSelected($year, "2001") ?>>2001</option>
						<option value="2000" <?php echo addSelected($year, "2000") ?>>2000</option>
					</select><br><br>
					<label style="color: black;">Gender</label>
					<select name="gen" required class="input3">
							<option value="">Select</option>
							<option value="Male" <?php echo addSelected($gender, "Male") ?>>Male</option>
							<option value="Female" <?php echo addSelected($gender, "Female") ?>>Female</option>
					</select><br><br>
					
					<label style="color: black;"> Phone No</label><br>
					<input type="text" class="input3" maxlength="10" name="pho" value="<?php echo $pno;?>"><br><br>
				</div>
				
				<div class="rbox">
				
				<label style="color: black;"> Parent's Mail Id</label><br>
					<input type="email" class="input3" name="email" value="<?php echo $email;?>"><br><br>
					
					<label style="color: black;">  Address</label><br>
					<textarea rows="5" name="addr"><?php echo $addr;?></textarea><br><br>
				
					<br><br>
					<label style="color: black;">Image</label><br>
					<input type="file"  class="input3" name="img"><br><br>
			
			<button type="submit"  class="btn" name="submit">Update Student Details</button>
				</div>
					
				</form>
				
				
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>