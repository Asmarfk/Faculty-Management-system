<?php
	include "database.php";
	session_start();
	$s="delete from payment where pay_id={$_GET["id"]}";
	$db->query($s);
	echo "<script>window.open('add_payment.php?mes=Data Deleted..','_self');</script>";
?>