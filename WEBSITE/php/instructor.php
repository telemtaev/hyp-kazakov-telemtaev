<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php

		if(!$_GET['uid_instructor']) {
			echo 'Не правильные данные для вывода статьи';
		}
		else {
			$uid_instructor = (int)$_GET['uid_instructor'];
			if(!$uid_instructor) {
				echo 'Не правильные данные для вывода статьи';
			}
			else {
				$query = "SELECT uid_instructor,instructor_fio,instructor_bio,instructor_img 
							FROM instructor
							WHERE uid_instructor='$uid_instructor'";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
                    		//Вывод инструктора
 							$row = array();
							$row = mysql_fetch_array($result,MYSQL_ASSOC);
							printf("<h2 class='p3'><span class='color-1'>%s</span></h2><div class='wrap box-1'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p>%s</p></div></div>",$row['instructor_fio'],$row['instructor_img'],$row['instructor_bio']);
							
							//Вывод курсов
							$сourse = "SELECT uid_courses,course_name,course_text,course_img,uid_instructor
							FROM courses
							WHERE uid_instructor='$uid_instructor'
							GROUP BY course_name";
					
							$сourse_result = mysql_query($сourse);
							$row = array();
							echo'<h2 class="p3" align="center"><span class="color-1">Courses</span></h2>';
								for($i = 0; $i < mysql_num_rows($сourse_result);$i++) {
									$row = mysql_fetch_array($сourse_result,MYSQL_ASSOC);
									printf("<div class='wrap box-1'><a href='course.html?uid_courses=%s'><img src='%s' class='img-border img-indent' width='130px'><div class='extra-wrap-main'><p class='p2'><strong>%s</strong></p></a></div></div>",$row['uid_courses'],$row['course_img'],$row['course_name']);
								}
	}
	}							
?>