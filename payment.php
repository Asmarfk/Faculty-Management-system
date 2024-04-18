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
    

    
    // if (!isset($_POST['class_val_sent'])){
    //     echo"<script>window.open('add_payment.php','_self');</script>";
    // }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Payment</title>
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
					
						<h3 style="color: black;"> Payment Details</h3><br>
						<?php
							if(isset($_POST["submit"]))
							{
                                date_default_timezone_set('Asia/Colombo');
                                $date = date("Y-m-d"); 
                                $time = date("h:i:sa"); 
								$sq="insert into payment(class_id,stu_id,month,year,amount,pay_method,pay_date, pay_time) values ('{$_POST["classid"]}','{$_POST["stuid"]}','{$_POST["month"]}','{$_POST["year"]}','{$_POST["amount"]}','{$_POST["paymeth"]}', '{$date}', '{$time}')";
								if($db->query($sq))
								{
									echo"<script>window.open('add_payment.php?success','_self');</script>";
								}
								else
								{
									echo"<script>window.open('add_payment.php?failed','_self');</script>";
								}
							}
						?>
						
						<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                        
                            <label style="color: black;">Class</label><br> 
                            <select name="classid" class="input3" required readonly>
                                <?php 
                                    $class_id = "";
                                    if(isset($_POST['stu_class_sent'])){
                                        $class_id = $_POST['stu_class_sent'];
                                    }    

                                    $sql="SELECT * FROM class
                                    JOIN lecturer ON class.TID = lecturer.TID
                                    JOIN sub ON class.SID = sub.SID
                                    WHERE CID = '{$class_id}'";
                                    $re=$db->query($sql);
                                    if($re->num_rows>0)
                                    {
                                    while($r=$re->fetch_assoc())
                                    {
                                    echo "<option value='{$r["CID"]}'>{$r["CID"]} - {$r["CNAME"]} {$r["SNAME"]} - {$r["TNAME"]}</option>";
                                    }
                                    }
                                ?>
                            </select>
                           <br><br>
						   <label style="color: black;">Student Id</label><br>  
                                <select name="stuid"  required class="input3">
                                <option value="">Select</option>
                                <?php
                                    $s="SELECT * FROM student JOIN student_class ON student.ID = student_class.stu_id WHERE CID = {$class_id}";
                                    $res=$db->query($s);
                                    if($res->num_rows>0)
                                    {
                                        $i=0;
                                        while($r=$res->fetch_assoc())
                                        {
                                            echo "<option value='{$r["ID"]}'>{$r["RNO"]} - {$r["NAME"]}</option>";    
                                            }   
                                        }
                                ?>
                                

                            </select>
						   <br><br>

						   <label style="color: black;">Month</label><br>
                            <select name="month"  required class="input3">
                                <option value="">Select</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                           <br><br>

                           <label style="color: black;">Year</label><br>
                            <select name="year"  required class="input3">
                                <option value="">Select</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                           <br><br>

                            <?php
                                
                                $s="SELECT class.CID, sub.SFEE
                                FROM class
                                JOIN sub ON class.SID = sub.SID
                                WHERE CID = {$_POST['stu_class_sent']}";
                                $res=$db->query($s);
                                if($res->num_rows>0)
                                    {
                                        while($r=$res->fetch_assoc())
                                        {
                                              $sub_fee = $r['SFEE'];
                                        }   
                                    }
                            
                            ?>
                            <label style="color: black;">Amount</label><br>
                            <input type="text" name="amount" required class="input3" readonly value="<?php echo $sub_fee; ?>">
                            <br><br>
						 
                         
                         
                           <label style="color: black;">Payment Method</label><br>
						   <select name="paymeth"  required class="input3">
							<option value="">Select</option>
							<option value="Cash">Cash</option>
							<option value="Card">Card</option>
							<option value="Bank Trasfer">Bank Trasfer</option>
                            <option value="Online Transaction">Online Transaction</option>
						</select><br><br>
						   <button type="submit" class="btn" name="submit">Make Payment</button>
						</form>
				
				
					</div>
				
				
				<div class="tbox" >
					<h3 style="margin-top:30px; color: black;"> Payment Details</h3><br>
					<?php
						if(isset($_GET["mes"]))
						{
							echo"<div class='error'>{$_GET["mes"]}</div>";	
						}
					
					?>
					<table border="1px" >
						<tr>
                            <th>P.Id</th>
                            <th>Class</th>
							<th>Student Id</th>
                            <th>Payment Date</th>
                            <th>Payment Time</th>
							<th>Month</th>
                            <th>Year</th>
							<th>Amount</th>
                            <th>Payment Method</th>
                            <th>Delete</th>
						</tr>
						<?php
							$s="select * from payment";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								$i=0;
								while($r=$res->fetch_assoc())
								{
									$i++;
								
									echo "
										<tr>
                                        <td>{$r["pay_id"]}</td>
                                        <td>{$r["class_id"]}</td>
                                        <td>{$r["stu_id"]}</td>
                                        <td>{$r["pay_date"]}</td>
                                        <td>{$r["pay_time"]}</td>
                                        <td>{$r["month"]}</td>
                                        <td>{$r["year"]}</td>
                                        <td>{$r["amount"]}</td>
                                        <td>{$r["pay_method"]}</td>
										<td><a href='payment_delete.php?id={$r["pay_id"]}'class='btnr'>Delete</a></td>
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