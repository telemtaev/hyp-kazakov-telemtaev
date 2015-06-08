<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if(!$_GET['uid_courses']) {
			echo 'Не правильные данные для вывода статьи';
		}
		else {
			$uid_courses = (int)$_GET['uid_courses'];
			if(!$uid_courses) {
				echo 'Не правильные данные для вывода статьи';
			}
			else {
				$query = "SELECT id_courses,uid_courses,course_name,course_text,course_img,level
							FROM courses
							WHERE uid_courses='$uid_courses'";
				$result = mysql_query($query);

				if(!$result) {
					exit(mysql_error());
				}
       	
					//Вывод курса
					$row = array();
					$row = mysql_fetch_array($result,MYSQL_ASSOC);
					printf("<h2 class='p3'><span class='color-1'>%s (%s)</span></h2><div class='wrap box-1'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p>%s</p></div></div>",$row['course_name'],$row['level'],$row['course_img'],$row['course_text']);
                     
                     
                     //Вывод инструкторов                    
                     $instr = "SELECT uid_instructor,instructor_fio,instructor_bio,instructor_img,uid_course
							FROM instructor
							WHERE uid_course='$uid_courses'
							GROUP BY instructor_fio";
					
					$instr_result = mysql_query($instr);
					$row = array();
					echo'<h2 class="p3" align="center"><span class="color-1">Instructors</span></h2>';
						for($i = 0; $i < mysql_num_rows($instr_result);$i++) {
								$row = mysql_fetch_array($instr_result,MYSQL_ASSOC);
								printf("<div class='wrap box-1'><a href='instructor.html?uid_instructor=%s'><img src='%s' class='img-border img-indent' width='130px'><div class='extra-wrap-main'><p class='p2'><strong>%s</strong></p></a></div>
                     </div>",$row['uid_instructor'],$row['instructor_img'],$row['instructor_fio']);
						}
					}                    
                 }
		
?>