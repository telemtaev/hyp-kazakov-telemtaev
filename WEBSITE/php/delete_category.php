<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php

		if($_GET['del']) {
			$id_cat = (int)$_GET['del'];
			
			$query = "DELETE FROM cource_category WHERE id_category = '$id_cat'";
			$result = mysql_query($query);
			
			if($result) {
				$_SESSION['res'] = "<p style='color:#585858; font-size:17px; padding: 10px;'>Deleted</p>";
				header("Location:edit_category.html");
				exit();
			}
			else {
				exit("Deleting mistake");
			}
		}
		else {
			exit("Не верные данные для этой страницы");
		}
?>