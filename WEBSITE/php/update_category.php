<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		
		$id = $_POST['id'];
		$title = $_POST['title'];
		$body = $_POST['body'];
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/'.$_FILES['img_src']['name'])) {
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/'.$_FILES['img_src']['name'];
		}
		else {
			exit("Необходимо загрузить изображение");
		}
		
		$query = "UPDATE cource_category SET category_name='$title',category_body='$body',category_image='$img_src' WHERE id_category='$id'";
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Saved";
			header("Location:edit_category.html");
			exit;
		}			
?>