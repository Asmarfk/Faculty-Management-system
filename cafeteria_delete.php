<?php
	include"database.php";
	session_start();
	$s="delete from cafe where caid={$_GET["id"]}";
	$db->query($s);
	echo"<script>window.open('cafeteria.php','_self');</script>";

?>