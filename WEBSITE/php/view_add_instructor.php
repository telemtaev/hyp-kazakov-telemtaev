<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
	
		}
		
		$query = "SELECT uid_courses, course_name FROM courses GROUP BY course_name"; 
		$result = mysql_query($query) ; 
		
		$course = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$course[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
				
print <<<HEREDOC
<form enctype='multipart/form-data' action='add_instructor.php' method='POST'>
<p>Instructors FIO:<br />
<input type='text' name='instructor_fio' style='width:420px;'>
</p>
<p>Image:<br />
<input type='file' name='img_src'>
</p>
<p>Instructors Biography :<br />
<textarea name='instructor_bio' cols='50' rows='7'></textarea>
</p>
HEREDOC;
foreach($course as $item) {
	echo "<input name='courses[]' type='checkbox' value='".$item['uid_courses']."'/> ".$item['course_name']."<br />";
}
echo "</select><p><input type='submit' name='button' value='Сохранить'></p></form></div></div>";
?>