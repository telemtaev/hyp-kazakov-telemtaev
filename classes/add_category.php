<?php
class add_category extends ACore_Admin {
	
	protected function obr() {
		
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
			header("Location:?option=add_category");
			exit;
		}			
	}
	
	
	public function get_content() {
		echo'<section id="content">
        <div class="container_12">         	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">';
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST'>
<p>Course category name:<br />
<input type='text' name='title' style='width:420px;'>
</p>
<p>Category info:<br />
<textarea name='body' style='width:420px;'></textarea>
</p>
<p>Category image:<br />
<input type='file' name='img_src'>
</p>
<p><input type='submit' name='button' value='Save'></p></form></div></div>
HEREDOC;

echo '</div>
			</div>';
            	
            echo '</div>
          </div>
          <div class="clear"></div>
        </div>
    </section>'; 
	}
}
?>