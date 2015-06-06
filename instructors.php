<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
	$query = "SELECT uid_instructor,instructor_fio,instructor_bio,instructor_img
					FROM instructor
					GROUP BY instructor_fio";
		
	$result = mysql_query($query);
	if(!$result) {
		exit(mysql_error());
	}		
	if(mysql_num_rows($result) > 0) {
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
				printf("<div class='wrap box-1'><a href='instructor.html?uid_instructor=%s'><img src='%s' class='img-border img-indent' width='250px'><div class='extra-wrap'><p class='p2'><strong>%s</strong></p></a><p>%s</p></div></div>",$row['uid_instructor'],$row['instructor_img'],$row['instructor_fio'],$row['instructor_bio']);
		}
	}else{
		echo 'В данной категории нет статтей';
	}
?>