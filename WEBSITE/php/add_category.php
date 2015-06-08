<?php require_once("config.php");?>
<?php require_once("db_connect.php");?>
<?php
		if(!empty($_FILES['img_src']['tmp_name'])) {
			if(!move_uploaded_file($_FILES['img_src']['tmp_name'],'images/'.$_FILES['img_src']['name'])) {
				exit("Не удалось загрузить изображение");
			}
			$img_src = 'images/'.$_FILES['img_src']['name'];
		}
		else {
			exit("Необходимо загрузить изображение");
		}
		
		$title = $_POST['title'];		
		$body = $_POST['body'];
		
		if(empty($title) ||  empty($body)) {
			exit("Insert information in fields");
		}
					
		$query = " INSERT INTO cource_category
						(category_name,category_body,category_image)
					VALUES ('$title','$body','$img_src')";
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Saved";
			header("Location:edit_category.html");
			exit;
		}			
?>