<?php
class add_instructor extends ACore_Admin {
	
	protected function obr() {
		
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/instructors/'.$_FILES['img_src']['name'])) {
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/instructors/'.$_FILES['img_src']['name'];
		}
		else {
			exit("Необходимо загрузить изображение");
		}
		
		$instructor_fio = $_POST['instructor_fio'];
		$instructor_bio= $_POST['instructor_bio'];
		
		//UID инструктора (последний)
		$uid_instructor_query = "SELECT uid_instructor FROM instructor";		
		$result_uid_instructor_query = mysql_query($uid_instructor_query);
		
		$row = array();
		$a = 0;
		for($i = 0; $i < mysql_num_rows($result_uid_instructor_query);$i++) {
			$row = mysql_fetch_array($result_uid_instructor_query,MYSQL_ASSOC);
			if ($a < (int)$row['uid_instructor']){
				$a = (int)$row['uid_instructor'];
			}
		}
		$a = $a + 1;
		
		//создание каждого нового инструктора для каждого курса
		foreach ($_POST['courses'] as $v){
			$query = "INSERT INTO instructor
						(instructor_fio,instructor_bio,instructor_img,uid_course,uid_instructor)
					VALUES ('$instructor_fio','$instructor_bio','$img_src','$v','$a')";
			mysql_query($query);
			
			$query_courses = "INSERT INTO courses
								(uid_courses,course_name,course_img,course_text,id_category,uid_instructor,level)
							SELECT '$v',course_name,course_img,course_text,id_category,'$a',level
							FROM courses WHERE uid_courses='$v' GROUP BY course_name";
			mysql_query($query_courses);
		}
              
		
		/*$query = " INSERT INTO instructor
						(instructor_fio,instructor_bio,instructor_img,uid_course,uid_instructor)
					VALUES ('$instructor_fio','$instructor_bio','$img_src','$cat','$a')";
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Изменения сохранены";
			header("Location:?option=add_instructor");
			exit;
		}*/			
	}
	
	public function get_content() {
	 
		
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
	
		}
		
		$course = $this->get_courses(); 
		
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST'>
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
   	}
}
?>