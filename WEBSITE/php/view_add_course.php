<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
	
		}
		
		$query = "SELECT uid_instructor, instructor_fio FROM instructor GROUP BY instructor_fio"; 
		$result = mysql_query($query) ; 
		
		$cat = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$cat[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
 
		$query = "SELECT id_category, category_name FROM cource_category GROUP BY category_name"; 
		$result = mysql_query($query) ; 
		
		$c = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$c[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		
print <<<HEREDOC
<form enctype='multipart/form-data' action='add_course.php' method='POST'>
<p>Course Name:<br />
<input type='text' name='course_name' style='width:420px;'>
</p>
<p>Image:<br />
<input type='file' name='img_src'>
</p>
<p>Course Discription :<br />
<textarea name='course_text' cols='50' rows='7'></textarea>
</p>
<p>Level<br />
<input type='text' name='level' style='width:420px;'>
</p>
<p>Instructors :<br />
HEREDOC;
foreach($cat as $item) {
	echo "<input name='instructor[]' type='checkbox' value='".$item['uid_instructor']."'/> ".$item['instructor_fio']."<br />";
}
echo "<p>Category:<br /><select size='1' name='category'>";

foreach($c as $item) {
	echo "<option value='".$item['id_category']."'/> ".$item['category_name']."<br /></option>";
}

echo "</select><p><input type='submit' name='button' value='Сохранить'></p></form></div>
			</div>";

?>