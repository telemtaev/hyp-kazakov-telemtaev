<?php
class update_courses extends ACore_Admin {
	
	protected function obr() {
		
		$uid_courses = (int)$_GET['uid_courses'];
		$course_name = $_POST['course_name'];
		$course_text= $_POST['course_text'];
		$level = $_POST['level'];
		$category = $_POST['category'];
		$instructor=$_POST['instructor'];
		
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/course/'.$_FILES['img_src']['name'])) 				{
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/course/'.$_FILES['img_src']['name'];
		}		
	
		
		$query = "DELETE FROM courses WHERE uid_courses = '$uid_courses'";
		$result = mysql_query($query);
			
		$query_course = "DELETE FROM instructor WHERE uid_course = '$uid_courses'";
		$result_course = mysql_query($query_course);
			
			//создание каждого нового курса для каждого инструктора
		foreach ($_POST['instructor'] as $v){
			$query = "INSERT INTO courses
						(uid_courses,course_name,course_img,course_text,id_category,uid_instructor,level)
					VALUES ('$uid_courses','$course_name','$img_src','$course_text','$category','$v','$level')";
			mysql_query($query);
			
			$query_courses = "INSERT INTO instructor
								(instructor_fio,instructor_bio,instructor_img,uid_course,uid_instructor)
							SELECT instructor_fio,instructor_bio,instructor_img,'$uid_courses','$v'
							FROM instructor WHERE uid_instructor='$v' GROUP BY instructor_fio";
			mysql_query($query_courses);
		}
	


	
	
		
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Saved";
			header("Location:?option=edit_course");
			exit;
		}			
	}
	
	public function get_content() {
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
          	
		if($_GET['uid_courses']) {
			$uid_courses = (int)$_GET['uid_courses'];
		}
		else {
			exit('НЕ правильные данные для этой страницы');
		}
		
		$course = $this->get_text_courses($uid_courses);
		$instructor = $this->get_instructor(); 
		$c = $this->get_category(); 
		$course_id_category = $this->get_course_id_category($uid_courses);
		$course_uid_instructor = $this->get_course_uid_instructor($uid_courses);
		
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST' onsubmit='$(".checkform").removeAttr('checked');'>
<p>Course Name:<br />
<input type='text' name='course_name' style='width:420px;' value='$course[course_name]'>
</p>
<p>Image:<br />
<input type='file' name='img_src' value='$course[course_img]'>
</p>
<p>Description :<br />
<textarea name='course_text' cols='50' rows='7' value='$course[course_text]'>$course[course_text]</textarea>
</p>
<p>Level<br />
<input type='text' name='level' style='width:420px;' value='$course[level]'>
HEREDOC;

echo "<p>Category:<br /><select size='1' name='category'>";


foreach($c as $item) {
	if ($item['id_category'] == $course_id_category['id_category']) {
		echo "<option selected value='".$item['id_category']."'/> ".$item['category_name']."<br /></option>";
	}else{
		echo "<option value='".$item['id_category']."'/> ".$item['category_name']."<br /></option>";
	}
}
//отмечаем checked инструкторов
echo "</select><p>Instructors:<br />";
$cour = array();
foreach($course_uid_instructor as $cours_instr) {
	$cour[] = $cours_instr['uid_instructor'];
}
$i = 0;
foreach($instructor as $items) {	
		if($cour[$i]==$items['uid_instructor']){
			echo "<input class='checkform' name='instructor[]' type='checkbox' checked value='".$items['uid_instructor']."'/> ".$items['instructor_fio']."<br />";
			$i = $i + 1;
		}else{
			echo "<input class='checkform' name='instructor[]' type='checkbox' value='".$items['uid_instructor']."'/> ".$items['instructor_fio']."<br />";		
		}
}


echo "<p><input type='submit' name='button' value='Сохранить'></p></form></div>
			</div>";
            	}

}
?>