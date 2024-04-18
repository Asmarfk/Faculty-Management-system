<?php
	include"database.php";
	session_start();
	$s="delete from lecturer where TID={$_GET['id']}";
	if($db->query($s)) {
		echo"<script>window.open('View_lecturer.php','_self');</script>";
	} else {
		echo"<script>alert('Unable to Delete Lecturer');</script>";
		echo"<script>window.open('View_lecturer.php','_self');</script>";
	}

	

?>