<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
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
					VALUES ('$instructor_fio','$instructor_bio','$img_src','$cat','$a')";*/
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Изменения сохранены";
			header("Location:edit_instructor.html");
			exit;
		}			
?>