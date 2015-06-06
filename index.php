<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fitness Club</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/layout.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/grid_12.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/slider.css">
    <script src="js/jquery-1.7.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/tms-0.3.js"></script>
	<script src="js/tms_presets.js"></script>
    <script src="js/cufon-yui.js"></script>
    <script src="js/Asap_400.font.js"></script>
    <script src="js/Coolvetica_400.font.js"></script>
	<script src="js/Kozuka_M_500.font.js"></script>
    <script src="js/cufon-replace.js"></script>
    <script src="js/FF-cash.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
function initialize() {
  var myLatlng = new google.maps.LatLng(45.4714585, 9.2385958);
  var mapOptions = {
    zoom: 17,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <script>
		$(window).load(function(){
			$('.slider')._TMS({
			prevBu:'.prev',
			nextBu:'.next',
			pauseOnHover:true,
			pagNums:false,
			duration:800,
			easing:'easeOutQuad',
			preset:'Fade',
			slideshow:7000,
			pagination:'.pagination',
			waitBannerAnimation:false,
			banners:'fade'
			})
		}) 	
    </script>
	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
    	<link rel="stylesheet" type="text/css" media="screen" href="css/ie.css">
	<![endif]-->
</head>
<body>
<div class="main">
<header>
        <h1><a href="/">Fitness <strong>Club.</strong></a></h1>
        <nav>
        	<div class="social-icons">
            	<a href="#" class="icon-2"></a>
            	<a href="#" class="icon-1"></a>
            </div>
            <ul class="menu">
			<?php include("menu.php"); ?>
            </ul>
        </nav>
    </header>
	<div class="bg-img"></div>
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
          <div class="grid_12 top-1">
          	<div class="box-shadow">
            	<div class="wrap block-2">
                    <div class="col-1">
                    	<h2 class="p3"><span class="color-1">Information</span> of the club</h2>
                        <div class="wrap box-1">
                            <img src="images/page1-img1.jpg" alt="" class="img-border img-indent" width="130px">
                            <div class="extra-wrap-main">
                                <p class="p2"><strong><a href="?option=courses">Courses</a></strong></p>
                            </div>
                        </div>  
                        <div class="wrap box-1">
                            <img src="images/page1-img2.jpg" alt="" class="img-border img-indent" width="130px">
                            <div class="extra-wrap-main">
                                <p class="p2"><strong><a href="?option=category">Course category</a></strong></p>
                            </div>
                        </div> 
                        <div class="wrap box-1">
                            <img src="images/page4-img1.jpg" alt="" class="img-border img-indent" width="130px">
                            <div class="extra-wrap-main">
                                <p class="p2"><strong><a href="?option=instructors">Instructors</a></strong></p>
                            </div>
                        </div>                     
                    </div>
                    <div class="col-2">
                         <div class="form-search">
                         	<form enctype="multipart/form-data" action="" method="POST">
                        	<h2><span class="color-1">Have</span> a questions?</h2>
                        	<p>Name:<br />
							<input type="text" name="name" style="">
							<p>E-mail:<br />
							<input type="text" name="email" style="">
							<p>Text:<br />
							<textarea name="text" cols="25" rows="7"></textarea>
							<p><input type="submit" name="button" value="Send"></p></form>						
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="clear"></div>
        </div>
    </section>
	</div>
	</body>
	</html>