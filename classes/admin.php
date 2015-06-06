<?php
class admin extends ACore_Admin {
	
	public function get_content() {
		
		echo'			
			<section id="content">
        <div class="container_12">
          <div class="grid_12">
            <div class="slider">
              <ul class="items">
                 <li><img src="images/slider-1.jpg" alt="">
                    <div class="banner">
                        <p class="font-1">Special<span>Program</span></p>
                        <p class="font-2">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna.</p>
                        <a href="#">Read More</a>
                    </div>
                </li>
                <li><img src="images/slider-2.jpg" alt="">
                    <div class="banner">
                        <p class="font-1">Get Free<span>Training</span></p>
                        <p class="font-2">Liquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren.</p>
                        <a href="#">Read More</a>
                    </div>
                </li>
                <li><img src="images/slider-3.jpg" alt="">
                    <div class="banner">
                        <p class="font-1">Join<span>our team</span></p>
                        <p class="font-2">Liquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren.</p>
                        <a href="#">Read More</a>
                    </div>
                </li>
              </ul>
              <div class="pagination">
                  <ul>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                    <li><a href="#"></a></li>
                  </ul>
              </div>  
            </div>
          </div>	
          <div class="grid_12 top-1">
          	<div class="block-1 box-shadow">
            	<p class="font-3">Making the decision to join a gym is a great first step towards improving your health and quality of life. Fitness club, we are here to help make your gym experience fun, effective and easy. 
For over 30 years, Fitness club has been dedicated to giving people a great fitness experience while helping people of all fitness levels reach their goals. Whether your goal is to stay in shape, lose weight or get fit for an upcoming event, we are here for you.</p>
                 </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
    </section>'; 


		
				
		$query = "SELECT id_category,category_name,category_body,category_image 
							FROM cource_category
							ORDER BY category_name";
		
		$result = mysql_query($query);
				if(!$result) {
					exit(mysql_error());
				}
				
					
		echo "<div id='main'>";
		echo "<a style='color:red' href='?option=add_statti'>Add New Category </a><hr>";
		if($_SESSION['res']) {
			echo $_SESSION['res'];
			unset($_SESSION['res']);
		}
		
		
if(mysql_num_rows($result) > 0) {
							$row = array();
							for($i = 0; $i < mysql_num_rows($result);$i++) {
								$row = mysql_fetch_array($result,MYSQL_ASSOC);
								printf("<div class='wrap box-1'>
								<a href='?option=update_category&id_text=%s'>%s</a>
								|
								<a style='color:red' href='?option=delete_statti&del=%s'>Delete</a>

                     </div>",$row['id_category'],$row['category_name'],$row['id_category']);
							}
						}else{
							echo 'В данной категории нет статтей';
						}
                    	
 
		
			}
}		
			
?>