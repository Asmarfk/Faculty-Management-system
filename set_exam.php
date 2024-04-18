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
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
			<?php include"navbar.php";?><br>
			<!--<img src="img/exam.jpg" style="margin-left:90px;" class="sha">-->
			
			<div id="section">
			
					<?php include"sidebar.php";?><br><br><br>
				
					<h3 class="text" style="color: black;">Welcome <?php echo $logged_user; ?></h3><br><hr><br>
				
				<div class="content">
					
						<h3 style="color: black;">Set Exam Time Table Details</h3><br>
					<?php
						if(isset($_POST["submit"]))
						{
							$edate=$_POST["da"].'-'.$_POST["mo"].'-'.$_POST["ye"];
							
							$sq="insert into exam(ENAME,ETYPE,EDATE,SESSION,CLASS,SUB) values ('{$_POST["ename"]}','{$_POST["etype"]}','{$edate}','{$_POST["ses"]}','{$_POST["cname"]}','{$_POST["sub"]}')";
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
			
					<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					
					<div class="lbox">
						<label style="color: black;"> Exam Name</label><br>
							<input type="text" class="input3" name="ename"><br><br>
						<label style="color: black;"> Select Term</label><br>
							<select name="etype" required class="input3">
						       <option value="">Select</option>
						       <option value="1st Semester">1st Semester</option>
						       <option value="2nd Semester">2nd Semester</option>
						       <option value="3rd Semester">3rd Semester</option>
							</select>
					<br><br>
					
					<label style="color: black;"> Exam Date</label><br>
					
					<select name="da" class="input5">
						<option value="">Date</option>
						<option value="1">1 </option>
						<option value="2">2 </option>
						<option value="3">3 </option>
						<option value="4">4 </option>
						<option value="5">5 </option>
						<option value="6">6 </option>
						<option value="7">7 </option>
						<option value="8">8 </option>
						<option value="9">9 </option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
						<option value="25">25</option>
						<option value="26">26</option>
						<option value="27">27</option>
						<option value="28">28</option>
						<option value="29">29</option>
						<option value="30">30</option>
						<option value="31">31</option>
						</select>
					<select name="mo" class="input5">
						<option> Month</option>
						<option value="01">Jan</option>
						<option value="02">Feb</option>
						<option value="03">Mar</option>
						<option value="04">Apr</option>
						<option value="05">May</option>
						<option value="06">Jun</option>
						<option value="07">Jul</option>
						<option value="08">Aug</option>
						<option value="09">Sep</option>
						<option value="10">Oct</option>
						<option value="11">Nov</option>
						<option value="12">Dec</option>
					</select>
					<select name="ye" class="input5">
						<option value="">Select Year</option>
						<option value="2030">2030</option>
						<option value="2029">2029</option>
						<option value="2028">2028</option>
						<option value="2027">2027</option>
						<option value="2026">2026</option>
						<option value="2025">2025</option>
						<option value="2024">2024</option>
						<option value="2023">2023</option>
						<option value="2022">2022</option>
						<option value="2021">2021</option>
						<option value="2020">2020</option>
					</select>
				</div>
				
				<div class="rbox">
					<label style="color: black;">Session</label>
						<select name="ses" required class="input3">
							<option value="">Select</option>
							<option value="Morning">Morning</option>
							<option value="Evening">Evening</option>
						</select>
					<br><br>
					
					
					<label style="color: black;">Faculties</label><br>
			
					<select name="cname"  required class="input3">
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
									echo "<option value='{$r["SNAME"]}'>{$r["SNAME"]}</option>";
								}
							}
						?>
						
					</select>
					<br><br>
				</div>
					<button type="submit" class="btn" name="submit">Set Exam</button>
				</form>
				
				
				</div>
				
				
			</div>
	
				<?php include"footer.php";?>
				<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
	</body>
</html>