<?php
	include"database.php";
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rajarata University of Sri Lanka.</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	</head>
	<body class="back" style= width:70%;>
	
		<?php include"navbar.php";?>
		
		<img src="images/st.png" height="300" width=100%>
		
		<div class="login">
			<h1 class="heading" style="color: blue;">Student's Login</h1>
			<div class="log">
				<?php
					if(isset($_POST["login"]))
					{

						$enc_PASSWORD=md5($_POST["PASS"]);
						$sql="select * from student where NAME='{$_POST["name"]}'and PASS='{$enc_PASSWORD}'";
						$res=$db->query($sql);
						
						//Without Encryption send data to database
						// $sql="select * from student where NAME='{$_POST["name"]}'and PASS='{$_POST["PASS"]}'";
						// $res=$db->query($sql);

						if($res->num_rows>0)
						{
							$ro=$res->fetch_assoc();
							
							$_SESSION["ID"]=$ro["ID"];
							$_SESSION["NAME"]=$ro["NAME"];
							
							echo "<script>window.open('student_home.php','_self');</script>";
						}
						else
						{
							echo "<div class='error'>Invalid Username Or Password</div>";
						}
					}
				
				
				
				?>
			
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label style="color: black;">User Name</label><br>
					<input type="text" name="name" required class="input"><br><br>
					<label style="color: black;">Password </label><br>
					<input type="password" name="PASS" required class="input"><br>
					<button type="submit" class="btn" name="login">Login Here</button>
				</form>
			</div>
		</div>
		
		
		
		<div class="footer">
			<footer><p>Copyright &copy; Rajarata University of Sri Lanka. All Rights Reserved. </p></footer>
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
		
	</body>
</html>