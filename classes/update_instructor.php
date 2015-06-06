<?php
class update_instructor extends ACore_Admin {
	
	protected function obr() {
		
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/instructors/'.$_FILES['img_src']['name'])) 				{
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/instructors/'.$_FILES['img_src']['name'];
		}
		else {
			exit("Необходимо загрузить изображение");
		}
		
		$instructor_fio = $_POST['instructor_fio'];
		$instructor_bio = $_POST['instructor_bio'];
		
		if($_GET['uid_instructor']) {
			$uid_instructor = (int)$_GET['uid_instructor'];
		}
		
		//$query = "UPDATE instructor SET instructor_fio='$instructor_fio',instructor_bio='$instructor_bio',instructor_img='$img_src' WHERE uid_instructor='$uid_instructor'";
		//mysql_query($query);
		
		$query = "DELETE FROM instructor WHERE uid_instructor = '$uid_instructor'";
		$result = mysql_query($query);
			
		$query_course = "DELETE FROM courses WHERE uid_instructor = '$uid_instructor'";
		$$result_course = mysql_query($query_course);
			
		//создание каждого нового инструктора для каждого курса
		foreach ($_POST['courses'] as $v){
			$query = "INSERT INTO instructor
						(instructor_fio,instructor_bio,instructor_img,uid_course,uid_instructor)
					VALUES ('$instructor_fio','$instructor_bio','$img_src','$v','$uid_instructor')";
			mysql_query($query);
			
			$query_courses = "INSERT INTO courses
								(uid_courses,course_name,course_img,course_text,id_category,uid_instructor,level)
							SELECT '$v',course_name,course_img,course_text,id_category,'$uid_instructor',level
							FROM courses WHERE uid_courses='$v' GROUP BY course_name";
			mysql_query($query_courses);
		}
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
		
		if($_GET['uid_instructor']) {
			$uid_instructor = (int)$_GET['uid_instructor'];
		}
		else {
			exit('НЕ правильные данные для этой страницы');
		}
		
		$instructor = $this->get_text_instructor($uid_instructor);
		$course = $this->get_courses(); 
		$instructor_course = $this->get_instructor_uid_course($uid_instructor);
		
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST' onsubmit='$(".checkform").removeAttr('checked');'>
<p>Instructors FIO:<br />
<input type='text' name='instructor_fio' style='width:420px;' value='$instructor[instructor_fio]'>
</p>
<p>Image:<br />
<input type='file' name='img_src' value='$instructor[instructor_img]'>
</p>
<p>Instructors Biography :<br />
<textarea name='instructor_bio' cols='50' rows='7' value='$instructor[instructor_bio]'>$instructor[instructor_bio]</textarea>
</p>
HEREDOC;

//отмечаем checked 
$instr = array();
foreach($instructor_course as $instr_course) {
	$instr[] = $instr_course['uid_course'];
}
$i = 0;
foreach($course as $item) {	
		if($instr[$i]==$item['uid_courses']){
			echo "<input class='checkform' name='courses[]' type='checkbox' checked value='".$item['uid_courses']."'/> ".$item['course_name']."<br />";
			$i = $i + 1;
		}else{
			echo "<input class='checkform' name='courses[]' type='checkbox' value='".$item['uid_courses']."'/> ".$item['course_name']."<br />";		
		}
}

echo "</select><p><input type='submit' name='button' value='Сохранить'></p></form></div></div>";
	}
}
?>