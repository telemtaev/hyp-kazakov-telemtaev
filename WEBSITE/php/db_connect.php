<?php 
		$lnk = mysql_connect(HOST,USER,PASSWORD);
		if(!mysql_select_db(DB,$lnk)) {
			exit("Нет такой базы данных ".mysql_error());
		}
		mysql_query("SET NAMES 'UTF8'");
?>
