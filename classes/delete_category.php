<?php
class delete_category extends ACore_Admin {
	public function get_content() {
		if($_GET['del']) {
			$id_cat = (int)$_GET['del'];
			
			$query = "DELETE FROM cource_category WHERE id_category = '$id_cat'";
			$result = mysql_query($query);
			
			if($result) {
				$_SESSION['res'] = "<p style='color:#585858; font-size:17px; padding: 10px;'>Deleted</p>";
				header("Location:?option=edit_category");
				exit();
			}
			else {
				exit("Deleting mistake");
			}
		}
		else {
			exit("Не верные данные для этой страницы");
		}
	}	
}
?>