<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if($_GET['del']) {
			$uid_courses = (int)$_GET['del'];
			
			$query = "DELETE FROM courses WHERE uid_courses = '$uid_courses'";
			$result = mysql_query($query);
			
			$query_course = "DELETE FROM instructor WHERE uid_course = '$uid_courses'";
			$result_course = mysql_query($query_course);
			
			if($result) {
				$_SESSION['res'] = "<p style='color:#585858; font-size:17px; padding: 10px;'>Deleted</p>";
				header("Location:edit_course.html");
				exit();
			}
			else {
				exit("Deleting mistake");
			}
		}
		else {
			exit("Не верные данные для этой страницы");
		}
?>