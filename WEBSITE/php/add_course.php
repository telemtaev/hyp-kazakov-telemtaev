<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/course/'.$_FILES['img_src']['name'])) {
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/course/'.$_FILES['img_src']['name'];
		}
		else {
			exit("Необходимо загрузить изображение");
		}
		
		$course_name = $_POST['course_name'];
		$course_text= $_POST['course_text'];
		$level= $_POST['level'];
		$category= $_POST['category'];
		
		
		
		//UID courses
		$uid_courses_query = "SELECT uid_courses FROM courses";		
		$result_uid_courses_query = mysql_query($uid_courses_query);
		
		$row = array();
		$a = 0;
		for($i = 0; $i < mysql_num_rows($result_uid_courses_query);$i++) {
			$row = mysql_fetch_array($result_uid_courses_query,MYSQL_ASSOC);
			if ($a < (int)$row['uid_courses']){
				$a = (int)$row['uid_courses'];
			}
		}
		$a = $a + 1;
		
		//создание каждого нового инструктора для каждого курса
	
				 	
				 	foreach($_POST['instructor'] as $in){
		$query = " INSERT INTO courses
						(uid_courses,course_name,course_img,course_text,id_category,uid_instructor,level)
					VALUES ('$a','$course_name','$img_src','$course_text','$category','$in','$level')";
				mysql_query($query);
				
				$query_courses = "INSERT INTO instructor
								(instructor_fio,instructor_bio,instructor_img,uid_course,uid_instructor)
							SELECT instructor_fio,instructor_bio,instructor_img,'$a','$in'
							FROM instructor WHERE uid_instructor='$in' GROUP BY instructor_fio";
			mysql_query($query_courses);
				 	}
					
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Saved";
			header("Location:edit_course.html");
			exit;
		}				 	
?>