<?php
class delete_instructor extends ACore_Admin {
	public function get_content() {
		if($_GET['del']) {
			$id_instr = (int)$_GET['del'];
			
			$query = "DELETE FROM instructor WHERE uid_instructor = '$id_instr'";
			$result = mysql_query($query);
			
			$query_course = "DELETE FROM courses WHERE uid_instructor = '$id_instr'";
			$result_course = mysql_query($query_course);
			
			if($result) {
				$_SESSION['res'] = "<p style='color:#585858; font-size:17px; padding: 10px;'>Deleted</p>";
				header("Location:?option=edit_instructor");
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