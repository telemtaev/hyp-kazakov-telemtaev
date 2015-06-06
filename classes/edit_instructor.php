<?php
class edit_instructor extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT uid_instructor,instructor_fio FROM instructor GROUP BY instructor_fio";
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}

		
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
          	
        echo "<a style='color:red' href='?option=add_instructor'>Add new Instructor</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_instructor&uid_instructor=%s'>%s</a> |
						<a style='color:red' href='?option=delete_instructor&del=%s'>Delete</a>
					</p>",$row['uid_instructor'],$row['instructor_fio'],$row['uid_instructor']);
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