<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if($_GET['id_category']) {
			$id_category = (int)$_GET['id_category'];
		}
		else {
			exit('НЕ правильные данные для этой страницы');
		}
		
		$query = "SELECT id_category,category_name,category_body,category_image FROM cource_category WHERE id_category = '$id_category'";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$category = array();
		$category = mysql_fetch_array($result,MYSQL_ASSOC);
		
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}		
		
		print <<<HEREDOC
<form action='update_category.php' method='POST'>
<p>Course category name:<br />
<input type='text' name='title' style='width:420px;' value='$category[category_name]'>
</p>
<p>Category info:<br />
<textarea name='body' style='width:420px; value='$category[category_body]'>$category[category_body]</textarea>
<p/>
<p>Category image:<br />
<input type='file' name='img_src' value=''>
</p>
<input type='hidden' name='id' style='width:420px;' value='$category[id_category]'>
<p><input type='submit' name='button' value='Сохранить'></p></form></div></div>
</form>
HEREDOC;
?>