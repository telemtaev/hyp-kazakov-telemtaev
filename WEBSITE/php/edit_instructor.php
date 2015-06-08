<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		$query = "SELECT uid_instructor,instructor_fio FROM instructor GROUP BY instructor_fio";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}

		
	    echo "<a style='color:red' href='add_instructor.html'>Add new Instructor</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='update_instructor.html?uid_instructor=%s'>%s</a> |
						<a style='color:red' href='delete_instructor.html?del=%s'>Delete</a>
					</p>",$row['uid_instructor'],$row['instructor_fio'],$row['uid_instructor']);
		}
?>