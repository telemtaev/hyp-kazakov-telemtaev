<?php
class edit_category extends ACore_Admin {
	
	public function get_content() {
		
		$query = "SELECT id_category,category_name FROM cource_category";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
          	
        echo "<a style='color:red' href='?option=add_category'>Add new course category</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='?option=update_category&id_category=%s'>%s</a> |
						<a style='color:red' href='?option=delete_category&del=%s'>Delete</a>
					</p>",$row['id_category'],$row['category_name'],$row['id_category']);
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