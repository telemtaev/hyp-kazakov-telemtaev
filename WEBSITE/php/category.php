<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		$query = "SELECT id_category,category_name,category_body,category_image 
							FROM cource_category
							ORDER BY category_name";
		
		$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
		
                    	if(mysql_num_rows($result) > 0) {
							$row = array();
							for($i = 0; $i < mysql_num_rows($result);$i++) {
								$row = mysql_fetch_array($result,MYSQL_ASSOC);
								printf("<div class='wrap box-1'><a href='courses.html?id_category=%s'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p class='p2'><strong>%s</strong></p></a><p>%s</p></div>
                     </div>",$row['id_category'],$row['category_image'],$row['category_name'],$row['category_body']);
							}
						}else{
							echo 'В данной категории нет статтей';
						}
?>