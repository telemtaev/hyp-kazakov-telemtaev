<?php
class update_category extends ACore_Admin {
	
	protected function obr() {
		
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
		
		if(empty($title)) {
			exit("Не заполнены обязательные поля");
		}
		
		$query = "UPDATE cource_category SET category_name='$title',category_body='$body',category_image='$img_src' WHERE id_category='$id'";
		if(!mysql_query($query)) {
			exit(mysql_error());
		}
		else {
			$_SESSION['res'] = "Saved";
			header("Location:?option=edit_category");
			exit;
		}			
	}
	
	public function get_content() {
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
          	
		if($_GET['id_category']) {
			$id_category = (int)$_GET['id_category'];
		}
		else {
			exit('НЕ правильные данные для этой страницы');
		}
		
		$category = $this->get_text_category($id_category);
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		
print <<<HEREDOC
<form action='' method='POST'>
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
HEREDOC;
	}
}
?>