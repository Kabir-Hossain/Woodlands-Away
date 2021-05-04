<!DOCTYPE html>
<html lang="en">
<head>
<?php include 'templates/header.php'; 

					if(isset($_SESSION['msg'])){
						echo '<script type="text/javascript">alert("' . $_SESSION['msg']. '")</script>';
						unset($_SESSION['msg']);
					}


?>


				

  </head>
  <body class="tm-gray-bg">
  	<!-- Header -->
  	<div class="tm-header">
  		<div class="container">
  			<div class="row">
  				<div class="col-lg-6 col-md-4 col-sm-3 tm-site-name-container">
  					<a href="#" class="tm-site-name">Woodlands Away</a>	
  				</div>
	  			<div class="col-lg-6 col-md-8 col-sm-9">
	  				<div class="mobile-menu-icon">
		              <i class="fa fa-bars"></i>
		            </div>
	  				<nav class="tm-nav">
						<ul>
							<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 0){ ?>
								<li><a href="admin/newPackage.php">Create Packages</a></li>
								<li><a href="admin/showbooking.php">Show Bookings</a></li>
								<li><a href="forum.php">Forum</a></li>
							<?php } ?>
							<?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1){ ?>
								<li><a href="index.php">Home</a></li>
								<li><a href="about.php">About</a></li>
								<li><a href="packages.php" class = "active">Packages</a></li>
								<li><a href="forum.php">Forum</a></li>
							<?php } ?>													
							<?php if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']){ ?>								
								<li><a href="logout.php"><?=$_SESSION['username']?>-Logout</a></li>
							<?php }else{ ?>
								<li><a href="LogIn.php">Log-In</a></li>
							<?php } ?>
						</ul>
					</nav>		
	  			</div>				
  			</div>
  		</div>	  	
  	</div>
	
	<!-- Banner -->
	
	<?php include 'templates/banner.php'; ?>

	<!-- gray bg -->	
	<section class="container tm-home-section-1" id="more">
		<div class="row">
			
		</div>
	
		<div class="section-margin-top">
			<div class="row">				
				<div class="tm-section-header">
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-6 col-md-6 col-sm-6"><h2 class="tm-section-title">Our Packages</h2></div>
					<div class="col-lg-3 col-md-3 col-sm-3"><hr></div>	
				</div>
			</div>
				
						
			<div class="row">
				<?php 
				include_once 'dbCon.php';
				$conn= connect();
				$sql= "SELECT * from packages WHERE normal=1 AND special=0";
				$resultData=$conn->query($sql);
					
					
					foreach($resultData as $package){
				?>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="tm-tours-box-1">
						<img src="<?=BASE_URL?>/img/upload/<?=$package['image']?>" alt="" height="400" width="600" class="img-responsive">
						<!--img src="img/luxury.jpg" alt="image" class="img-responsive"-->
						<div class="tm-tours-box-1-info">
							<div class="tm-tours-box-1-info-left">
								<h2><?=$package['name']?></h2>	
								<p class="text-uppercase margin-bottom-20"><?=$package['location']?></p>
							</div>
							<div class="tm-tours-box-1-info-right">
								<p class="gray-text tours-1-description">Woodlands a hybrid style home product including hot tub, swimming poll, resturent and small supermarket</p>	
							</div>							
						</div>
						<div class="tm-tours-box-1-link">
							<div class="tm-tours-box-1-link-left">
								<form action="booking.php" method="post">
									<input type="hidden" name="pid" id="pid" class="form-control" value="<?=$package['id']?>">			
									<button type="submit" name="submit" class="tm-blue-btn">Book Now</button>
								</form>
							</div>
							<a href="#" class="tm-tours-box-1-link-right"><?=$package['price']?></a>							
						</div>
					</div>					
				</div>
				<?php } ?>
			</div>
			
		</div>
	</section>		
	
	<!-- white bg -->
	<section class="tm-white-bg section-padding-bottom">
		<div class="container">
			<div class="row">
				<div class="tm-section-header section-margin-top">
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>
					<div class="col-lg-4 col-md-6 col-sm-6"><h2 class="tm-section-title">Special Packages</h2></div>
					<div class="col-lg-4 col-md-3 col-sm-3"><hr></div>	
				</div>				
			</div>
			<div class="row">
			
				<?php 
				include_once 'dbCon.php';
				$conn= connect();
				$sql= "SELECT * from packages WHERE normal=0 AND special=1";
				$resultData=$conn->query($sql);
					
					
					foreach($resultData as $package){
				?>
			
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-xxs-12">
					<div class="tm-tours-box-2">						
						<img src="<?=BASE_URL?>/img/upload/<?=$package['image']?>" alt="image" class="img-responsive">
						<div class="tm-tours-box-2-info">
							<p class="margin-bottom-15">Woodlands a hybrid style home product including hot tub, swimming poll, resturent and small supermarket.</p>
							<img src="img/rating.png" alt="image" class="margin-bottom-5">
							<h2><?=$package['name']?></h2>
							<p>--------------------------</p>
							<p>These packages are avalible after 30th Nov, 2017</p>
						</div>
						<form action="booking.php" method="post">
							<input type="hidden" name="pid" id="pid" class="form-control" value="<?=$package['id']?>">
							<button type="submit" name="submit" class="tm-yellow-btn">Book Now</button>							
						</form>
					</div>
				</div>
				<?php } ?>				
			</div>
			<div class="pull-right row">
				<form>
					<input type="submit" value="Subscribe" style="float: right" />
						<div style="overflow: hidden; padding-right: .3em;">
						   <input type="text" class="form-control" placeholder="E-Mail" style="width: 100%;" />
						</div>​				
										
				</form>				
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p class="home-description">"A great place to stay, with room to spread out as a family. Excellent location with access to lots of local attractions. 
						Facilities of the cabin and the site were exactly as advertised, would thoroughly recommend this."
					</p>					
				</div>
			</div>	
		</div>
		
		
	</section>
	<!-- Footer -->
	
	<?php include 'templates/Footer.php'; ?>
	
	<script>
	
		/* Google map
      	------------------------------------------------*/
      	var map = '';
      	var center;

      	function initMap() {
	        var mapOptions = {
	          	zoom: 14,
	          	center: new google.maps.LatLng(23.75264331, 90.38220406),
	          	scrollwheel: false
        	};
        
	        map = new google.maps.Map(document.getElementById('google-map'),  mapOptions);

	        google.maps.event.addDomListener(map, 'idle', function() {
	          calculateCenter();
	        });
        
	        google.maps.event.addDomListener(window, 'resize', function() {
	          map.setCenter(center);
	        });
      	}

	    function calculateCenter() {
	        center = map.getCenter();
	    }

	    function loadGoogleMap(){
	        var script = document.createElement('script');
	        script.type = 'text/javascript';
	        script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyDvHk8s7yiLWqa_IUqqRqZ1z0BICfa_FGU&callback=initMap";
	        document.body.appendChild(script);
	    }
	
      	// DOM is ready AIzaSyDvHk8s7yiLWqa_IUqqRqZ1z0BICfa_FGU
		$(function() {

			// https://css-tricks.com/snippets/jquery/smooth-scrolling/
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});

		  	// Flexslider
		  	$('.flexslider').flexslider({
		  		controlNav: false,
		  		directionNav: false
		  	});

		  	// Google Map
		  	loadGoogleMap();
		  });
	</script>
 </body>
 </html>
