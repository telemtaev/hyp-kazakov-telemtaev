<?php

abstract class ACore {
	
	
	protected $db;
	
	public function __construct() {
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
		$row = $this->menu_array();

    echo '<header>
        <h1><a href="/">Fitness <strong>Club.</strong></a></h1>
        <nav>
        	<div class="social-icons">
            	<a href="#" class="icon-2"></a>
            	<a href="#" class="icon-1"></a>
            </div>
            <ul class="menu">';
                $i = 1;
		foreach($row as $item) {
			printf("<li><a href='?option=%s'>%s</a></li>",$item['menu_text'],$item['title']);
				
				if($i != count($row)) {
					echo "";
				}
				$i++;
		}
            echo '</ul>
        </nav>
    </header>';		
	}
	
	protected function menu_array() {
		$query = "SELECT menu_text,title FROM menu";
		
		$result = mysql_query($query);
		if(!$result) {
			exit(mysql_error());
		}
		
		$row = array();
		
		for($i = 0;$i < mysql_num_rows($result); $i++) {
			$row[] = mysql_fetch_array($result, MYSQL_ASSOC);
		}
		return $row;
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
	
}

?>