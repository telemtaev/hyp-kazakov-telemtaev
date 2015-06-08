<?php

abstract class ACore_Admin {
	
	
	protected $db;
	

	
	public function __construct() {
		
		/*if(!$_SESSION['user']) {
			header("Location:?option=login");
		}*/
	
		$this->db = mysql_connect(HOST,USER,PASSWORD);
		if(!$this->db) {
			exit("Ошибка соединения с базой данных".mysql_error());
		}
		if(!mysql_select_db(DB,$this->db)) {
			exit("Нет такой базы данных ".mysql_error());
		}
		mysql_query("SET NAMES 'UTF8'");
		
	}
	
 	
	protected function get_header() {
		include "header.php";
	}
	
	protected function get_menu() {
		
    echo '<header>
        <h1><a href="/">Fitness <strong>Club.</strong></a></h1>
        <nav>
        	<div class="social-icons">
            	<a href="#" class="icon-2"></a>
            	<a href="#" class="icon-1"></a>
            </div>
            <ul class="menu">
        <li><a href="?option=admin">Admin Panel</a></li>
		<li><a href="?option=edit_instructor">Instructors</a></li>
		<li><a href="?option=edit_course">Course</a></li>
		<li><a href="?option=edit_category">Course Category </a></li>
		</ul>
        </nav>
    </header>';		
    
   
		echo "</div>";		
	}
	
 

	protected function get_footer() {
		echo '<footer><p>© 2015 Fitness Club</p></footer></div><script>Cufon.now();</script></body></html>';
	}
	
	
	public function get_body() {
	
		if($_POST) {
			$this->obr();
		}
		$this->get_header();
		$this->get_menu();
		$this->get_content();
		$this->get_footer();
	}
	
	abstract function get_content();
	
	protected function get_courses(){
		$query = "SELECT uid_courses, course_name FROM courses GROUP BY course_name"; 
		$result = mysql_query($query) ; 
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $row; 
	}
	
	protected function get_instructor(){
		$query = "SELECT uid_instructor, instructor_fio FROM instructor GROUP BY instructor_fio"; 
		$result = mysql_query($query) ; 
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $row; 
	}
	
	protected function get_category(){
		$query = "SELECT id_category, category_name FROM cource_category GROUP BY category_name"; 
		$result = mysql_query($query) ; 
		
		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $row; 
	}


	
	protected function get_text_category($id) {
		$query = "SELECT id_category,category_name,category_body,category_image FROM cource_category WHERE id_category = '$id'";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
	
	protected function get_text_courses($uid) {
		$query = "SELECT uid_courses,course_name,course_text,course_img,level FROM courses WHERE uid_courses = '$uid' GROUP BY course_name";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
	protected function get_text_instructor($uid) {
		$query = "SELECT instructor_fio,instructor_bio,instructor_img,uid_course FROM instructor WHERE uid_instructor = '$uid' GROUP BY instructor_fio";
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		$row = array();
		$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
	
	protected function get_instructor_uid_course($uid) {
		$query = "SELECT uid_course FROM instructor WHERE uid_instructor = '$uid'";
		$result = mysql_query($query);

		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $row;
	}
			protected function get_course_uid_instructor($uid) {
		$query = "SELECT uid_instructor FROM courses WHERE uid_courses= '$uid'";
		$result = mysql_query($query);

		$row = array();
		for($i = 0; $i < mysql_num_rows($result);$i++) {
			$row[] = mysql_fetch_array($result,MYSQL_ASSOC);
		}
		return $row;
	}
		
	protected function get_course_id_category($uid) {
		$query = "SELECT id_category FROM courses WHERE uid_courses = '$uid'";
		$result = mysql_query($query);

		$row = array();
			$row = mysql_fetch_array($result,MYSQL_ASSOC);
		return $row;
	}
}


?>