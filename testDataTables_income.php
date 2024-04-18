<?php
	include"database.php";
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="DataTables/jquery.dataTables.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="DataTables/buttons.dataTables.min.css"
    />
  </head>
  <body>
        <table id="example" class="display nowrap" style="width: 100%">
            
          <thead>
            <tr>
							<th>Date</th>
							<th>Source</th>
							<th>Income</th>
							<th>Expenses</th>
							<th>Profit</th>
						</tr>
          </thead>

          <tbody>
            
						<?php
							$s="SELECT DISTINCT(ca_date) FROM cafe";
							$res=$db->query($s);
							if($res->num_rows>0)
							{
								while($r=$res->fetch_assoc())
								{
									//While In While
									$sql="SELECT SUM(ca_inc) AS sum_ca_inc, 
									SUM(ca_exp) AS sum_ca_exp
									FROM cafe
									WHERE ca_date='{$r["ca_date"]}'";

									$res2=$db->query($sql);
									if($res2->num_rows>0)
									{
										while($r2=$res2->fetch_assoc())
										{
						?>

						<tr>
							<td><?php echo $r["ca_date"]?></td>
							<td>Cafeteria</td>
							<td><?php echo $r2["sum_ca_inc"]?></td>
							<td><?php echo $r2["sum_ca_exp"]?></td>
							<td><?php echo $r2["sum_ca_inc"] - $r2["sum_ca_exp"]?></td>
						</tr>

						<?php
										}
									}
								}
							}

							$sql_pay="SELECT DISTINCT(pay_date) FROM payment";
							$res_pay=$db->query($sql_pay);
							if($res_pay->num_rows>0)
							{
								while($r_pay=$res_pay->fetch_assoc())
								{
									//While In While
									$sql_pay2="SELECT SUM(amount) AS sum_class_inc
									FROM payment
									WHERE pay_date='{$r_pay["pay_date"]}'";

									$res_pay2=$db->query($sql_pay2);
									if($res_pay2->num_rows>0)
									{
										while($r_pay2=$res_pay2->fetch_assoc())
										{
									
						?>
						<tr>
							<td><?php echo $r_pay["pay_date"]; ?></td>
							<td>Class Fees</td>
							<td><?php echo $r_pay2["sum_class_inc"]; ?></td>
							<td><?php echo 0; ?></td>
							<td><?php echo $r_pay2["sum_class_inc"] - 0; ?></td>
						</tr>
						<?php
										}
									}
								}
							}

            ?>
            </tbody>
				</table>

    <script src="DataTables/jquery-3.5.1.js"></script>
    <script src="DataTables/jquery.dataTables.min.js"></script>
    <script src="DataTables/dataTables.buttons.min.js"></script>
    <script src="DataTables/buttons.flash.min.js"></script>
    <script src="DataTables/jszip.min.js"></script>
    <script src="DataTables/pdfmake.min.js"></script>
    <script src="DataTables/vfs_fonts.js"></script>
    <script src="DataTables/buttons.html5.min.js"></script>
    <script src="DataTables/buttons.print.min.js"></script>

    <script>
      $(document).ready(function () {
        $("#example").DataTable({
          dom: "Bfrtip",
          buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
      });
    </script>
  </body>
</html>
