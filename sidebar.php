<div class="sidebar"><br>
<h3 class="text" style="color: black;">Dashboard</h3><br><hr><br>
<ul class="s">
<?php
	if(isset($_SESSION["AID"]))
	{
		echo'
			<li class="li"><a href="admin_home.php">University Information</a></li>
			<li class="li"><a href="add_class.php">Manage Classes</a></li>
			<li class="li"><a href="add_sub.php">Subject</a></li>
			<li class="li"><a href="add_lecturer.php">Lecturers</a></li>
			<li class="li"><a href="View_lecturer.php">View Lecturers</a></li>
			<li class="li"><a href="add_staff.php"> Staff</a></li>
			<li class="li"><a href="view_staff.php">View Staff</a></li>
			<li class="li"><a href="set_exam.php">Set Exam</a></li>
			<li class="li"><a href="view_exam.php">View Exam</a></li>
			<li class="li"><a href="add_stud.php">Add Student</a></li>
			<li class="li"><a href="student.php">View Student</a></li>
			<li class="li"><a href="view_attendance.php">View Attendance</a></li>
			<li class="li"><a href="add_payment.php">Payment</a></li>
			<li class="li"><a href="cafeteria.php">Cafeteria</a></li>
			<!--li class="li"><a href="income_report.php">Income Report</a></li-->
			<li class="li"><a href="reports.php">Reports</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		';

	}
	elseif(isset($_SESSION["ID"]))
	{
		echo'
		<li class="li"><a href="student_home.php">Profile</a></li>
		<li class="li"><a href="view_exam_st.php">View Exam</a></li>
		<li class="li"><a href="view_mark_st.php">View Marks</a></li>
		<li class="li"><a href="View_lecturer.php">View Lecturers</a></li>
		<li class="li"><a href="view_attendance_st.php">View Attendance</a></li>
		<li class="li"><a href="logout.php">Logout</a></li>
		';

	}
	elseif(isset($_SESSION["NAID"]))
	{
		if($_SESSION["SROLE"] == "hr"){
			echo'
			<li class="li"><a href="staff_home.php">Profile</a></li>
			<li class="li"><a href="add_lecturer.php">Lecturers</a></li>
			<li class="li"><a href="View_lecturer.php">View Lecturers</a></li>
			<li class="li"><a href="add_staff.php">Staff</a></li>
			<li class="li"><a href="view_staff.php">View Staff</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
			';
		} elseif ($_SESSION["SROLE"] == "front_office") {
			echo'
			<li class="li"><a href="staff_home.php">Profile</a></li>
			<li class="li"><a href="add_class.php">Manage Classes</a></li>
			<li class="li"><a href="add_sub.php">Subject</a></li>
			<li class="li"><a href="add_stud.php">Add Student</a></li>
			<li class="li"><a href="student.php">View Student</a></li>
			<li class="li"><a href="view_exam.php">View Exam</a></li>
			<li class="li"><a href="class_report.php">Class Schedule Report</a></li>
			<li class="li"><a href="attendance_report.php">Attendance Report</a></li>
			<li class="li"><a href="add_payment.php">Payment</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
			';
		} elseif ($_SESSION["SROLE"] == "cafeteria") {
			echo'
			<li class="li"><a href="staff_home.php">Profile</a></li>
			<li class="li"><a href="cafeteria.php">Cafeteria</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
			';
		} elseif ($_SESSION["SROLE"] == "finance") {
			echo'
			<li class="li"><a href="staff_home.php">Profile</a></li>
			<li class="li"><a href="add_payment.php">Payment</a></li>
			<li class="li"><a href="view_staff.php">View Staff</a></li>
			<li class="li"><a href="View_lecturer.php">View Lecturers</a></li>
			<li class="li"><a href="student.php">View Student</a></li>
			<li class="li"><a href="view_attendance.php">View Attendance</a></li>
			<li class="li"><a href="income_report.php">Income Report</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
			';
		}


	}
	else{
		echo'
			<li class="li"><a href="lecturer_home.php">Profile</a></li>
			<li class="li"><a href="view_class.php">View My Classes</a></li>
			<!--li class="li"><a href="add_stud.php">Students</a></li-->
			<li class="li"><a href="view_stud_lec.php">View Student</a></li>
			<li class="li"><a href="lec_view_exam.php">View Exam</a></li>
			<li class="li"><a href="add_mark.php">Add Marks</a></li>
			<li class="li"><a href="view_mark.php">View Marks</a></li>
			<li class="li"><a href="add_attendance.php">Add Attendance</a></li>
			<li class="li"><a href="view_attendance.php">View Attendance</a></li>
			<li class="li"><a href="logout.php">Logout</a></li>
		';
	}


?>
	

</ul>

</div>