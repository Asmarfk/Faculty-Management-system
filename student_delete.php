<?php
	include "database.php";
	session_start();
	$s="delete from student where ID={$_GET["stuid"]}";

    if ($db->query($s)) {
		echo "<script>window.open('student.php?success&mes=Data Deleted','_self');</script>";
	} else {
		echo "<script>window.open('student.php?failed&mes=Failed to Delete (Students cannot be deleted if assigned to class)','_self');</script>";
	}



?>