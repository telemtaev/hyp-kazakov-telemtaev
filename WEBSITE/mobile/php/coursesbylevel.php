<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
    /*список исходя из ссылки категории, если нет ссылки на категории, то выводятся все курсы*/
    
		if(!$_GET['id_category']) {
			$query = "SELECT course_name,id_courses,uid_courses,course_text,course_img,level FROM courses
							GROUP BY level,course_name";
		
		$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
		                    	
                    	if(mysql_num_rows($result) > 0) {
							$row = array();
							for($i = 0; $i < mysql_num_rows($result);$i++) {
								$row = mysql_fetch_array($result,MYSQL_ASSOC);
								printf("<div class='wrap box-1'><a href='course.html?uid_courses=%s'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p class='p2'><strong>%s (%s)</strong></p></a><p>%s</p></div>
                     </div>",$row['uid_courses'],$row['course_img'],$row['course_name'],$row['level'],$row['course_text']);
							}
						}else{
							echo 'В данной категории нет статей';
						}                    	
                        
            }else {
			$id_category = (int)$_GET['id_category'];
			if(!$id_category) {
				echo 'Не правильные данные для вывода статьи';
			}
			else {
				$query = "SELECT id_courses,uid_courses,course_name,course_text,course_img,id_category
							FROM courses
							WHERE id_category='$id_category'
							GROUP BY course_name";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
				                  	
                    	if(mysql_num_rows($result) > 0) {
							$row = array();
							for($i = 0; $i < mysql_num_rows($result);$i++) {
								$row = mysql_fetch_array($result,MYSQL_ASSOC);
								printf("<div class='wrap box-1'><a href='course.html?uid_courses=%s'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p class='p2'><strong>%s</strong></p></a><p>%s</p></div>
                     </div>",$row['uid_courses'],$row['course_img'],$row['course_name'],$row['course_text']);
							}
						}else{
							echo 'No courses at this category';
						}                       
                        
			}
		}
?>