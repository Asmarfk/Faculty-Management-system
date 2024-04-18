<?php
	include "database.php";
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Rajarata University of Sri Lanka.</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body class="back" style= width:70%;>

		<?php include"navbar.php";?>

		<img src="images/ad.jpg" width=100%>
		
		<div class="login">
			<h1 class="heading" style="color: blue;">Admin Login</h1>
			<div class="log">
			<?php
				if(isset($_POST["login"]))
				{
					$enc_PASSWORD=md5($_POST["apass"]);
					$sql="select * from admin where ANAME='{$_POST["aname"]}' and APASS='{$enc_PASSWORD}'";
					$res=$db->query($sql);
					if($res->num_rows>0)
					{
						$ro=$res->fetch_assoc();
						$_SESSION["AID"]=$ro["AID"];
						$_SESSION["ANAME"]=$ro["ANAME"];
						echo "<script>window.open('admin_home.php','_self');</script>";
					}
					else
					{
						echo "<div class='error'>Invalid Username or Password</div>";
					}
					
				}
				if(isset($_GET["mes"]))
				{
					echo "<div class='error'>{$_GET["mes"]}</div>";
				}
				
			?>
		
				<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<label style="color: black;">User Name</label><br>
					<input type="text" name="aname" required class="input"><br><br>
					<label style="color: black;">Password </label><br>
					<input type="password" name="apass" required class="input"><br>
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