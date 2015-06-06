<?php
class edit_course extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT uid_courses,course_name FROM courses GROUP BY course_name";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}

		
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
          	
        echo "<a style='color:red' href='?option=add_course'>Add new Course</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_courses&uid_courses=%s'>%s</a> |
						<a style='color:red' href='?option=delete_courses&del=%s'>Delete</a>
					</p>",$row['uid_courses'],$row['course_name'],$row['uid_courses']);
		}
		
		echo '</div>
			</div>';
            	
            echo '</div>
          </div>
          <div class="clear"></div>
        </div>
    </section>'; 
    
    
		
	}
}
?>