<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>

<?php 
				$query = "SELECT menu_text,title FROM menu";
		
				$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
			
				$row = array();
		
				for($i = 0;$i < mysql_num_rows($result); $i++) {
					$row[] = mysql_fetch_array($result, MYSQL_ASSOC);
				}
                $i = 1;
				foreach($row as $item) {
					printf('<li><a href="%s'.'.html'.'">%s</a></li>',$item['menu_text'],$item['title']);
				
					if($i != count($row)) {
						echo "";
					}
					$i++;
				}
?>