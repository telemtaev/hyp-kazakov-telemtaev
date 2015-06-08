<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		$query = "SELECT uid_courses,course_name FROM courses GROUP BY course_name";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
          	
        echo "<a style='color:red' href='add_course.html'>Add new Course</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='update_courses.html?uid_courses=%s'>%s</a> |
						<a style='color:red' href='delete_courses.html?del=%s'>Delete</a>
					</p>",$row['uid_courses'],$row['course_name'],$row['uid_courses']);
		}
?>