<?php
	include"database.php";
	session_start();
	if(!isset($_SESSION["AID"]))
	{
		echo"<script>window.open('index.php?mes=Access Denied..','_self');</script>";
		
	}		
?>

<!DOCTYPE html>
<html>
	<head>
		<title>University Information</title>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="css/scrollup.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
	</head>
	<body>
	
		<?php include"navbar.php";?><br>
		
		
		<!-- <img src="img/a1.jpeg" style="margin-left:90px; height: 200px; width: 100%;" class="sha"> -->
			
			<div id="section">
			
				<?php include"sidebar.php";?><br>
				
				<div class="content" style="width:800px;">
					<h3 class="text" style="color: black;">Welcome <?php echo $_SESSION["ANAME"]; ?></h3><br><hr><br>
						<h3 style="color: black;"> University Information</h3><br>
					<img src="img/raja.png" class="imgs">

					<p class="para">
					Rajarata University of Sri Lanka was established as the eleventh National University in Sri Lanka and was inaugurally opened on the 
					31st January 1996 by her Excellency President Chandrika Bandaranayake as per the Gazette Notification 896/2 and the University act 16 of 1978 
					while the Faculties of Agriculture and Medicine and Allied Sciences are situated in Puliyankulama and Saliyapura respectively.
					</p>

					<p class="para">
					Sirimavo Bandaranayake, then Prime Minister, Hon. Speaker K.B. Rathnayake,
					 Minister of Higher Education Richard Pathirana, Deputy Minister of Higher Education Wishwa Warnapala, Governor NCP Maithripala Senanayake, Chairman UGC Prof. S. Thilakaratne, The first Vice Chancellor of RUSL Prof. W.I. Siriweera graced the inaugural ceremony Dr. Jayantha Kelegama was the first chancellor of RUSL. It is quite
					 significant that the RUSL was established in Mihintale, a sacred land a few kilometers away from the Historical Kingdom of Anuradhapura.
					</p>
					
					<p class="para">
					It is not an exaggeration to introduce Mihintale as the cradle of Buddhism,
					 15 km to the East of the Ancient Kingdom, Anuradhapura, a land gifted with ancient architecture and
					  irrigation which paved the way through Buddhism for an  admirable lifestyle and scholars of the Rajarata University of Sri Lanka are fortunate to receive education in this seat of learning.
					</p>

					

				</div>
				
			</div>
	
		<?php include"footer.php";?>
		<a class="gotopbtn" href="#"> <i class="fas fa-arrow-up"></i> </a>
