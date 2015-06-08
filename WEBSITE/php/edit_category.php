<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		$query = "SELECT id_category,category_name FROM cource_category";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
        	
        echo "<a style='color:red' href='add_category.html'>Add new course category</a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
			printf("<p style='font-size:14px;'>
						<a style='color:#585858' href='update_category.html?id_category=%s'>%s</a> |
						<a style='color:red' href='delete_category.html?del=%s'>Delete</a>
					</p>",$row['id_category'],$row['category_name'],$row['id_category']);
		}

?>