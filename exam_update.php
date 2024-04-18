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
		<title>Set Exam</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
			<?php include"navbar.php";?><br>
			<!--<img src="img/exam.jpg" style="margin-left:90px;" class="sha">-->
			
			<div id="section">
			
					<?php include"sidebar.php";?><br><br><br>
				
					<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				
				<div class="content">
					
						<h3 style="color: black;">Update Exam Time Table Details</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
							$edate=$_POST["da"].'-'.$_POST["mo"].'-'.$_POST["ye"];
							
							$sq = "UPDATE `exam` SET `ENAME`='{$_POST["ename"]}',`ETYPE`='{$_POST["etype"]}',`EDATE`='{$edate}',`SESSION`='{$_POST["ses"]}',`CLASS`='{$_POST["cla"]}',`SUB`='{$_POST["sub"]}' WHERE `EID`='{$_POST["eid"]}'";
							if($db->query($sq))    
							{
                                echo "<script>window.open('view_exam.php?id={$_POST["eid"]}&success','_self');</script>";   
							}
							else
							{
                                echo "<script>window.open('exam_update.php?id={$_POST["eid"]}&failed','_self');</script>";  
							}
						}
					?>

                <?php
                    if (isset($_GET["success"])) {
                        echo "<div class='success'>Update Success</div>";
                    } elseif (isset($_GET["failed"])){
                        echo "<div class='error'>Update Failed</div>";
                    }
                ?>
                    
				<?php


                    if(!isset($_GET['id'])){
                        echo "<script>window.open('view_exam.php','_self');</script>";
                    } else {
                        $q="SELECT * FROM exam WHERE EID =".$_GET['id'];
                        $res1=$db->query($q);
                        if($res1->num_rows>0)
                        {
                            while($r=$res1->fetch_assoc())
                            {
                                $eid = $_GET['id'];
                                $ename = $r["ENAME"];
                                $term = $r["ETYPE"];
                                $edate = $r["EDATE"];
                                $day = explode("-", $edate)[0];
                                $month = explode("-", $edate)[1];
                                $year = explode("-", $edate)[2];
                                $exam_session = $r["SESSION"];
                                $exam_class = $r["CLASS"];
                                $subject = $r["SUB"];
                                
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
					<input type="text" name="eid" value= '<?php echo $eid;?>' hidden>
					<div class="lbox">
						<label style="color: black;"> Exam Name</label><br>
							<input type="text" class="input3" name="ename" value="<?php echo $ename; ?>"><br><br>
						<label style="color: black;"> Select Term</label><br>
							<select name="etype" required class="input3">
						       <option value="">Select</option>
						       <option value="1st Semester" <?php echo addSelected($term, "1st Semester") ?>>1st Semester</option>
						       <option value="2nd Semester" <?php echo addSelected($term, "2nd Semester") ?>>2nd Semester</option>
						       <option value="3rd Semester" <?php echo addSelected($term, "3rd Semester") ?>>3rd Semester</option>
							</select>
					<br><br>
					
					<label style="color: black;"> Exam Date</label><br>
					
					<select name="da" class="input5">
						<option value="">Date</option>
						<option value="1" <?php echo addSelected($day, "1") ?>>1 </option>
						<option value="2" <?php echo addSelected($day, "2") ?>>2 </option>
						<option value="3"<?php echo addSelected($day, "3") ?>>3 </option>
						<option value="4" <?php echo addSelected($day, "4") ?>>4 </option>
						<option value="5" <?php echo addSelected($day, "5") ?>>5 </option>
						<option value="6" <?php echo addSelected($day, "6") ?>>6 </option>
						<option value="7" <?php echo addSelected($day, "7") ?>>7 </option>
						<option value="8" <?php echo addSelected($day, "8") ?>>8 </option>
						<option value="9" <?php echo addSelected($day, "9") ?>>9 </option>
						<option value="10" <?php echo addSelected($day, "10") ?>>10</option>
						<option value="11" <?php echo addSelected($day, "11") ?>>11</option>
						<option value="12" <?php echo addSelected($day, "12") ?>>12</option>
						<option value="13" <?php echo addSelected($day, "13") ?>>13</option>
						<option value="14" <?php echo addSelected($day, "14") ?>>14</option>
						<option value="15" <?php echo addSelected($day, "15") ?>>15</option>
						<option value="16" <?php echo addSelected($day, "16") ?>>16</option>
						<option value="17" <?php echo addSelected($day, "17") ?>>17</option>
						<option value="18" <?php echo addSelected($day, "18") ?>>18</option>
						<option value="19" <?php echo addSelected($day, "19") ?>>19</option>
						<option value="20" <?php echo addSelected($day, "20") ?>>20</option>
						<option value="21" <?php echo addSelected($day, "21") ?>>21</option>
						<option value="22" <?php echo addSelected($day, "22") ?>>22</option>
						<option value="23" <?php echo addSelected($day, "23") ?>>23</option>
						<option value="24" <?php echo addSelected($day, "24") ?>>24</option>
						<option value="25" <?php echo addSelected($day, "25") ?>>25</option>
						<option value="26" <?php echo addSelected($day, "26") ?>>26</option>
						<option value="27" <?php echo addSelected($day, "27") ?>>27</option>
						<option value="28" <?php echo addSelected($day, "28") ?>>28</option>
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
						<option value="2030" <?php echo addSelected($year, "2030") ?>>2030</option>
						<option value="2029" <?php echo addSelected($year, "2029") ?>>2029</option>
						<option value="2028" <?php echo addSelected($year, "2028") ?>>2028</option>
						<option value="2027" <?php echo addSelected($year, "2027") ?>>2027</option>
						<option value="2026" <?php echo addSelected($year, "2026") ?>>2026</option>
						<option value="2025" <?php echo addSelected($year, "2025") ?>>2025</option>
						<option value="2024" <?php echo addSelected($year, "2024") ?>>2024</option>
						<option value="2023" <?php echo addSelected($year, "2023") ?>>2023</option>
						<option value="2022" <?php echo addSelected($year, "2022") ?>>2022</option>
						<option value="2021" <?php echo addSelected($year, "2021") ?>>2021</option>
						<option value="2020" <?php echo addSelected($year, "2020") ?>>2020</option>
					</select>
				</div>
				
				<div class="rbox">
					<label style="color: black;">Session</label>
						<select name="ses" required class="input3">
							<option value="">Select</option>
							<option value="Morning" <?php echo addSelected($exam_session, "Morning") ?>>Morning</option>
							<option value="Evening" <?php echo addSelected($exam_session, "Evening") ?>>Evening</option>
						</select>
					<br><br>
					
					
					<label style="color: black;">Faculties</label><br>
					<select name="cla" required class="input3">
                        <option value="Technology" <?php echo addSelected($exam_class, "Technology");?>>Technology</option>
                        <option value="Mangment Studies" <?php echo addSelected($exam_class, "Mangment Studies");?>>Mangment Studies</option>
                        <!-- <option value="Grade 8" <?php echo addSelected($exam_class, "Grade 8");?>>Grade 8</option>
                        <option value="Grade 9" <?php echo addSelected($exam_class, "Grade 9");?>>Grade 9</option>
                        <option value="Grade 10" <?php echo addSelected($exam_class, "Grade 10");?>>Grade 10</option>
                        <option value="Grade 11" <?php echo addSelected($exam_class, "Grade 11");?>>Grade 11</option>
                        <option value="Grade 12" <?php echo addSelected($exam_class, "Grade 12");?>>Grade 12</option>
                        <option value="Grade 13" <?php echo addSelected($exam_class, "Grade 13");?>>Grade 13</option>	 -->
					</select>
					
					<br><br>
					
					
					<label style="color: black;">Subject</label><br>
					<select name="sub" required class="input3">
						<?php
							$s="select * from sub";
							$re=$db->query($s);
							if($re->num_rows>0)
							{
								echo "<option value=''>select</option>";
								while($r=$re->fetch_assoc())
								{
                                ?>
									<option value='<?php echo $r["SNAME"]; ?>' <?php echo addSelected($subject, "{$r['SNAME']}");?>><?php echo $r["SNAME"]; ?></option>
                                <?php
								}
							}
						?>
						
					</select>
					<br><br>
				</div>
					<button type="submit" class="btn" name="submit">Update Exam Details</button>
				</form>
				
				
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
	</body>
</html>